<template>
    <div :class="$attrs.class">
        <label v-if="label" class="block font-semibold"  :class="{ 'text-gray-400': disabled }" :for="id">{{ label }}:</label>
        <select
            :id="id"
            ref="input"
            v-model="selected"
            v-bind="{ ...$attrs, class: null }"
            class="rounded-md w-full border border-gray-500 disabled:text-gray-400 bg-white p-2"
            :class="{ error: error }"
            :disabled="disabled"
            :required="required"
        >
            <slot />
        </select>
        <div v-if="error" class="text-red-700 mt-2 text-sm">{{ error }}</div>
    </div>
</template>

<script>
    import { v4 as uuid } from 'uuid'

    export default {
        inheritAttrs: false,
        props: {
            id: {
                type: String,
                default() {
                    return `select-input-${uuid()}`
                },
            },
            error: String,
            label: String,
            modelValue: [String, Number, Boolean],
            disabled: 'false',
            required: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        emits: ['update:modelValue'],
        computed: {
            selected: {
                get() {
                    return this.modelValue
                },
                set(newValue) {
                    this.$emit('update:modelValue', newValue)
                }
            }
        },
        methods: {
            focus() {
                this.$refs.input.focus()
            },
            select() {
                this.$refs.input.select()
            },
        },
    }
</script>
