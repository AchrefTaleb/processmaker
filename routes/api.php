<?php
Route::group(
    [
        'middleware' => ['auth:api', 'bindings', 'authorize'],
        'prefix' => 'api/1.0',
        'namespace' => 'ProcessMaker\Http\Controllers\Api',
        'as' => 'api.',
    ], function() {

    Route::apiResource('users', 'UserController');
    Route::apiResource('groups', 'GroupController');
    Route::get('group_users/{group}', 'GroupController@members');
    Route::apiResource('group_members', 'GroupMemberController')->only(['index', 'show', 'destroy', 'store']);
    Route::apiResource('environment_variables', 'EnvironmentVariablesController');
    Route::apiResource('screens', 'ScreenController');
    Route::apiResource('screen_categories', 'ScreenCategoryController');
    Route::post('scripts/preview', 'ScriptController@preview')->name('script.preview');
    Route::apiResource('scripts', 'ScriptController');
    Route::apiResource('processes', 'ProcessController');
    Route::put('processes/{processId}/restore', 'ProcessController@restore');
    Route::get('start_processes', 'ProcessController@startProcesses');
    Route::apiResource('process_categories', 'ProcessCategoryController');
    Route::put('permissions', 'PermissionController@update');
    Route::apiResource('tasks', 'TaskController')->only(['index', 'show', 'update']);
    Route::apiResource('requests', 'ProcessRequestController');
    Route::apiResource('requests.files', 'ProcessRequestFileController');
    Route::post('process_events/{process}', 'ProcessController@triggerStartEvent')->name('process_events.trigger');
    Route::apiResource('files', 'FileController');
    Route::apiResource('notifications', 'NotificationController');
    Route::put('read_notifications', 'NotificationController@updateAsRead');
    Route::put('unread_notifications', 'NotificationController@updateAsUnread');
    Route::apiResource('task_assignments', 'TaskAssignmentController')->only(['index', 'store', 'update', 'destroy']);
    Route::apiResource('comments', 'CommentController');
}
);
