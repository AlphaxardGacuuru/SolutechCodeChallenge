import Axios from "axios";
import { ref } from "vue";

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
    };
}
