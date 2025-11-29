<script setup>
    import {Head, useForm} from '@inertiajs/vue3';
    import { computed } from 'vue';
    import PageHeader from '@/Components/PageHeader.vue';
    import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    account: Object
})

const form = useForm({
    vendor: '',
    description: ''
})

const headerTitle = computed(() => {
    return 'Register - ' + props.account.name;
})

</script>

<template>
    <Head title="Spending Categories "></Head>
    <PageHeader :title="headerTitle" />

    <h1 class="font-bold text-2xl">Register</h1>

    <details class="max-w-2xl">
        <summary class=" p-2 border border-black rounded-md">Add Entry</summary>
        <div class="bg-blue-200 border border-slate-300">
            <label for="vendor">Vendor</label>
            <TextInput
              type="text"
              id="vendor"
              v-model="form.vendor"
              class=""
              placeholder="Select vendor"
            />
            <label for="description">Description</label>
            <input type="text" id="description">
        </div>
    </details>
</template>
