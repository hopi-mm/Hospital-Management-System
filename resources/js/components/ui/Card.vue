<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const cardAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const cardClasses = computed(() =>
    cn(
        'rounded-3xl border border-slate-200 bg-white/90 shadow-sm',
        (attrs.class ?? '') as ClassValue,
    ),
)
</script>

<template>
    <div v-bind="cardAttrs" :class="cardClasses">
        <slot />
    </div>
</template>


