<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const contentAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const contentClasses = computed(() =>
    cn('p-6 pt-0', (attrs.class ?? '') as ClassValue),
)
</script>

<template>
    <div v-bind="contentAttrs" :class="contentClasses">
        <slot />
    </div>
</template>


