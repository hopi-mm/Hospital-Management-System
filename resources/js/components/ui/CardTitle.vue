<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const titleAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const titleClasses = computed(() =>
    cn('text-xl font-semibold leading-none tracking-tight', (attrs.class ?? '') as ClassValue),
)
</script>

<template>
    <h3 v-bind="titleAttrs" :class="titleClasses">
        <slot />
    </h3>
</template>


