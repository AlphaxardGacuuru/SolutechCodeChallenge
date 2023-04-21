<script setup>
    import {
        Head,
        Link
    } from '@inertiajs/vue3';
    import {
        onMounted,
        ref
    } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import Modal from '@/Components/Modal.vue';

    import useTasks from '@/Composables/useTasks';

    const modal = ref(false)

    const openModal = () => modal.value = !modal.value

    const {
        messages,
        task,
        getTask,
        onUpdateTask,
        onDeleteTask
    } = useTasks()

    onMounted(() => {
        getTask(route().params.id)
    })

</script>

<template>

    <Head title="Edit Task" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Task</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <PrimaryButton class="ml-4 hover:opacity-25">
                    <Link :href="`/tasks/${route().params.id}`">Back</Link>
                </PrimaryButton>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <section>

                        <div v-for="(message, key) in messages"
                             :key="key"
                             class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50
                         via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl
                         shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all
                         duration-250 focus:outline focus:outline-2 focus:outline-red-500 dark:text-white justify-center mb-1">
                            <h6>{{ message }}</h6>
                        </div>

                        <form @submit.prevent="() => onUpdateTask(route().params.id)"
                              class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="name"
                                            value="Name" />

                                <input id="name"
                                       type="text"
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                           dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
                                           focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       v-model="task.name"
                                       autofocus
                                       autocomplete="name" />
                            </div>

                            <div>
                                <InputLabel for="description"
                                            value="Description" />

                                <textarea id="name"
                                          type="text"
                                          class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                           dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
                                           focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                          v-model="task.description"
                                          rows="10"
                                          autofocus
                                          autocomplete="description">
										</textarea>
                            </div>

                            <div class="flex items-center gap-4 justify-end">
                                <DangerButton class="hover:opacity-25"
                                              @click.prevent="openModal">Delete</DangerButton>
                                <PrimaryButton>Save</PrimaryButton>
                            </div>
                        </form>

                        <Modal :show="modal"
                               @close="openModal">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Are you sure you want to delete the task?
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <SecondaryButton @click="openModal">Cancel</SecondaryButton>

                                    <DangerButton class="ml-3"
                                                  @click="() => {
													onDeleteTask(route().params.id)
													openModal()
													}">
                                        Delete Task
                                    </DangerButton>
                                </div>
                            </div>
                        </Modal>

                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
