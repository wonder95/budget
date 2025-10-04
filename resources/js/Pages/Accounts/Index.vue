<script setup>
    import {Head, useForm} from '@inertiajs/vue3';
    import PageHeader from '@/Components/PageHeader.vue';
    import Modal from '@/Components/Modal.vue';
    import {computed, ref} from 'vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import {
        Listbox,
        ListboxButton,
        ListboxOptions,
        ListboxOption,
    } from '@headlessui/vue'

    const props = defineProps({
        accounts: Array,
    })

    let showAddAccount = ref(false)
    let action = ref('create');
    const editAccount = ref({});
    const buttonAction = computed(() => {
        return action.value === 'create' ? 'Add' : 'Update'
    })
    const closeModal = () => {
        showAddAccount.value = false;

        form.clearErrors();
        form.reset();
    };

    const form = useForm({
        name: '',
        type: ''
    });

    const accountTypes = [
        {id: 'credit', name: 'Credit'},
        {id: 'deposit', name: 'Deposit'}
    ]

    const getAccountTypeName = (typeId) => {
        const accountType = accountTypes.find(type => type.id === typeId);
        return accountType ? accountType.name : typeId;
    };

    function openAddAccount() {
        action.value = 'create';
        showAddAccount.value = true;
    }
    function openEditAccount(id) {
        action.value = 'edit';
        editAccount.value = props.accounts.find(account => account.id === id);
        form.name = editAccount.value.name;
        form.type = editAccount.value.type;
        showAddAccount.value = true;
    }

    function addUpdateAccount() {
        const url = props.action === 'create' ? '/accounts/create' : `/accounts/update/${editAccount.value.id}`;

        form.post(url, {
            preserveScroll: true,
            onSuccess: () => closeModal()
        })
    }
</script>

<template>
    <Head title="Accounts"></Head>
    <PageHeader title="Accounts"/>

    <div class="px-4 sm:px-6 lg:px-8 max-w-2xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">A list of all your accounts.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    @click="openAddAccount"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">
                    Add account
                </button>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="relative min-w-full divide-y divide-gray-300 dark:divide-white/15">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-3 dark:text-white">
                                Name
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Type
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900">
                        <tr v-for="account in props.accounts" :key="account.id"
                            class="even:bg-gray-50 dark:even:bg-gray-800/50">
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ account.name }}
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                {{ getAccountTypeName(account.type) }}
                            </td>
                            <td class="p-4 text-sm text-red-500">
                                <button @click="openEditAccount(account.id)">Edit</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <Modal :show="showAddAccount" @close="closeModal" :action="action">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Add new account
            </h2>

            <div class="mt-6 flex">
                <div class="w-3/4">
                    <InputLabel
                        for="name"
                        value="Account Name"
                    />
                    <TextInput
                        id="name"
                        ref="nameInput"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Account name"
                    />
                    <InputError :message="form.errors.name" class="mt-2"/>
                </div>

                <div class="w-1/4 ms-4">
                    <InputLabel
                        for="accountType"
                        value="Account Type"
                    />
                    <Listbox v-model="form.type">
                        <div class="relative mt-1">
                            <ListboxButton
                                id="accountType"
                                class="relative w-full cursor-pointer rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                            >
                                <span v-if="form.type" class="block truncate">{{ form.type }}</span>
                                <span v-else class="block truncate text-gray-500">Select type</span>
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </span>
                            </ListboxButton>
                            <ListboxOptions
                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            >
                                <ListboxOption
                                    v-for="accountType in accountTypes"
                                    :key="accountType.id"
                                    :value="accountType.id"
                                    v-slot="{ active, selected }"
                                >
                                    <li
                                        :class="[
                                        active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                                        'relative cursor-default select-none py-2 pl-10 pr-4'
                                    ]"
                                    >
                                        <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{ accountType.name }}</span>
                                    </li>
                                </ListboxOption>
                            </ListboxOptions>
                        </div>
                    </Listbox>
                    <InputError :message="form.errors.type" class="mt-2"/>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>
                <PrimaryButton
                    class="ms-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="addUpdateAccount"
                >
                    {{ buttonAction }} Account
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
