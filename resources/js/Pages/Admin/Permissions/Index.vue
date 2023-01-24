<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    permissions: Object
})
</script>

<template>
    <Head title="Admin | Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Admin Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                    <Link :href="route('admin.permissions.create')"  class=" inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                        <span class=" px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                            Add Permission
                        </span>
                     </Link>
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-900 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="permission in permissions" :key="permission.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{permission.name  }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <Link :href="route('admin.permissions.edit', permission.id)" class="font-medium mr-1 text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                        <Link method="delete" as="button" ae :href="route('admin.permissions.destroy', permission.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</Link>
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
