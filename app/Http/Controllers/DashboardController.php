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
                "tailwind" => $service->getTaskByPercentageForTailwind($pendingPercent),
            ],
            "ongoing" => [
                "total" => $totalOngoing,
                "percent" => $ongoingPercent,
                "tailwind" => $service->getTaskByPercentageForTailwind($ongoingPercent),
            ],
            "done" => [
                "total" => $totalDone,
                "percent" => $donePercent,
                "tailwind" => $service->getTaskByPercentageForTailwind($donePercent),
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
            "users" => [
                "total" => $service->getUsers(),
                "withTasks" => $service->getUsersWithTasks(),
                "percentage" => $withTasksPercentage,
                "tailwind" => $service->getUserPercentageForTailwind($withTasksPercentage),
            ],
        ], 200);
    }
}
