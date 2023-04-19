<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head
    } from '@inertiajs/vue3';
    import {
        onMounted
    } from 'vue';

    import User from "@/Components/User.vue"

    import useUsers from "@/Composables/useUsers"

    const {
        users,
        getUsers
    } = useUsers()

    onMounted(getUsers)

</script>

<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-3 gap-4 mt-10">
            <User v-for="(user, key) in users"
                  :key="key"
                  :user="user" />
        </div>
    </AuthenticatedLayout>
</template>
