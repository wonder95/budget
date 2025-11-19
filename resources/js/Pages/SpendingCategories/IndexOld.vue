<script setup>
    import {Head, Link, useForm} from '@inertiajs/vue3';
    import PageHeader from '@/Components/PageHeader.vue';
    import AddEditItemModal from '@/Components/AddEditItemModal.vue';
    import { computed, ref, onMounted } from 'vue';
    import {
        SelectContent,
        SelectIcon,
        SelectItem,
        SelectItemIndicator,
        SelectItemText, // Used to render the text content of the item
        SelectPortal,
        SelectRoot,
        SelectScrollDownButton,
        SelectScrollUpButton,
        SelectTrigger,
        SelectValue,
        SelectViewport,
    } from 'reka-ui'

    const props = defineProps({
        spendingCategories: Array
    })

    const currentItem = ref(null);
    const form = useForm({
        name: '',
        slug: '',
        description: '',
        parent_id: '',
    });

    // Create a template ref to link to the MyDialog component instance
    const dialogRef = ref(null);

    /**
     * Recursive helper function to flatten the category tree into a list of options.
     * @param {Array} categories - The current array of categories/children to process.
     * @param {number} depth - The current depth level for indentation (starts at 0).
     * @param {Array} optionsArray - The array being built (passed by reference).
     * @param {string} location - 'select' or 'table'.
     */
    const flattenCategories = (categories, depth, optionsArray, location) => {
        categories.forEach(category => {
            let item = {
                id: category.id,
                name: category.name,
                slug: category.slug,
            };

            // --- CORE FIX: Define the label based on location ---

            // if (location === 'select') {
                let label = category.name;

                // 1. Calculate the prefix for visual hierarchy
                if (depth > 0) {
                    // Use two spaces per level for deeper indentation
                    const prefix = '  '.repeat(depth) + '- ';
                    label = prefix + category.name;
                }

                // Add keys required by the Reka-UI Select component
                item.label = label;
                item.value = category.id;
            // }

            // 2. Push the item to the final array for both 'select' and 'table'
            optionsArray.push(item);

            // 3. Recurse for children, increasing the depth
            if (category.children && category.children.length > 0) {
                // Pass the location argument down in the recursion
                flattenCategories(category.children, depth + 1, optionsArray, location);
            }
        });
    };

    // ... (rest of the script, including getFlattenedCategories computed) ...

    /**
     * Computed property that returns a function.
     */
    const getFlattenedCategories = computed(() => {
        // Return a function that accepts the location
        return (location = 'select') => {
            const options = [];

            // 1. Only add the 'No Parent' option if location is 'select'
            if (location === 'select') {
                // Ensure the 'No Parent' item uses the correct keys (value/label)
                options.push({ value: null, label: 'No Parent (Top Level)' });
            }

            // 2. Start the recursive flattening process at depth 0
            // props.spendingCategories is the array of top-level items (depth 0)
            flattenCategories(props.spendingCategories, 0, options, location);

            return options;
        };
    });

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
        const categoryToEdit = props.spendingCategories.find(c => c.id === categoryId);

        // 2. Set the state variable. This triggers the watcher in the modal.
        currentItem.value = categoryToEdit;

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
        return route('spending-categories.store').toString();
    });

    const updateRouteName = computed(() => 'spending-categories.update');
</script>

<template>
    <Head title="Spending Categories "></Head>
    <PageHeader title="Spending Categories" />

    <div class="px-4 sm:px-6 lg:px-8 max-w-xl">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">A list of all your spending categories.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    @click="handleOpenDialog"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 hover:cursor-pointer focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500">
                    Add Spending Category
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
                                class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-3 dark:text-white">
                                Slug
                            </th>
                            <th scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-white">Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900">
                        <tr v-for="category in getFlattenedCategories('table')" :key="category.id"
                            class="even:bg-gray-50 dark:even:bg-gray-800/50">
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ category.label }}
                            </td>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-3 dark:text-white">
                                {{ category.slug }}
                            </td>
                            <td class="p-4 text-sm text-red-500">
                                <button @click="openEditItem(category.id)" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <AddEditItemModal
            ref="dialogRef"
            item-type="Spending Category"
            :add-route="addRouteUrl"
            :update-route="updateRouteName"
            :current-item="currentItem"
            :form="form"
            @closed="handleModalClose"
            v-slot="{ modalForm }"
        >
            <p class="mt-4 text-gray-700">
                Name:
                <input
                    type="text"
                    v-model="modalForm.name"
                    class="border rounded px-2 py-1 w-full mt-2"
                    placeholder="e.g., Groceries, Entertainment"
                />
            </p>
            <div v-if="modalForm.errors.name" class="text-sm text-red-500 mt-1">{{ modalForm.errors.name }}</div>

            <div class="mt-2">
                <label class="font-semibold" for="slug">Slug:</label>
                <input type="text" id="slug" v-model="modalForm.slug" class="border rounded px-2 py-1 w-full mt-2" />
            </div>
            <div v-if="modalForm.errors.slug" class="text-sm text-red-500 mt-1">{{ modalForm.errors.slug }}</div>

            <div class="mt-2">
                <label class="font-semibold" for="slug">Description:</label>
                <input type="text" id="description" v-model="modalForm.description" class="border rounded px-2 py-1 w-full mt-2" />
            </div>
            <div v-if="modalForm.errors.description" class="text-sm text-red-500 mt-1">{{ modalForm.errors.description }}</div>

            <div class="mt-4">
                <label class="font-semibold" for="parent">Parent Category:</label>
                <SelectRoot v-model="modalForm.parent_id">
                    <SelectTrigger
                        class="flex h-10 w-full items-center justify-between rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-3 py-2 text-sm ring-offset-white dark:ring-offset-gray-900 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                        <SelectValue placeholder="Select a parent category" />
                        <SelectIcon class="h-4 w-4 opacity-50 text-gray-900 dark:text-gray-100" />
                    </SelectTrigger>

                    <SelectPortal>
                        <SelectContent
                            class="z-[9999] min-w-[var(--reka-select-trigger-width)] overflow-hidden rounded-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-lg"
                        >
                            <SelectScrollUpButton />
                            <SelectViewport class="p-1">
                                <SelectItem
                                    v-for="option in getFlattenedCategories('select')"
                                    :key="option.value"
                                    :value="option.value"
                                    class="relative flex cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none text-gray-900 dark:text-gray-100 data-[highlighted]:bg-indigo-500 data-[highlighted]:text-white dark:data-[highlighted]:bg-indigo-600 data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                >
                                    <span class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center">
                                        <SelectItemIndicator>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-indigo-600 dark:text-indigo-400">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                        </SelectItemIndicator>
                                    </span>
                                    <SelectItemText>
                                        {{ option.label }}
                                    </SelectItemText>
                                </SelectItem>
                            </SelectViewport>
                            <SelectScrollDownButton />
                        </SelectContent>
                    </SelectPortal>
                </SelectRoot>
            </div>
            <div v-if="modalForm.errors.parent_id" class="text-sm text-red-500 mt-1">{{ modalForm.errors.parent_id }}</div>
        </AddEditItemModal>







    </div>
</template>
