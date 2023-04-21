<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TaskService $service)
    {
        return $service->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TaskService $service)
    {
        $this->validate($request, [
            "name" => "required|string",
            "description" => "required|string|max:255",
            "dueDate" => "required|date",
            "status_id" => "string",
        ]);

        return $service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id, TaskService $service)
    {
        return $service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, TaskService $service)
    {
        $this->validate($request, [
            "name" => "string",
            "description" => "string",
        ]);
        return $service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, TaskService $service)
    {
        return $service->destroy($id);
    }
}
