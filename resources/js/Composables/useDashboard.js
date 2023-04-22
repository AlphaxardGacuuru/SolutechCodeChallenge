import Axios from "axios";
import { ref } from "vue";

export default function useTasks() {
    const tasks = ref({});
    const users = ref({});

    /*
     * Task Doughnut */
    const showTaskChart = () => {
        const ctx = document.getElementById("taskChart");

        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Pending", "Ongoing", "Done"],
                datasets: [
                    {
                        label: "# of Tasks based on Status",
                        data: [
                            tasks.value.pending?.percent,
                            tasks.value.ongoing?.percent,
                            tasks.value.done?.percent,
                        ],
                        backgroundColor: ["#eab308", "#22c55e", "#3b82f6"],
                        borderWidth: 1,
                        borderColor: "#232323",
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    };

    /*
     * Task Doughnut */
    const showUserChart = () => {
        const ctx = document.getElementById("userChart");

        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["With tasks", "Without tasks"],
                datasets: [
                    {
                        label: "# of users based on Tasks",
                        data: [
                            users.value.withTasks?.percent,
                            users.value.withoutTasks?.percent,
                        ],
						backgroundColor: ["#22c55e","#ef4444"],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    };

    /*
     * Fetch of Task data */
    const getTasks = () => {
        Axios.get("/api/dashboard/tasks").then((res) => {
            tasks.value = res.data;

            // Show chart once data is available
            showTaskChart();
        });
    };

    /*
     * Fetch of User data */
    const getUsers = () => {
        Axios.get("/api/dashboard/users").then((res) => {
            users.value = res.data;

            // Show chart once data is available
            showUserChart();
        });
    };

    return {
        tasks,
        users,
        getTasks,
        getUsers,
    };
}
