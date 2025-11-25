<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const descriptionAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const descriptionClasses = computed(() =>
    cn('text-sm text-slate-500', (attrs.class ?? '') as ClassValue),
)
</script>

<template>
    <p v-bind="descriptionAttrs" :class="descriptionClasses">
        <slot />
    </p>
</template>


