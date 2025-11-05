import { ref } from 'vue';

// Array to hold all active toast instances globally
const toasts = ref([]);
let id = 0;

/**
 * Creates and opens a new toast notification.
 * This is the function other components will call.
 */
export const openToast = (title, description, variant = 'success', action = null) => {
    id++;
    const newToast = {
        id,
        title,
        description,
        variant,
        actionHandler: action ? action.handler : null,
        actionText: action ? action.text : null,
    };
    toasts.value.push(newToast);
};

/**
 * Function to remove a toast from the array (used internally by ToastContainer.vue).
 */
export const closeToast = (idToRemove) => {
    toasts.value = toasts.value.filter(t => t.id !== idToRemove);
};

/**
 * The main composable function.
 * Other components will only need to import `openToast` directly.
 * ToastContainer.vue will import all three.
 */
export function useToast() {
    return {
        toasts,
        openToast,
        closeToast,
    };
}
