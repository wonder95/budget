<script setup>
    import { Head } from '@inertiajs/vue3';
    import PageHeader from '@/Components/PageHeader.vue';
    import AddTransactionPopover from '@/Components/AddTransactionPopover.vue';

    defineProps({
        transactions: {
            type: Array,
            required: true
        },
        payPeriod: {
            type: Object,
            required: true
        },
        spendingCategories: {
            type: Array,
            required: true
        },
        budgetCategories: {
            type: Array,
            required: true
        }
    })


</script>

<template>
    <Head title="Pay Period Transactions"></Head>
    <PageHeader title="Pay Period Transactions"/>

    <h1 class="font-bold text-2xl">Pay Period Transactions</h1>
    <p>{{ payPeriod.start_date }} - {{ payPeriod.end_date }}</p>

    <AddTransactionPopover :budgetCategories="budgetCategories" :spendingCategories="spendingCategories"/>

</template>

