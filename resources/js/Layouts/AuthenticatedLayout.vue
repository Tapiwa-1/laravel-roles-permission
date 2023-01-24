<template>
    <div v-if="$page.props.flash.message" class="p-4 text-sm text-green-700 bg-green-100  dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">Success alert!</span> {{ $page.props.flash.message }}
    </div>
    <div class="w-full bg-gray-100 dark:bg-gray-900">

        <div class="flex justify-between px-4 py-1 items-center">
            <span
        class=" text-white text-4xl top-5 left-4 cursor-pointer"
        >
            <Bars3Icon class="w-6 h-6  bg-transparent text-gray-700 dark:text-gray-100 rounded-md" @click="display =! display"/>
        </span>
        <div class="flex items-center">
            <button class="m-3" @click="toggleDark()">
            <SunIcon  v-if="isDark" class="w-6 h-6 text-gray-800 dark:text-white font-bold"/>
            <MoonIcon  v-else class="w-6 h-6 text-gray-800 dark:text-white font-bold"/>
        </button>
            <!-- Profile dropdown -->
              <Menu as="div" class="relative ml-3">
                <div>
                  <MenuButton class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">Open user menu</span>
                    <img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
                  </MenuButton>
                </div>
                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                  <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white dark:bg-gray-800 dark:text-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                      <Link :role="item.role" :href="item.href" :class="[active ? 'bg-gray-100 dark:bg-gray-900 ' : '', 'block px-4 py-2 text-sm text-gray-700 dark:text-white']">{{ item.name }}</Link>
                    </MenuItem>
                    <Link as="button" class="hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-white w-full text-left" :href="route('logout')" method="post" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Logout</Link>
                  </MenuItems>
                </transition>
              </Menu>
        </div>
        </div>
    </div>
    <div v-if="display"
      class="sidebar  absolute top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-100 dark:bg-gray-900"
    >
      <div class="text-gray-100 text-xl" >
        <div class="p-2.5 mt-1 flex items-center">
          <h1 class="font-bold text-gray-800 dark:text-gray-200 text-[15px] ml-3">Roles and Permission</h1>
          <XMarkIcon class="w-6 h-6 cursor-pointer ml-28 text-gray-900 dark:text-gray-200 " @click="display = false"/>
        </div>
        <div class="my-2 bg-gray-600 h-[1px]"></div>
      </div>

      <div v-if="$page.props.user.userRoles.includes('admin')">
            <Link :href="route('admin.index')"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-blue-100 dark:bg-gray-700 dark:hover:bg-blue-500 hover:bg-blue-600 text-white"
            >
                <HomeIcon class="h-6 w-6 text-gray-900 dark:text-gray-200 "/>
                <span class="text-[15px] ml-4 text-gray-900 dark:text-gray-200  font-bold">Admin</span>
            </Link>
            <Link :href="route('admin.roles.index')"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-blue-100 dark:bg-gray-700 dark:hover:bg-blue-500 hover:bg-blue-600 text-white"
            >
                <UserGroupIcon class="h-6 w-6 text-gray-900 dark:text-gray-200 "/>
                <span class="text-[15px] ml-4 text-gray-900 dark:text-gray-200  font-bold">Roles</span>
            </Link>
            <Link :href="route('admin.permissions.index')"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-blue-100 dark:bg-gray-700 dark:hover:bg-blue-500 hover:bg-blue-600 text-white"
            >
                <KeyIcon class="h-6 w-6 text-gray-900 dark:text-gray-200 "/>
                <span class="text-[15px] ml-4 text-gray-900 dark:text-gray-200  font-bold">Permission</span>
            </Link>
             <Link :href="route('admin.users.index')"
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-blue-100 dark:bg-gray-700 dark:hover:bg-blue-500 hover:bg-blue-600 text-white"
            >
                <UsersIcon class="h-6 w-6 text-gray-900 dark:text-gray-200 "/>
                <span class="text-[15px] ml-4 text-gray-900 dark:text-gray-200  font-bold">Users</span>
            </Link>

      </div>



    </div>
    <header class="bg-white shadow dark:bg-gray-700" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
    </header>
            <!-- Page Content -->
            <main class="dark:bg-gray-700">
                <slot />
            </main>
</template>

    <script setup>
    import { Link } from '@inertiajs/vue3';
    import { useDark, useToggle } from '@vueuse/core';
    import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import {
       HomeIcon,
       BookmarkIcon,
       ChevronDoubleDownIcon,
       LockClosedIcon,
       ChatBubbleLeftIcon,
       CursorArrowRaysIcon,
       XMarkIcon,
       Bars3Icon,
       SunIcon,
       MoonIcon,
       UserGroupIcon,
       UsersIcon,
       KeyIcon
    } from '@heroicons/vue/24/outline'
    import { ref } from 'vue';

    defineProps({
        admin: Boolean,
    })
    const isDark = useDark();
    const toggleDark = useToggle(isDark);

    const user = {
    name: 'Tom Cook',
    email: 'tom@example.com',
    imageUrl:
    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}
    const userNavigation = [
        { name: 'Dashboard', href: route('dashboard'), role: ''},
        { name: 'Settings', href: route('profile.edit'), role:''},
    ]
    let display = ref(false);
    </script>
