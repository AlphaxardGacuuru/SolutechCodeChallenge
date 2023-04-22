<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    /*
     * Get Task data */
    public function tasks(DashboardService $service)
    {
        $totalPending = $service->getTaskByStatus("Pending");
        $totalOngoing = $service->getTaskByStatus("Ongoing");
        $totalDone = $service->getTaskByStatus("Done");

        // Percentages
        $pendingPercent = $service->getTaskByPercentage($totalPending);
        $ongoingPercent = $service->getTaskByPercentage($totalOngoing);
        $donePercent = $service->getTaskByPercentage($totalDone);

        // Fetch Data
        return response([
            "tasks" => $service->getTasks(),
            "pending" => [
                "total" => $totalPending,
                "percent" => $pendingPercent,
            ],
            "ongoing" => [
                "total" => $totalOngoing,
                "percent" => $ongoingPercent,
            ],
            "done" => [
                "total" => $totalDone,
                "percent" => $donePercent,
            ],
        ], 200);
    }

    /*
     * Get User data */
    public function users(DashboardService $service)
    {
        $withTasksPercentage = $service->getUsersWithTasksPercentage();

        // Fetch Data
        return response([
            "users" => $service->getUsers(),
            "withTasks" => [
                "total" => $service->getUsersWithTasks(),
                "percent" => $withTasksPercentage,
            ],
            "withoutTasks" => [
                "percent" => (100 - $withTasksPercentage),
            ],
        ], 200);
    }
}
