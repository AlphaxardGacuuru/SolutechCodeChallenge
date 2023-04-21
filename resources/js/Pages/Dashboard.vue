<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {
        Head
    } from '@inertiajs/vue3';
    import {
        onMounted
    } from 'vue';

    import useDashboard from "@/Composables/useDashboard.js"

    const {
        tasks,
        users,
        getTasks,
        getUsers
    } = useDashboard()

    onMounted(() => {
        getTasks()
        getUsers()
    })

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div>
            </div>
        </div> -->

        <div
             class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl mx-auto p-6 lg:p-8">

                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <a href="https://laravel.com/docs"
                           class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">

                            <div class="w-full">
                                <h1 class="mt-6 text-4xl font-thin text-gray-900 dark:text-white mb-10">Tasks</h1>

                                <div class="flex justify-between dark:text-white gap-2 flex-col">
                                    <div>
                                        <h1>Total</h1>
                                        <p class="dark:text-white">{{ tasks.tasks }}</p>
                                    </div>
                                    <div>
                                        <h1 class="text-yellow-500">Pending</h1>
                                        <p class="text-yellow-500">{{ tasks.pending?.total }}</p>
                                        <div class="md:w-96 bg-gray-100 mt-2 rounded-xl">
                                            <div :class="`${tasks.pending?.tailwind} bg-yellow-500`">
                                                {{ tasks.pending?.percent }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-green-500">Ongoing</h1>
                                        <p class="text-green-500">{{ tasks.ongoing?.total }}</p>
                                        <div class="md:w-96 bg-gray-100 mt-2 rounded-xl">
                                            <div :class="`${tasks.ongoing?.tailwind} bg-green-500`">
                                                {{ tasks.ongoing?.percent }}
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h1 class="text-blue-500">Done</h1>
                                        <p class="text-blue-500">{{ tasks.done?.total }}</p>
                                        <div class="md:w-96 bg-gray-100 mt-2 rounded-xl">
                                            <div :class="`${tasks.done?.tailwind} bg-blue-500`">
                                                {{ tasks.done?.percent }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="https://laracasts.com"
                           class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">

                            <div class="w-full">
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white mb-10">Users</h2>

                                <div class="flex justify-between dark:text-white gap-2 flex-col">
                                    <div>
                                        <h1>Total</h1>
                                        <p class="dark:text-white">{{ users.users?.total }}</p>
                                    </div>
                                    <div>
                                        <h1>Users with tasks</h1>
                                        <p>{{ users.users?.withTasks }}</p>
                                        <div class="md:w-96 bg-gray-100 mt-2 rounded-xl">
                                            <div :class="`${users.users?.tailwind} bg-blue-500`">
                                                {{ users.users?.percentage }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">
                            <a href="https://github.com/sponsors/taylorotwell"
                               class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Solutech Code Challenge
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
