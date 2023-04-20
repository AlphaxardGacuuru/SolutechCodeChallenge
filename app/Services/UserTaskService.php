<?php

namespace App\Services;

use App\Models\Status;
use App\Models\Task;
use App\Models\UserTask;

class UserTaskService
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
    public function store($request)
    {
        // Get Due date
        $dueDate = Task::find($request->input("taskId"))->due_date;

        // Get default status
        $statusId = Status::where("name", "Pending")->first()->id;

        $userTask = new UserTask;
        $userTask->user_id = $request->input("userId");
        $userTask->task_id = $request->input("taskId");
        $userTask->due_date = $dueDate;
        $userTask->start_time = $request->input("startTime");
        $userTask->end_time = $request->input("endTime");
        $userTask->remarks = $request->input("remarks");
        $userTask->status_id = $statusId;
        $userTask->save();

        return response("Task Assigned", 200);
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
    public function update($request, $id)
    {
        $userTask = UserTask::where("task_id", $id)
            ->orderBy("id", "DESC")
            ->first();

        if ($request->input("userId")) {
            $userTask->user_id = $request->input("userId");
        }

        if ($request->input("taskId")) {
            $userTask->task_id = $request->input("taskId");
        }

        if ($request->input("dueDate")) {
            $userTask->due_date = $request->input("dueDate");
        }

        if ($request->input("startTime")) {
            $userTask->start_time = $request->input("startTime");
        }

        if ($request->input("endTime")) {
            $userTask->end_time = $request->input("endTime");
        }

        if ($request->input("remarks")) {
            $userTask->remarks = $request->input("remarks");
        }

        if ($request->input("statusId")) {
            $userTask->status_id = $request->input("statusId");
        }

        $userTask->save();

        return response("Task Updated", 200);
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
