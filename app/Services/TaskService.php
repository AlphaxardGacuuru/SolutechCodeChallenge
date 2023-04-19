<?php

namespace App\Services;

use App\Models\Task;

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
    public function update(Request $request, Task $task)
    {
        //
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
     * Structure the data */
    public function structure($task)
    {
        return [
			"id" => $task->id,
            "name" => $task->name,
            "description" => $task->description,
            "status" => $task->status->name,
            "updatedAt" => $task->updated_at,
            "createdAt" => $task->created_at,
        ];
    }
}
