<?php

namespace ProcessMaker\Http\Controllers\Api\Administration;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use ProcessMaker\Facades\UserManager;
use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Model\User;
use ProcessMaker\Transformers\UserTransformer;

/**
 * Controller that handles all Users API endpoints
 *
 */
class UsersController extends Controller
{

    /**
     * Fetch a collection of users based on paged request and filter if provided
     *
     * @param Request $request
     *
     * @return ResponseFactory|Response A list of matched users and paging data
     */
    public function index(Request $request)
    {
        $options = [
            'filter' => $request->input('filter', ''),
            'current_page' => $request->input('current_page', 1),
            'per_page' => $request->input('per_page', 10),
            'order_by' => $request->input('order_by', 'username'),
            'order_direction' => $request->input('order_direction', 'ASC'),
        ];
        $response = UserManager::index($options);
        // Return fractal representation of paged data
        return fractal($response, new UserTransformer())->respond();
    }

    /**
     * Fetch a single user from the system and return
     *
     ** @param User $user
     *
     * @return ResponseFactory|Response Information user
     */
    public function get(User $user)
    {
        return fractal($user, new UserTransformer())->respond();
    }

    /**
     * Create a new user
     *
     * @param Request $request
     *
     * @return ResponseFactory|Response
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $request->validate(User::rules());
        $user = User::create([
            'username'  => $request->username,
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'password'  => Hash::make($request->password),
            'status'    => User::STATUS_ACTIVE,
        ]);
        return fractal($user, new UserTransformer())->respond();
    }

    /**
     * Update information user
     *
     * @param User $user
     * @param Request $request
     *
     * @return ResponseFactory|Response
     * @throws \Throwable
     */
    public function update(User $user, Request $request)
    {
        $request->validate(User::rules($user));
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->status = $request->status;
        if($request->password != ""){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return fractal($user, new UserTransformer())->respond();
    }

    /**
     * Delete user
     *
     * @param User $user
     *
     * @return ResponseFactory|Response
     * @throws \Exception
     */
    public function delete(User $user)
    {
        $user->delete();
        return response([], 204);
    }

}
