<script setup>
    import {
        Head
    } from "@inertiajs/vue3";
    import {
        onMounted,
        ref
    } from "vue";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Dropdown from "@/Components/Dropdown.vue";
    import TaskMedia from "@/Components/TaskMedia.vue"

    import useTasks from "@/Composables/useTasks";
    import useUsers from "@/Composables/useUsers";


    const dueDate = ref("")

    const {
        task,
        stati,
        messages,
        getTask,
        getStati,
        onStatus,
        onAssign,
        onDueDate
    } = useTasks()

    const {
        users,
        getUsers
    } = useUsers()

    /*
     * Prevent past date in date picker */
    const minDate = () => {
        var today = new Date().toISOString().split('T')[0];
        var myDate = document.getElementById("dueDate");
        myDate.setAttribute('min', today);
    }

    onMounted(() => {
        getTask(route().params.id)
        getUsers()
        getStati()
        minDate()
    })

    /*
     * Status Class */
    const statusClass = (status) => {
        if (status == "Pending") {
            return "dark:text-yellow-500"
        } else if (status == "Ongoing") {
            return "text-green-500"
        } else {
            return "text-blue-500"
        }
    }

    /*
     * Conditionaly show status */
    const hideStatus = (status, taskStatus) => {
        if (taskStatus == "Pending" && status == "Done") {
            return false
        } else {
            return true
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
                    <div v-for="(message, key) in messages"
                         :key="key"
                         class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50
                         via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl
                         shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all
                         duration-250 focus:outline focus:outline-2 focus:outline-red-500 dark:text-white justify-center">
                        <h6>{{ message }}</h6>
                    </div>

                    <TaskMedia :task="task" />

                    <div class="flex justify-start flex-col lg:flex-row">
                        <!-- Due Date -->
                        <div v-show="task.assigneeId"
                             class="mr-10 mb-4">
                            <h4 class="mb-2 dark:text-gray-300">Due Date</h4>
                            <div class="inline-flex rounded-md">
                                <input id="dueDate"
                                       type="date"
                                       :value="task.dueDate"
                                       min=""
                                       class="inline-flex items-center px-3 py-2 border border-transparent
                                            text-sm leading-4 font-medium rounded-md
                                            bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300
                                            focus:outline-none transition ease-in-out duration-150 dark:text-gray-300 color-gray-300"
                                       @input="(e) => onDueDate(e.target.value, route().params.id)">
                                {{ dueDate }}
                            </div>
                        </div>
                        <!-- Due Date End -->

                        <!-- Status Dropdown -->
                        <div v-show="task.assigneeId"
                             class=" mb-4">
                            <h4 class="mr-20 mb-2 dark:text-gray-300">Status</h4>
                            <Dropdown align="right"
                                      width="48"
                                      class="mr-10">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                                :class="`inline-flex items-center px-3 py-2 border border-transparent
                                            text-sm leading-4 font-medium rounded-md
                                            bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300
                                            focus:outline-none transition ease-in-out duration-150 ${statusClass(task.status)}`">
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
                                    <template v-for="(status, key) in stati">
                                        <div v-if="hideStatus(status.name, task.status)"
                                             :key="key"
                                             :class="`block w-full px-4 py-2 text-left text-sm leading-5 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none
                                     focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out cursor-pointer
                                     ${statusClass(status.name)}`"
                                             @click="() => task.status != status.name &&  onStatus(status.id, route().params.id)">
                                            {{status.name}}
                                        </div>
                                    </template>
                                </template>
                            </Dropdown>
                        </div>
                        <!-- Status Dropdown End -->

                        <!-- Assignee Dropdown -->
                        <div>
                            <h4 class="mr-6 mb-2 dark:text-gray-300">Assignee</h4>
                            <Dropdown align="right"
                                      width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent
                                            text-sm leading-4 font-medium rounded-md
                                            bg-white dark:bg-gray-800 text-gray-300 hover:text-gray-700 dark:hover:text-gray-300
                                            focus:outline-none transition ease-in-out duration-150">
                                            {{ task.assigneeName }}
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
                                    <div v-for="(user, key) in users"
                                         :key="key"
                                         class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700
                                              dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800
                                              focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition
                                              duration-150 ease-in-out cursor-pointer"
                                         @click="() => task.assigneeId != user.id && onAssign(user.id, route().params.id)">
                                        {{user.name}}
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                        <!-- Assignee Dropdown End -->
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
                                My Stuff
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
