import Axios from "axios";
import { ref } from "vue";

export default function useUsers() {
    const users = ref([]);

    const getUsers = async () => {
        let res = await Axios.get("/api/users");
        users.value = res.data;
    };
    return {
        users,
        getUsers,
    };
}
