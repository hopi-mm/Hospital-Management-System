<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const props = withDefaults(
    defineProps<{
        modelValue?: string | number | null
        type?: string
        disabled?: boolean
        icon?: boolean
    }>(),
    {
        modelValue: '',
        type: 'text',
        disabled: false,
        icon: false,
    },
)

const emit = defineEmits<{
    'update:modelValue': [string | number | null]
}>()

const attrs = useAttrs()

const inputAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const inputClasses = computed(() =>
    cn(
        'flex h-11 w-full rounded-xl border border-slate-200 bg-white/90 px-4 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10',
        props.icon ? 'pl-10' : '',
        props.disabled && 'cursor-not-allowed bg-slate-50 opacity-60',
        (attrs.class ?? '') as ClassValue,
    ),
)

const onInput = (event: Event) => {
    const target = event.target as HTMLInputElement
    emit('update:modelValue', target.value)
}
</script>

<template>
    <div class="relative">
        <span
            v-if="icon"
            class="pointer-events-none absolute left-4 top-1/2 inline-flex -translate-y-1/2 items-center text-slate-400"
        >
            <slot name="icon" />
        </span>
        <input
            :type="type"
            :value="modelValue ?? ''"
            :disabled="disabled"
            v-bind="inputAttrs"
            :class="inputClasses"
            @input="onInput"
        />
    </div>
</template>


