<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
        permission: Object,
        assignedRole:Object,
        roles: Object,

});

const form = useForm({
    name: '',
    roleName:''
});

const submit = () => {
    form.put(route('admin.permissions.update', props.permission)
    );
};
const submitRole = () => {
    form.post(route('admin.permissions.role', props.permission),{
        preserveScroll: true,
    }
    );
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Add Roles</h2>

        </template>
         <div class="py-12">
            <div class="max-w-md min-h-screen mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" shadow-md sm:rounded-lg">
                         <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                        {{ status }}
                                    </div>

                                    <form class="m-1" @submit.prevent="submit">
                                        <div>
                                            <InputLabel for="name" value="name" />

                                            <TextInput
                                                id="name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.name"
                                                :value="props.permission.name"
                                                autofocus
                                                autocomplete="name"
                                            />

                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                        <div class="flex items-center justify-end mt-4">

                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Update Permission
                                            </PrimaryButton>
                                        </div>
                                    </form>
                                     <div class="">
                                    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Role Permission</h2>
                                    <div  class="inline-grid grid-cols-3 gap-4">
                                    <template v-for="role in assignedRole" :key="role.name">
                                        <Link method="delete" as="button" ae :href="route('admin.permissions.roles.remove', [props.permission.id,role.id])" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                {{role.name  }}
                                        </Link>
                                    </template>
                                    </div>
                                </div>
                                <form class="m-1" @submit.prevent="submitRole">
                                        <div>
                                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                                            <select v-model="form.roleName" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected disabled>Choose a role</option>
                                                <option v-for="role in props.roles" :key="role.id" :value="role.name">{{role.name  }}</option>

                                            </select>

                                        </div>
                                        <div class="flex items-center justify-end mt-4">

                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Assign
                                            </PrimaryButton>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </AuthenticatedLayout>
</template>
