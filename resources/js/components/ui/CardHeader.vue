<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const headerAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const headerClasses = computed(() =>
    cn('flex flex-col gap-1.5 p-6', (attrs.class ?? '') as ClassValue),
)
</script>

<template>
    <div v-bind="headerAttrs" :class="headerClasses">
        <slot />
    </div>
</template>


