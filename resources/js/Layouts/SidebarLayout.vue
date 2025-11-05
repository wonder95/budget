<script setup>
    import {computed, ref} from 'vue'
    import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from '@headlessui/vue'
    import {Link, usePage} from '@inertiajs/vue3'
    import {
        Bars3Icon,
        CalendarDateRangeIcon,
        ChartPieIcon,
        DocumentDuplicateIcon,
        FolderIcon,
        HomeIcon,
        UsersIcon,
        XMarkIcon,
        ChevronDoubleLeftIcon,
        PrinterIcon,
        TableCellsIcon,
        CurrencyDollarIcon
    } from '@heroicons/vue/24/outline'
    import {ToastProvider, ToastViewport} from 'reka-ui';
    import ToastContainer from '@/Components/ToastContainer.vue';

    const navigation = [
        {name: 'Dashboard', href: '/dashboard', icon: HomeIcon, current: true},
        {name: 'Accounts', href: '/accounts', icon: UsersIcon, current: false},
        {name: 'Budget Categories', href: '/budget-categories', icon: FolderIcon, current: false},
        {name: 'Spending Categories', href: '/spending-categories', icon: CurrencyDollarIcon, current: false},
        {name: 'Pay Periods', href: '/pay-periods', icon: CalendarDateRangeIcon, current: false},
        {name: 'Reports', href: '/reports', icon: ChartPieIcon, current: false},
        {name: 'Transfers', href: '/transfers', icon: ChevronDoubleLeftIcon, current: false},
    ]
    const teams = [
        {id: 1, name: 'Heroicons', href: '#', initial: 'H', current: false},
        {id: 2, name: 'Tailwind Labs', href: '#', initial: 'T', current: false},
        {id: 3, name: 'Workcation', href: '#', initial: 'W', current: false},
    ]

    const page = usePage();
    const sidebarOpen = ref(false);

    const mappedNavigation = computed(() => {
        const currentUrl = page.url // e.g., '/accounts/123'

        return navigation.map(item => {
            let isCurrent = false

            if (item.href === '/') {
                // Exact match for the root path
                isCurrent = currentUrl === '/' || currentUrl.startsWith('/dashboard')
            } else {
                // Use startsWith for sub-pages (e.g., /accounts matches /accounts/1)
                isCurrent = currentUrl.startsWith(item.href)
            }

            // A common pattern is to also check for the dashboard link if the path is exactly '/'
            if (item.href === '/dashboard') {
                isCurrent = currentUrl.startsWith('/dashboard') || currentUrl === '/'
            }

            return {
                ...item,
                current: isCurrent
            }
        })
    })
</script>

<template>
    <ToastProvider :duration="2000">
        <div>
            <TransitionRoot as="template" :show="sidebarOpen">
                <Dialog class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                                     enter-from="opacity-0" enter-to="opacity-100"
                                     leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                                     leave-to="opacity-0">
                        <div class="fixed inset-0 bg-gray-900/80"/>
                    </TransitionChild>

                    <div class="fixed inset-0 flex">
                        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                         enter-from="-translate-x-full" enter-to="translate-x-0"
                                         leave="transition ease-in-out duration-300 transform"
                                         leave-from="translate-x-0" leave-to="-translate-x-full">
                            <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                                <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                                 enter-to="opacity-100" leave="ease-in-out duration-300"
                                                 leave-from="opacity-100" leave-to="opacity-0">
                                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                        <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                            <span class="sr-only">Close sidebar</span>
                                            <XMarkIcon class="size-6 text-white" aria-hidden="true"/>
                                        </button>
                                    </div>
                                </TransitionChild>
                                <!-- Sidebar component, swap this element with another sidebar if you like -->
                                <div
                                    class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-2 ring-1 ring-white/10">
                                    <div class="flex h-16 shrink-0 items-center">
                                        <Link href="/" class="hover:cursor-pointer">
                                            <img class="h-8 w-auto"
                                                 src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                                 alt="Budget App"/>
                                        </Link>
                                    </div>
                                    <nav class="flex flex-1 flex-col">
                                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                            <li>
                                                <ul role="list" class="-mx-2 space-y-1">
                                                    <li v-for="item in mappedNavigation" :key="item.name">
                                                        <Link :href="item.href"
                                                              :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white', 'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold']">
                                                            <component :is="item.icon" class="size-6 shrink-0"
                                                                       aria-hidden="true"/>
                                                            {{ item.name }}
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <!-- Static sidebar for desktop -->
            <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6">
                    <div class="flex h-16 shrink-0 items-center">
                        <Link href="/">
                            <img class="h-8 w-auto"
                                 src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                 alt="Your Company"/>
                        </Link>
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li v-for="item in mappedNavigation" :key="item.name">
                                        <Link :href="item.href"
                                              :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white', 'group flex gap-x-3 rounded-md p-2 text-lg/6 font-semibold']">
                                            <component :is="item.icon" class="size-6 shrink-0" aria-hidden="true"/>
                                            {{ item.name }}
                                        </Link>
                                    </li>
                                </ul>
                            </li>
                            <!--                        <li class="-mx-6 mt-auto">-->
                            <!--                            <Link href="#" class="flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-gray-800">-->
                            <!--                                <img class="size-8 rounded-full bg-gray-800" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />-->
                            <!--                                <span class="sr-only">Your profile</span>-->
                            <!--                                <span aria-hidden="true">Tom Cook</span>-->
                            <!--                            </Link>-->
                            <!--                        </li>-->
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-gray-900 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
                <button type="button" class="-m-2.5 p-2.5 text-gray-400 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="size-6" aria-hidden="true"/>
                </button>
                <div class="flex-1 text-lg/6 font-semibold text-white">Dashboard</div>
                <a href="#">
                    <span class="sr-only">Your profile</span>
                    <img class="size-8 rounded-full bg-gray-800"
                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                         alt=""/>
                </a>
            </div>

            <main class="py-10 lg:pl-72">
                <div class="px-4 sm:px-6 lg:px-8">
                    <slot></slot>
                </div>
            </main>
        </div>
        <ToastContainer/>
        <ToastViewport class="fixed bottom-4 right-4 flex flex-col gap-2 p-4 z-[9999]"/>
    </ToastProvider>
</template>
