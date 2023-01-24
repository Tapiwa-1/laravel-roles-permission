<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    users: Object
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Users</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
                                <tr >
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.email" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{user.name  }}
                                    </th>
                                     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{user.email  }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.users.show', user.id)" class="font-medium text-blue-600 mr-2 dark:text-blue-500 hover:underline">Roles</Link>
                                        <a href="" class="font-medium text-blue-600 mr-2 dark:text-blue-500 hover:underline">Permission</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

            </div>

        </div>

    </AuthenticatedLayout>
</template>
