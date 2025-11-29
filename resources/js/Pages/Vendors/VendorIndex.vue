<script setup>
    import {Head, useForm} from '@inertiajs/vue3';
    import PageHeader from '@/Components/PageHeader.vue';
    import AddEditItemModal from '@/Components/AddEditItemModal.vue';
    import { computed, ref, onMounted } from 'vue';

    const props = defineProps({
        vendors: Array,
    })

    const currentItem = ref(null);
    const form = useForm({
        name: ''
    });

    // Create a template ref to link to the MyDialog component instance
    const dialogRef = ref(null);

    /**
     * Function to open the dialog by calling the exposed method
     * on the child component instance.
     */
    const handleOpenDialog = () => {
        currentItem.value = null;
        // Ensure the ref is available before calling the method
        if (dialogRef.value) {
            dialogRef.value.openDialog();
        }
    };

    const openEditItem = (categoryId) => {
        // 1. Find the item in the local list
        const vendorToEdit = props.vendors.find(c => c.id === categoryId);

        // 2. Set the state variable. This triggers the watcher in the modal.
        currentItem.value = vednorToEdit;

        // 3. Open the modal
        if (dialogRef.value) {
            dialogRef.value.openDialog();
        }
    };

    const handleModalClose = () => {
        // Reset the form in the parent
        form.reset();
        form.clearErrors();
        // 🚨 Reset currentItem to ensure next open is 'Add' mode
        currentItem.value = null;
    };

    const addRouteUrl = computed(() => {
        return route('vendors.store').toString();
    });

    const updateRouteName = computed(() => 'vendors.update');
</script>

<template>
    <Head title="Vendors"></Head>
    <PageHeader title="Vendors" />

    <div class="px-4 sm:px-6 lg:px-8 max-w-xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">A list of all your vendors.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    @click="handleOpenDialog"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">
                    Add Vendor
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
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900">
                        <tr v-for="vendor in vendors" :key="vendor.id"
                            class="even:bg-gray-50 dark:even:bg-gray-800/50">
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ vendor.name }}
                            </td>
<!--                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">-->
<!--                                {{ vendor.slug }}-->
<!--                            </td>-->
                            <td class="p-4 text-sm text-red-500">
                                <button @click="openEditItem(vendor.id)" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <AddEditItemModal
            ref="dialogRef"
            item-type="Vendor"
            :add-route="addRouteUrl"
            :update-route="updateRouteName"
            :current-item="currentItem"
            :form="form"
            @closed="handleModalClose"
            v-slot="{ modalForm }"
        >
            <p class="mt-4 text-gray-700 font-semibold">
                Name:
                <input
                    type="text"
                    v-model="modalForm.name"
                    class="border rounded px-2 py-1 w-full mt-2 font-semibold"
                    placeholder="e.g., Home Depot"
                />
            </p>
            <div v-if="modalForm.errors.name" class="text-sm text-red-500 mt-1">{{ modalForm.errors.name }}</div>

<!--            <div class="mt-2">-->
<!--                <label class="font-semibold" for="slug">Slug:</label>-->
<!--                <input type="text" id="slug" v-model="modalForm.slug" class="border rounded px-2 py-1 w-full mt-2" />-->
<!--            </div>-->
<!--            <div v-if="modalForm.errors.slug" class="text-sm text-red-500 mt-1">{{ modalForm.errors.slug }}</div>-->
        </AddEditItemModal>
    </div>
</template>
