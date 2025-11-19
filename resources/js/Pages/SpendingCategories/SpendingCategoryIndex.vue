<script setup>
    import { TreeItem, TreeRoot } from 'reka-ui';
    import { Head, Link } from '@inertiajs/vue3';
    import PageHeader from '@/Components/PageHeader.vue';
    import { FolderArrowDownIcon, FolderIcon, FolderMinusIcon, FolderOpenIcon } from '@heroicons/vue/24/outline';

    const props = defineProps({
        spendingCategories: Array
    })
</script>

<template>
    <Head title="Spending Categories - Tree"></Head>
    <PageHeader title="Spending Categories - Tree" />

    <TreeRoot
        v-slot="{ flattenItems }"
        class="list-none select-none w-56 bg-white text-stone-700 rounded-lg border shadow-sm p-2 text-sm font-medium"
        :items="spendingCategories"
        :get-key="(item) => item.id"
        :get-children="(item) => item.children || []"
        :default-expanded="[]"
    >
        <h2 class="font-semibold text-sm text-stone-400 px-2 pt-1 pb-3">
            Spending Categories
        </h2>
        <TreeItem
            v-for="item in flattenItems"
            v-slot="{ isExpanded }"
            :key="item.value.id"
            :style="{ 'padding-left': `${item.level}rem` }"
            v-bind="item.bind"
            class="flex items-center py-1 px-2 my-0.5 rounded outline-none focus:ring-2 focus:ring-indigo-500 data-[selected]:bg-indigo-100/50"
        >
            <template v-if="item.value.children && item.value.children.length > 0">
                <FolderArrowDownIcon
                    v-if="!isExpanded"
                    class="h-4 w-4 text-indigo-500 mr-2"
                />
                <FolderMinusIcon
                    v-else
                    class="h-4 w-4 text-indigo-500 mr-2"
                />
            </template>
            <FolderIcon
                v-else
                class="h-4 w-4 text-gray-500 mr-2"
            />
            <div class="pl-2">
                <template v-if="item.value.children && item.value.children.length > 0">
                    {{ item.value.name }}
                </template>
                <Link
                    v-else
                    :href="route('spending-categories.show', {category: item.value.slug})"
                    class="hover:text-indigo-600 dark:hover:text-indigo-400"
                >
                    {{ item.value.name }}
                </Link>
            </div>
        </TreeItem>
    </TreeRoot>
</template>
