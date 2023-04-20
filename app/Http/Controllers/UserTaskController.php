<?php

namespace App\Http\Controllers;

use App\Models\UserTask;
use App\Services\UserTaskService;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserTaskService $service)
    {
        $this->validate($request, [
            "userId" => "required",
            "taskId" => "required",
            // "dueDate" => "required",
            // "remarks" => "required",
            // "statusId" => "required",
        ]);

        return $service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function show(UserTask $userTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UserTaskService $service)
    {
        return $service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTask $userTask)
    {
        //
    }
}
