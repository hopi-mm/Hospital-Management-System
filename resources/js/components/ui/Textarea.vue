<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const props = withDefaults(
    defineProps<{
        modelValue?: string | null
        disabled?: boolean
        rows?: number
    }>(),
    {
        modelValue: '',
        disabled: false,
        rows: 4,
    },
)

const emit = defineEmits<{
    'update:modelValue': [string | null]
}>()

const attrs = useAttrs()

const textareaAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const textareaClasses = computed(() =>
    cn(
        'w-full rounded-xl border border-slate-200 bg-white/90 px-4 py-3 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10',
        props.disabled && 'cursor-not-allowed opacity-60 bg-slate-50',
        (attrs.class ?? '') as ClassValue,
    ),
)

const onInput = (event: Event) => {
    const target = event.target as HTMLTextAreaElement
    emit('update:modelValue', target.value)
}
</script>

<template>
    <textarea
        :rows="rows"
        :value="modelValue ?? ''"
        :disabled="disabled"
        v-bind="textareaAttrs"
        :class="textareaClasses"
        @input="onInput"
    />
</template>


