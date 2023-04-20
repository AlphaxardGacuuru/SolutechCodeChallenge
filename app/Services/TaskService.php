<?php

namespace App\Services;

use App\Models\Status;
use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;

class TaskService
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getTasks = Task::orderBy("id", "DESC")->get();

        $tasks = [];

        foreach ($getTasks as $task) {
            array_push($tasks, $this->structure($task));
        }

        return response($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        return response($this->structure($task), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $task = Task::find($id);

        if ($request->input("name")) {
            $task->name = $request->input("name");
        }

        if ($request->input("description")) {
            $task->description = $request->input("description");
        }

        if ($request->input("dueDate")) {
            $task->due_date = $request->input("dueDate");

            // Update user tasks as well
            $userTask = UserTask::where("task_id", $id)
                ->orderBy("id", "DESC")
                ->first();

            $userTask->due_date = $request->input("dueDate");
            $userTask->save();
        }

        $statusId = $request->input("statusId");

        if ($statusId) {
            $task->status_id = $statusId;

            // Change UserTask Status
            $this->handleStatus($statusId, $id);
        }

        $task->save();

        return response("Task Updated", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    /*
     * Handle Status */
    public function handleStatus($statusId, $id)
    {
        // Update user tasks as well
        $userTask = UserTask::where("task_id", $id)
            ->orderBy("id", "DESC")
            ->first();

        $userTask->status_id = $statusId;

        // If status has changed to Ongoing then add start date as today
        $statusName = Status::find($statusId)->name;

        if ($statusName == "Ongoing") {
            $userTask->start_time = Carbon::now();
        } elseif ($statusName == "Done") {
            $userTask->end_time = Carbon::now();
        } else {
            $userTask->start_time = null;
            $userTask->end_time = null;
        }

        $userTask->save();
    }

    /*
     * Structure the data */
    public function structure($task)
    {
        return [
            "id" => $task->id,
            "name" => $task->name,
            "description" => $task->description,
            "status" => $task->status->name,
            "dueDate" => $task->due_date,
            "assigneeId" => $task->assigneeId(),
            "assigneeName" => $task->assigneeName(),
            "updatedAt" => $task->updated_at,
            "createdAt" => $task->created_at,
        ];
    }
}
