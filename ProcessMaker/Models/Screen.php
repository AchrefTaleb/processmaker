<?php

namespace ProcessMaker\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use ProcessMaker\Models\ScreenVersion;
use ProcessMaker\Traits\SerializeToIso8601;

/**
 * Class Screen
 *
 * @package ProcessMaker\Models
 *
 * @property string id
 * @property string title
 * @property string description
 * @property array content
 * @property array config
 * @property array computed
 * @property array custom_css
 * @property string label
 * @property Carbon type
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 *
 * @OA\Schema(
 *   schema="screensEditable",
 *   @OA\Property(property="id", type="string", format="id"),
 *   @OA\Property(property="name", type="string"),
 *   @OA\Property(property="title", type="string"),
 *   @OA\Property(property="type", type="string"),
 *   @OA\Property(property="description", type="string"),
 *   @OA\Property(property="config", type="string"),
 * ),
 * @OA\Schema(
 *   schema="screens",
 *   allOf={@OA\Schema(ref="#/components/schemas/screensEditable")},
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 *
 */
class Screen extends Model
{
    use SerializeToIso8601;

    protected $connection = 'spark';

    protected $casts = [
        'config' => 'array',
        'computed' => 'array'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Validation rules
     *
     * @param $existing
     *
     * @return array
     */
    public static function rules($existing = null)
    {
        $unique = Rule::unique('screens')->ignore($existing);

        return [
            'title' => ['required', $unique],
            'description' => 'required',
            'type' => 'required'
        ];
    }

    /**
     * Get the associated versions
     */
    public function versions()
    {
        return $this->hasMany(ScreenVersion::class);
    }
}
