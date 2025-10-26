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
    import {ref, defineExpose} from 'vue';

    const props = defineProps({
       itemType: {
           type: String,
           required: true
        },
        addRoute: {
           type: String,
            required: true
        },
        form: {
            type: Object, // useForm returns an object
            required: true
        }
    })

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
    };

    // Expose the openDialog method to the parent component
    defineExpose({
        openDialog,
        closeDialog
    });

    // Add the item to the db
    function addItem() {
        props.form.post(props.addRoute, {
            preserveScroll: true,
            onSuccess: () => closeDialog(),
            onError: () => {
                // Keep the dialog open, errors will display via form.errors
            },
        })
    }
</script>

<template>
    <DialogRoot :open="isOpen" @update:open="isOpen = $event" v-slot="{ close }">
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
                    Add New {{ itemType }}
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
                        Add {{ itemType }}
                    </button>
                </div>
            </DialogContent>
        </DialogPortal>
    </DialogRoot>
</template>
