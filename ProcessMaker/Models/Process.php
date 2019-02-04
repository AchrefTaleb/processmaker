<?php

namespace ProcessMaker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use ProcessMaker\AssignmentRules\PreviousTaskAssignee;
use ProcessMaker\Exception\TaskDoesNotHaveUsersException;
use ProcessMaker\Models\ProcessRequestToken;
use ProcessMaker\Nayra\Contracts\Bpmn\ActivityInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ScriptTaskInterface;
use ProcessMaker\Nayra\Contracts\Bpmn\ServiceTaskInterface;
use ProcessMaker\Nayra\Contracts\Storage\BpmnDocumentInterface;
use ProcessMaker\Nayra\Storage\BpmnDocument;
use ProcessMaker\Traits\ProcessTaskAssignmentsTrait;
use ProcessMaker\Traits\SerializeToIso8601;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Represents a business process definition.
 *
 * @property string $id
 * @property string $process_category_id
 * @property string $user_id
 * @property string $bpmn
 * @property string $description
 * @property string $name
 * @property string $status
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 *
 * @OA\Schema(
 *   schema="ProcessEditable",
 *   @OA\Property(property="process_category_id", type="string", format="id"),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="description", type="string"),
 *   @OA\Property(property="status", type="string", enum={"ACTIVE", "INACTIVE"}),
 * ),
 * @OA\Schema(
 *   schema="Process",
 *   allOf={@OA\Schema(ref="#/components/schemas/ProcessEditable")},
 *   @OA\Property(property="user_id", type="string", format="id"),
 *   @OA\Property(property="id", type="string", format="id"),
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 */
class Process extends Model implements HasMedia
{
    use HasMediaTrait;
    use SerializeToIso8601;
    use SoftDeletes;
    use ProcessTaskAssignmentsTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * BPMN data will be hidden. It will be able by its getter.
     *
     * @var array
     */
    protected $hidden = [
        'bpmn'
    ];

    /**
     * Parsed process BPMN definitions.
     *
     * @var \ProcessMaker\Nayra\Contracts\Storage\BpmnDocumentInterface
     */
    private $bpmnDefinitions;

    /**
     * Category of the process.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ProcessCategory::class, 'process_category_id');
    }

    /**
     * Validation rules.
     *
     * @param null $existing
     *
     * @return array
     */
    public static function rules($existing = null)
    {
        $unique = Rule::unique('processes')->ignore($existing);

        return [
            'name' => ['required', $unique],
            'description' => 'required',
            'status' => 'in:ACTIVE,INACTIVE',
            'process_category_id' => 'exists:process_categories,id',
            'bpmn' => 'nullable',
        ];
    }

    /**
     * Get the creator/author of this process.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the users who can start this process
     *
     */    
    public function usersCanStart()
    {
        return $this->morphedByMany('ProcessMaker\Models\User', 'processable')->wherePivot('method', 'START');
    }

    /**
     * Get the groups who can start this process
     *
     */    
    public function groupsCanStart()
    {
        return $this->morphedByMany('ProcessMaker\Models\Group', 'processable')->wherePivot('method', 'START');
    }

    /**
     * Get the users who can start this process
     *
     */    
    public function usersCanCancel()
    {
        return $this->morphedByMany('ProcessMaker\Models\User', 'processable')->wherePivot('method', 'CANCEL');
    }

    /**
     * Get the groups who can start this process
     *
     */    
    public function groupsCanCancel()
    {
        return $this->morphedByMany('ProcessMaker\Models\Group', 'processable')->wherePivot('method', 'CANCEL');
    }

    /**
     * Get the users who can start this process
     *
     */    
    public function usersCanEditData()
    {
        return $this->morphedByMany('ProcessMaker\Models\User', 'processable')->wherePivot('method', 'EDIT_DATA');
    }

    /**
     * Get the groups who can start this process
     *
     */    
    public function groupsCanEditData()
    {
        return $this->morphedByMany('ProcessMaker\Models\Group', 'processable')->wherePivot('method', 'EDIT_DATA');
    }

    /**
     * Scope a query to include only active processes
     *
     */
    public function scopeActive($query)
    {
        return $query->where('processes.status', 'ACTIVE');
    }

    /**
     * Scope a query to include only inactive processes
     *
     */    
    public function scopeInactive($query)
    {
        return $query->where('processes.status', 'INACTIVE');
    }    

    /**
     * Get the process definitions from BPMN field.
     *
     * @param bool $forceParse
     *
     * @return ProcessMaker\Nayra\Contracts\Storage\BpmnDocumentInterface
     */
    public function getDefinitions($forceParse = false)
    {
        if ($forceParse || empty($this->bpmnDefinitions)) {
            $this->bpmnDefinitions = app(BpmnDocumentInterface::class, ['process' => $this]);
            if ($this->bpmn) {
                $this->bpmnDefinitions->loadXML($this->bpmn);
                //Load the collaborations if exists
                $collaborations = $this->bpmnDefinitions->getElementsByTagNameNS(BpmnDocument::BPMN_MODEL, 'collaboration');
                foreach ($collaborations as $collaboration) {
                    $collaboration->getBpmnElementInstance();
                }
            }
        }
        return $this->bpmnDefinitions;
    }

    /**
     * Get the path of the process templates.
     *
     * @return string
     */
    public static function getProcessTemplatesPath()
    {
        return Storage::disk('process_templates')->path('');
    }

    /**
     * Get a process template by name.
     *
     * @param string $name
     *
     * @return string
     */
    public static function getProcessTemplate($name)
    {
        return Storage::disk('process_templates')->get($name);
    }

    /**
     * Category of the process.
     *
     * @return BelongsTo
     */
    public function requests()
    {
        return $this->hasMany(ProcessRequest::class);
    }

    /**
     * Category of the process.
     *
     * @return BelongsTo
     */
    public function collaborations()
    {
        return $this->hasMany(ProcessCollaboration::class);
    }

    /**
     * Get the user to whom to assign a task.
     *
     * @param ActivityInterface $activity
     * @param TokenInterface $token
     *
     * @return User
     */
    public function getNextUser(ActivityInterface $activity, ProcessRequestToken $token)
    {
        $default = $activity instanceof ScriptTaskInterface
        || $activity instanceof ServiceTaskInterface ? 'script' : 'requestor';
        $assignmentType = $activity->getProperty('assignment', $default);
        switch ($assignmentType) {
            case 'group':
                $user = $this->getNextUserFromGroupAssignment($activity->getId());
                break;
            case 'user':
                $user = $this->getNextUserAssignment($activity->getId());
                break;
            case 'requestor':
                $user = $token->getInstance()->user_id;
                break;
            case 'previous_task_assignee':
                $rule = new PreviousTaskAssignee();
                $user = $rule->getNextUser($activity, $token, $this, $token->processRequest);
                break;
            case 'manual':
            case 'self_service':
                $user = null;
                break;
            case 'script':
            default:
                $user = null;
        }
        return $user ? User::where('id', $user)->first() : null;
    }

    /**
     * Get the next user in a cyclical assignment.
     *
     * @param string $processTaskUuid
     *
     * @return binary
     * @throws TaskDoesNotHaveUsersException
     */
    private function getNextUserFromGroupAssignment($processTaskUuid)
    {
        $last = ProcessRequestToken::where('process_id', $this->id)
            ->where('element_id', $processTaskUuid)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first();
        $users = $this->getAssignableUsers($processTaskUuid);
        if (empty($users)) {
            throw new TaskDoesNotHaveUsersException($processTaskUuid);
        }
        sort($users);
        if ($last) {
            foreach ($users as $user) {
                if ($user > $last->user_id) {
                    return $user;
                }
            }
        }
        return $users[0];
    }


    /**
     * Get the next user in a user assignment.
     *
     * @param string $processTaskUuid
     *
     * @return binary
     * @throws TaskDoesNotHaveUsersException
     */
    private function getNextUserAssignment($processTaskUuid)
    {
        $last = ProcessRequestToken::where('process_id', $this->id)
            ->where('element_id', $processTaskUuid)
            ->orderBy('created_at', 'desc')
            ->first();
        $users = $this->getAssignableUsers($processTaskUuid);
        if (empty($users)) {
            throw new TaskDoesNotHaveUsersException($processTaskUuid);
        }
        return $users[0];
    }

    /**
     * Get an array of all assignable users to a task.
     *
     * @param string $processTaskUuid
     *
     * @return array
     */
    public function getAssignableUsers($processTaskUuid)
    {
        $assignments = ProcessTaskAssignment::select(['assignment_id', 'assignment_type'])
            ->where('process_id', $this->id)
            ->where('process_task_id', $processTaskUuid)
            ->get();
        $users = [];
        foreach ($assignments as $assignment) {
            if ($assignment->assignment_type === User::class) {
                $users[$assignment->assignment_id] = $assignment->assignment_id;
            } else { // Group::class
                $this->getConsolidatedUsers($assignment->assignment_id, $users);
            }
        }
        return array_values($users);
    }

    /**
     * Get a consolidated list of users within groups.
     *
     * @param binary $group_id
     * @param array $users
     *
     * @return array
     */
    private function getConsolidatedUsers($group_id, array &$users)
    {
        $groupMembers = GroupMember::where('group_id', $group_id)->get();
        foreach ($groupMembers as $groupMember) {
            if ($groupMember->member->status !== 'ACTIVE') {
                continue;
            }
            if ($groupMember->member_type === User::class) {
                $users[$groupMember->member_id] = $groupMember->member_id;
            } else {
                $this->getConsolidatedUsers($groupMember->member_id, $users);
            }
        }
        return $users;
    }

    /**
     * Get a list of the process start events.
     *
     * @return array
     */
    public function getStartEvents()
    {
        $definitions = $this->getDefinitions();
        $response = [];
        $startEvents = $definitions->getElementsByTagNameNS(BpmnDocument::BPMN_MODEL, 'startEvent');
        foreach ($startEvents as $startEvent) {
            $response[] = $startEvent->getBpmnElementInstance()->getProperties();
        }
        return $response;
    }

    /**
     * Process events relationship.
     *
     * @return \ProcessMaker\Models\ProcessEvents
     */
    public function events()
    {
        $query = $this->newQuery();
        $query->where('id', $this->id);
        return new ProcessEvents($query, $this);
    }

    /**
     * Get the associated versions
     */
    public function versions()
    {
        return $this->hasMany(ProcessVersion::class);
    }

    /**
     * Assignments of the process.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany(ProcessTaskAssignment::class);
    }
}
