<script setup>
import {Head} from '@inertiajs/vue3';
import PageHeader from '@/Components/PageHeader.vue';
import {computed} from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
})

const pageTitle = computed(() => {
    return `Spending Categories - ${props.category.name}`;
});
</script>

<template>
    <Head :title="pageTitle"></Head>
    <PageHeader :title="pageTitle" />

    <h1 class="text-2xl font-bold">{{ category.name }}</h1>
</template>

