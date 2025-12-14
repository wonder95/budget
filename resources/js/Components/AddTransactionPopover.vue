<script setup>
    import dayjs from 'dayjs';
    import {useForm} from '@inertiajs/vue3';
    import {PopoverArrow, PopoverClose, PopoverContent, PopoverPortal, PopoverRoot, PopoverTrigger} from 'reka-ui'
    import {ChevronDoubleDownIcon, ChevronDoubleUpIcon} from '@heroicons/vue/16/solid/index.js';
    import SelectInput from '@/Components/SelectInput.vue';
    import { useSpendingCategories } from '@/Composables/useSpendingCategories.js';

    const props = defineProps({
        spendingCategories: {
            type: Array,
            required: true
        },
        budgetCategories: {
            type: Array,
            required: true
        }
    })

    const { getFlattenedCategories } = useSpendingCategories(props.spendingCategories);

    const form = useForm({
        date: dayjs().format("YYYY-MM-DD"),
        type: 'credit',
        vendor: '',
        description: '',
        budgetCategory: '',
        spendingCategory: '',
        credit: 0,
        debit: 0
    })
</script>

<template>
    <div class="flex justify-center">
        <PopoverRoot>
            <PopoverTrigger
                class="rounded-full w-[25px] h-[25px] inline-flex items-center justify-center text-green-500 bg-white shadow-sm border hover:bg-stone-50 cursor-default focus:shadow-[0_0_0_2px]  focus:shadow-black dark:focus:shadow-green8 focus:outline-none hover:cursor-pointer"
                aria-label="Update dimensions"
            >
                <ChevronDoubleDownIcon/>
            </PopoverTrigger>
            <PopoverPortal>
                <PopoverContent
                    side="bottom"
                    :side-offset="5"
                    class="max-w-6xl rounded-lg p-5 bg-white shadow-sm border will-change-[transform,opacity] data-[state=open]:data-[side=top]:animate-slideDownAndFade data-[state=open]:data-[side=right]:animate-slideLeftAndFade data-[state=open]:data-[side=bottom]:animate-slideUpAndFade data-[state=open]:data-[side=left]:animate-slideRightAndFade"
                >
                    <div class="flex gap-2.5">
                        <p class=" text-sm leading-[19px] font-semibold mb-2.5">
                            Add Transaction
                        </p>
                    </div>
                    <div class="flex">
                        <input
                            id="date"
                            type="date"
                            placeholder="Date"
                            v-model="form.date"
                            class="w-full inline-flex bg-stone-50 items-center justify-center flex-1 rounded outline-none"
                        >
                        <select
                            id="vendor"
                            class="w-full inline-flex bg-stone-50 items-center justify-center flex-1 rounded outline-none"
                        >
                            <option value="vendorA">Vendor A</option>
                            <option value="vendorB">Vendor B</option>
                        </select>
                        <input
                            id="credit"
                            type="number"
                            v-model.number="form.credit"
                        >
                    </div>
                    <div class="flex">
                        <select-input v-model="form.type" :error="form.errors.type"
                                class="w-full inline-flex items-center justify-center flex-1 rounded text-xs outline-none">
                            <option value="credit">Deposit</option>
                            <option value="debit">Withdrawal</option>
                        </select-input>
                        <input
                            id="description"
                            class="w-full inline-flex bg-stone-50 items-center justify-center flex-1 rounded ext-xs outline-none"
                            placeholder="Description"
                        >
                        <input
                            id="credit"
                            type="number"
                            v-model.number="form.credit"
                        >
                    </div>
                    <div class="flex">
                        <select-input
                            v-model="form.budgetCategory"
                            class="w-full inline-flex items-center justify-center flex-1 rounded text-xs outline-none"
                        >
                            <option v-for="bc in props.budgetCategories">{{ bc.name }}</option>

                        </select-input>

                        <select-input
                            v-model="form.spendingCategory"
                            class="w-full inline-flex items-center justify-center flex-1 rounded text-xs outline-none"
                        >
                            <option v-for="sc in getFlattenedCategories('select')">{{ sc.label }}</option>
                        </select-input>

                    </div>
                    <PopoverClose
                        class="rounded-full h-[25px] w-[25px] inline-flex items-center justify-center text-green-500 absolute top-[8px] right-[8px] hover:bg-green4 focus:shadow-[0_0_0_2px] focus:shadow-green7 outline-none cursor-default"
                        aria-label="Close"
                    >
                        <ChevronDoubleUpIcon/>
                    </PopoverClose>
                    <PopoverArrow class="fill-white stroke-gray-200"/>
                </PopoverContent>
            </PopoverPortal>
        </PopoverRoot>
    </div>
</template>
