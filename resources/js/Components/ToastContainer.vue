<script setup>
    import {
        ToastRoot,
        ToastTitle,
        ToastDescription,
        ToastClose,
        ToastAction,
    } from 'reka-ui';

    // 🚀 Import the state and functions from the new composable
    import { useToast } from '@/Composables/useToast';

    // Destructure the global state and the internal close function
    const { toasts, closeToast } = useToast();

    // Helper for dynamic variant classes
    const getVariantClasses = (variant) => {
        switch (variant) {
            case 'success':
                return 'bg-green-600 text-white border border-green-700';
            case 'error':
                return 'bg-red-600 text-white border border-red-700';
            case 'warning':
                return 'bg-yellow-500 text-gray-900 border border-yellow-600';
            default:
                return 'bg-gray-800 text-white border border-gray-700';
        }
    };
</script>

<template>
    <!-- We render a ToastRoot for every active toast in the array -->
    <ToastRoot
        v-for="toast in toasts"
        :key="toast.id"
        :class="getVariantClasses(toast.variant)"
        class="flex items-center justify-between p-3 rounded-lg shadow-xl"
        @update:open="(open) => !open && closeToast(toast.id)"
    >
    <!-- Content Area -->
    <div class="flex flex-col gap-0.5">
        <!-- Title Prop -->
        <ToastTitle class="font-semibold text-base">
            {{ toast.title }}
        </ToastTitle>

        <!-- Description Slot -->
        <ToastDescription class="text-sm opacity-90">
            {{ toast.description }}
        </ToastDescription>
    </div>

    <!-- Optional: Toast Action Button -->
    <ToastAction v-if="toast.actionText" as-child altText="Action button" class="ml-4">
        <button
            class="inline-flex items-center justify-center rounded-md font-medium text-xs px-[10px] leading-[25px] h-[25px]
                       bg-white/10 text-white/90 shadow-[inset_0_0_0_1px] shadow-white/30
                       hover:bg-white/20 hover:shadow-white/50 focus:ring-2 focus:ring-white"
            @click="() => toast.actionHandler && toast.actionHandler()"
        >
            {{ toast.actionText }}
        </button>
    </ToastAction>

    <!-- Close Button -->
    <ToastClose
        aria-label="Close"
        class="ml-4 p-1 rounded-full text-white/70 hover:text-white hover:bg-white/20 transition-colors"
    >
        <span aria-hidden="true">&times;</span>
    </ToastClose>
    </ToastRoot>
</template>
