<?php

namespace App\Services;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Models\UserTask;

class DashboardService
{
    /*
     * Fetch all Tasks */
    public function getTasks()
    {
        return Task::all()->count();
    }

    /*
     * Fetch Tasks by Status */
    public function getTaskByStatus($status)
    {
        // Get Status ID
        $statusId = Status::where("name", $status)->first()->id;

        return Task::where("status_id", $statusId)
            ->get()
            ->count();
    }

    /*
     * Fetch Tasks by Percentage */
    public function getTaskByPercentage($value)
    {
        $tasks = Task::all()->count();

        $percentage = $value > 0 ? $value / $tasks * 100 : 0;

        return round($percentage, 1);
    }

    /*
     *
     *     User Data
     *
     */

    /*
     * Fetch all Users */
    public function getUsers()
    {
        return User::all()->count();
    }

    /*
     * Fetch Users with tasks */
    public function getUsersWithTasks()
    {
        return UserTask::whereNull("end_time")
            ->select("user_id")
            ->distinct()
            ->get()
            ->count();
    }

    /*
     * Fetch Users with tasks */
    public function getUsersWithTasksPercentage()
    {
        $withTasks = $this->getUsersWithTasks();

        $totalUsers = $this->getUsers();

        $percentage = $withTasks > 0 ? $withTasks / $totalUsers * 100 : 0;

        return round($percentage, 1);
    }
}
