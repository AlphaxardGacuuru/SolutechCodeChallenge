import Axios from "axios";
import { ref } from "vue";

export default function useTasks() {
    const tasks = ref([]);
    const task = ref({});

    // Fetch listing of resource
    const getTasks = async () => {
        let res = await Axios.get("tasks");
        tasks.value = res.data;
    };

    // Fetch one resource
    const getTask = async (id) => {
        let res = await Axios.get(`tasks/${id}`);
        task.value = res.data;
    };
    return {
        tasks,
        task,
        getTasks,
        getTask,
    };
}
