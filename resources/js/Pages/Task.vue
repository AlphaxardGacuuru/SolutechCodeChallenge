<script setup>
    import Dropdown from "@/Components/Dropdown.vue";
    import DropdownLink from "@/Components/DropdownLink.vue";
    import TaskMedia from "@/Components/TaskMedia.vue"

    import useTasks from "@/Composables/useTasks";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {
        Head
    } from "@inertiajs/vue3";
    import {
        onMounted
    } from "vue";


    const {
        task,
        getTask
    } = useTasks()

    onMounted(() => getTask(route().params.id))

    // Status Class
    const statusClass = () => {
        if (task.value.status == "Pending") {
            return "dark:text-yellow-500"
        } else if (task.status == "Ongoing") {
            return "text-green-900"
        } else {
            return "text-blue-900"
        }
    }

</script>

<template>

    <Head title="Tasks" />

    <AuthenticatedLayout>

        <div
             class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-3 lg:p-8">

                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <TaskMedia :task="task" />
                    <div class="flex float-right justify-end">
                        <!-- Status -->
                        <h4 class="mr-5 dark:text-gray-300">Status</h4>
                        <Dropdown align="right"
                                  width="48"
                                  class="mr-10">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            :class="`inline-flex items-center px-3 py-2 border border-transparent
                                            text-sm leading-4 font-medium rounded-md
                                            bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300
                                            focus:outline-none transition ease-in-out duration-150 ${statusClass()}`">
                                        {{ task.status }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')"
                                              method="post"
                                              as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>

                        <!-- Assignee -->
                        <h4 class="mr-5 dark:text-gray-300">Assignee</h4>
                        <Dropdown align="right"
                                  width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                            :class="`inline-flex items-center px-3 py-2 border border-transparent
                                            text-sm leading-4 font-medium rounded-md
                                            bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300
                                            focus:outline-none transition ease-in-out duration-150 ${statusClass()}`">
                                        {{ task.status }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')"
                                              method="post"
                                              as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">
                            <a href="https://www.black.co.ke"
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
