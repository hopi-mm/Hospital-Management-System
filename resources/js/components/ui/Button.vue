<script setup lang="ts">
import { computed } from 'vue'

import { cn } from '@/lib/utils'

type ButtonVariant = 'default' | 'secondary' | 'ghost' | 'outline' | 'destructive'
type ButtonSize = 'xs' | 'sm' | 'md' | 'lg' | 'icon'

const props = withDefaults(
    defineProps<{
        variant?: ButtonVariant
        size?: ButtonSize
        type?: 'button' | 'submit' | 'reset'
        loading?: boolean
        block?: boolean
        disabled?: boolean
    }>(),
    {
        variant: 'default',
        size: 'md',
        type: 'button',
        loading: false,
        block: false,
        disabled: false,
    },
)

const emit = defineEmits<{
    click: [MouseEvent]
}>()

const variantClasses: Record<ButtonVariant, string> = {
    default:
        'bg-slate-900 text-white shadow hover:bg-slate-800 focus-visible:outline-slate-900/70',
    secondary:
        'bg-slate-100 text-slate-900 hover:bg-slate-200 focus-visible:outline-slate-200',
    outline:
        'border border-slate-200 bg-transparent text-slate-900 hover:bg-slate-100/60 focus-visible:outline-slate-200',
    ghost: 'bg-transparent text-slate-900 hover:bg-slate-100/70',
    destructive:
        'bg-rose-600 text-white shadow hover:bg-rose-500 focus-visible:outline-rose-500',
}

const sizeClasses: Record<ButtonSize, string> = {
    xs: 'h-8 rounded-lg px-3 text-xs',
    sm: 'h-9 rounded-lg px-3 text-sm',
    md: 'h-11 rounded-xl px-4 text-sm',
    lg: 'h-12 rounded-2xl px-6 text-base',
    icon: 'h-10 w-10 rounded-xl',
}

const buttonClasses = computed(() =>
    cn(
        'inline-flex items-center justify-center gap-2 font-medium tracking-tight transition-colors focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:pointer-events-none disabled:opacity-60',
        variantClasses[props.variant],
        sizeClasses[props.size],
        props.block && 'w-full',
        props.loading && 'pointer-events-none',
    ),
)

const handleClick = (event: MouseEvent) => {
    if (props.loading || props.disabled) return
    emit('click', event)
}
</script>

<template>
    <button
        :type="type"
        :class="buttonClasses"
        :disabled="disabled || loading"
        @click="handleClick"
    >
        <span
            v-if="loading"
            class="inline-flex h-4 w-4 animate-spin rounded-full border-2 border-white/70 border-r-transparent"
        />
        <slot />
    </button>
</template>


