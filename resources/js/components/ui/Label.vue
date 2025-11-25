<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const labelAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const labelClasses = computed(() =>
    cn(
        'text-sm font-medium text-slate-700 leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70',
        (attrs.class ?? '') as ClassValue,
    ),
)
</script>

<template>
    <label v-bind="labelAttrs" :class="labelClasses">
        <slot />
    </label>
</template>


