import Axios from "axios";
import { ref } from "vue";

export default function useTasks() {
    const tasks = ref({});
    const users = ref({});

    /*
     * Fetch of Task data */
    const getTasks = async () => {
        Axios.get("/api/dashboard/tasks").then((res) => {
            tasks.value = res.data;
        });
    };

    /*
     * Fetch of User data */
    const getUsers = async () => {
        let res = await Axios.get("/api/dashboard/users");
        users.value = res.data;
    };

    return {
        tasks,
        users,
        getTasks,
        getUsers,
    };
}
