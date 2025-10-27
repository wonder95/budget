<script setup>
    import {
        DialogClose,
        DialogContent,
        DialogDescription,
        DialogOverlay,
        DialogPortal,
        DialogRoot,
        DialogTitle,
    } from 'reka-ui'
    import {computed, ref, defineExpose, watch} from 'vue';

    const props = defineProps({
       itemType: {
           type: String,
           required: true
        },
        addRoute: {
           type: String,
            required: true
        },
        updateRoute: {
            type: String,
            required: true
        },
        form: {
            type: Object, // useForm returns an object
            required: true
        },
        currentItem: {
            type: Object,
            default: null
        },
    });

    const emit = defineEmits(['closed']);

    // Local reactive state for the dialog's open/closed status
    const isOpen = ref(false);

    /**
     * Public method to open the dialog.
     * This method is exposed so the parent component can call it.
     */
    const openDialog = () => {
        isOpen.value = true;
    };

    const closeDialog = () => {
        isOpen.value = false;
        // Reset form data and errors when closing
        props.form.reset();
        props.form.clearErrors();
        emit('closed');
    };

    // Expose the openDialog method to the parent component
    defineExpose({
        openDialog,
        closeDialog
    });

    // Add the item to the db
    function addItem() {
        // Use an options object for cleaner code
        const submissionOptions = {
            preserveScroll: true,
            onSuccess: () => closeDialog(),
            onError: () => { /* keep dialog open */ }
        };

        if (isEditMode.value) {
            // 🚨 CRUCIAL FIX: Ensure route() is called correctly AND returns a string
            const updateUrl = route(props.updateRoute, props.currentItem.id).toString();

            props.form.put(updateUrl, submissionOptions);
        } else {
            // The addRoute prop passed from the parent should be a string (now fixed in Index.vue)
            props.form.post(props.addRoute, submissionOptions);
        }
    }

    //Editing
    const isEditMode = computed(() => !!props.currentItem);

    watch(() => props.currentItem, (newItem) => {
        if (newItem) {
            // Load data from the item into the form fields
            props.form.name = newItem.name;
            // You may need to update other form fields here: props.form.fieldX = newItem.fieldX
        } else {
            // Clear the form when switching to Add mode
            props.form.reset();
        }
    }, { immediate: true });
</script>

<template>
    <DialogRoot
        :open="isOpen"
        @update:open="
            isOpen = $event;
            if (!isOpen) closeDialog(); /* 🚨 4. Handle close via ESC or backdrop click */
        "
    >
        <DialogPortal>
            <DialogOverlay
                class="fixed inset-0 bg-black/50 z-50 transition-opacity duration-300"
            />

            <DialogContent
                class="
          fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
          bg-white p-6 rounded-lg shadow-2xl w-[90vw] max-w-md
          z-[51] transition-all duration-300
          data-[state=open]:animate-in data-[state=closed]:animate-out
          data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0
          data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95
          data-[state=closed]:slide-out-to-top-[5%] data-[state=open]:slide-in-from-top-[5%]
        "
            >
                <DialogTitle class="text-xl font-bold text-gray-900">
                    {{ isEditMode ? 'Edit' : 'Add New' }} {{ itemType }}
                </DialogTitle>
                <DialogDescription class="mt-2 text-sm text-gray-500">
                    Please enter the details for the new {{ itemType }}.
                </DialogDescription>

                <slot :modalForm="props.form"></slot>

                <div class="mt-6 flex justify-end space-x-3">
                    <DialogClose as-child>
                        <button
                            class="
                px-4 py-2 bg-red-600 text-white rounded-md text-sm font-medium
                hover:bg-red-700 focus:outline-none focus:ring-2
                focus:ring-red-500 focus:ring-offset-2 transition-colors
              "
                        >
                            Cancel
                        </button>
                    </DialogClose>

                    <button
                        @click="addItem" class=" px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium
              hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors"
                        :disabled="props.form.processing"
                    >
                        {{ isEditMode ? 'Save Changes' : `Add ${itemType}` }}
                    </button>
                </div>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>
