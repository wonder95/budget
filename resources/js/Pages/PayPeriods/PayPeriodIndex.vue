<script setup>
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import PageHeader from '@/Components/PageHeader.vue';
    import AddEditItemModal from '@/Components/AddEditItemModal.vue';
    import {computed, ref, onMounted} from 'vue';
    import dayjs from 'dayjs';

    const props = defineProps({
        payPeriods: Array,
    })

    const currentItem = ref(null);
    const form = useForm({
        start_date: '',
        end_date: '',
        starting_balance: 0
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

    const openEditItem = (payPeriodId) => {
        // 1. Find the item in the local list
        const payPeriodToEdit = props.payPeriods.find(c => c.id === payPeriodId);

        // 2. Set the state variable. This triggers the watcher in the modal.
        currentItem.value = payPeriodToEdit;

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
        return route('pay-periods.store').toString();
    });

    const updateRouteName = computed(() => 'pay-periods.update');
</script>

<template>
    <Head title="Pay Periods"></Head>
    <PageHeader title="Pay Periods"/>

    <div class="px-4 sm:px-6 lg:px-8 max-w-xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">A list of all your pay periods.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    @click="handleOpenDialog"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">
                    Add Pay Period
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
                                Start Date
                            </th>
                            <th scope="col"
                                class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-3 dark:text-white">
                                End Date
                            </th>
                            <th scope="col"
                                class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-3 dark:text-white">
                                Starting Balance
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Action
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Transactions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900">
                        <tr v-for="payPeriod in payPeriods" :key="payPeriod.id"
                            class="even:bg-gray-50 dark:even:bg-gray-800/50">
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ dayjs(payPeriod.start_date).format("MMM D, YYYY") }}
                            </td>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ dayjs(payPeriod.end_date).format("MMM D, YYYY") }}
                            </td>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ payPeriod.starting_balance }}
                            </td>
                            <td class="p-4 text-sm text-red-500">
                                <button @click="openEditItem(payPeriod.id)"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <Link :href="`/pay-periods/transactions/${payPeriod.start_date}`"
                                      class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                >View</Link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <AddEditItemModal
            ref="dialogRef"
            item-type="Pay Period"
            :add-route="addRouteUrl"
            :update-route="updateRouteName"
            :current-item="currentItem"
            :form="form"
            @closed="handleModalClose"
            v-slot="{ modalForm }"
        >
            <div class="flex space-x-4">
                <div class="mt-4 text-gray-700">
                    <label for="start_date">Start Date:</label>
                    <input
                        type="date"
                        id="start_date"
                        v-model="modalForm.start_date"
                        class="border rounded px-2 py-1 w-full mt-2"
                        placeholder="e.g., 2025-01-01"
                    />
                    <div v-if="modalForm.errors.start_date" class="text-sm text-red-500 mt-1">{{ modalForm.errors.start_date }}</div>                </div>
                <div class="mt-4 text-gray-700">
                    <label for="end_date">End Date:</label>
                    <input
                        type="date"
                        id="end-date"
                        v-model="modalForm.end_date"
                        class="border rounded px-2 py-1 w-full mt-2"
                        placeholder="e.g., 2025-01-01"
                    />
                    <div v-if="modalForm.errors.end_date" class="text-sm text-red-500 mt-1">{{ modalForm.errors.end_date }}</div>
                </div>
            </div>
            <div class="mt-4">
                <label for="starting-balance">Starting Balance:</label>
                <input type="number"
                     v-model.number="modalForm.starting_balance"
                     class="border rounded px-2 py-1 w-full mt-2"
                />
                <div v-if="modalForm.errors.starting_balance" class="text-sm text-red-500 mt-1">{{ modalForm.errors.starting_balance }}</div>
            </div>

        </AddEditItemModal>
    </div>
</template>
