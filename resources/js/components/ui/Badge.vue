<script setup lang="ts">
import { computed } from 'vue'

import { cn } from '@/lib/utils'

type BadgeVariant = 'default' | 'secondary' | 'destructive' | 'outline'

const props = withDefaults(
    defineProps<{
        variant?: BadgeVariant
    }>(),
    {
        variant: 'default',
    },
)

const variantClasses: Record<BadgeVariant, string> = {
    default: 'bg-slate-900 text-white',
    secondary: 'bg-slate-100 text-slate-900',
    destructive: 'bg-rose-100 text-rose-700',
    outline: 'border border-slate-200 text-slate-900',
}

const badgeClasses = computed(() =>
    cn(
        'inline-flex items-center rounded-full px-3 py-1 text-xs font-medium capitalize',
        variantClasses[props.variant],
    ),
)
</script>

<template>
    <span :class="badgeClasses">
        <slot />
    </span>
</template>


