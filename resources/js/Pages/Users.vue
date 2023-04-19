<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head
    } from '@inertiajs/vue3';
    import {
        onMounted,
        ref,
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
        <div v-for="(user, key) in users">
            <User :key="key"
                  :user="user" />

            <!-- {{ user.name }} -->
        </div>
    </AuthenticatedLayout>
</template>
