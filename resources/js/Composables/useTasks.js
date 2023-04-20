import Axios from "axios";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

export default function useTasks() {
    const tasks = ref([]);
    const task = ref({});
    const stati = ref([]);
    const messages = ref([]);

    /*
     * Fetch listing of Tasks */
    const getTasks = async () => {
        let res = await Axios.get("tasks");
        tasks.value = res.data;
    };

    /*
     * Fetch one Task */
    const getTask = async (id) => {
        let res = await Axios.get(`tasks/${id}`);
        task.value = res.data;
    };

    /*
     * Create Task */
    const onCreateTask = async (name, description, dueDate) => {
        try {
            const res = await Axios.post("tasks", {
                name: name,
                description: description,
                dueDate: dueDate,
            });
            messages.value = [res.data];

            // Redirect
            router.get("/tasks");
        } catch (err) {
            const resErrors = err.response.data.errors;
            var newError = [];
            for (var resError in resErrors) {
                newError.push(resErrors[resError]);
            }
            // Get other errors
            messages.value = newError;
        }
    };

    /*
     * Update Task */
    const onUpdateTask = async (taskId) => {
        try {
            let res = await Axios.post(`tasks/${taskId}`, {
                _method: "PUT",
                name: task.value.name,
                description: task.value.description,
            });

            messages.value = [res.data];

            // Fetch Task
            getTask(taskId);
        } catch (err) {
            const resErrors = err.response.data.errors;
            var newError = [];
            for (var resError in resErrors) {
                newError.push(resErrors[resError]);
            }
            // Get other errors
            messages.value = newError;
        }
    };

    /*
     * Get Statuses */
    const getStati = async () => {
        let res = await Axios.get("status");
        stati.value = res.data;
    };

    /*
     * Change Task Status */
    const onStatus = async (statusId, taskId) => {
        let res = await Axios.post(`tasks/${taskId}`, {
            _method: "PUT",
            statusId: statusId,
        });

        messages.value = [res.data];

        // Fetch Task
        getTask(taskId);
    };

    /*
     * Assign User Task */
    const onAssign = async (userId, taskId) => {
        let res = await Axios.post("user-tasks", {
            userId: userId,
            taskId: taskId,
        });

        messages.value = [res.data];

        // Fetch Task
        getTask(taskId);
    };

    /*
     * Change Due Date */
    const onDueDate = async (dueDate, taskId) => {
        let res = await Axios.post(`tasks/${taskId}`, {
            _method: "PUT",
            dueDate: dueDate,
        });

        messages.value = [res.data];
        getTask(taskId);
    };

    return {
        tasks,
        task,
        stati,
        messages,
        getTasks,
        getTask,
        getStati,
        onStatus,
        onAssign,
        onDueDate,
        onUpdateTask,
        onCreateTask,
    };
}
