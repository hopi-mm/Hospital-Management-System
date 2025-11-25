<script setup lang="ts">
import { computed, useAttrs } from 'vue'
import type { ClassValue } from 'clsx'

import { cn } from '@/lib/utils'

defineOptions({ inheritAttrs: false })

const attrs = useAttrs()

const footerAttrs = computed(() => {
    const { class: _class, ...rest } = attrs
    return rest
})

const footerClasses = computed(() =>
    cn('flex items-center p-6 pt-0', (attrs.class ?? '') as ClassValue),
)
</script>

<template>
    <div v-bind="footerAttrs" :class="footerClasses">
        <slot />
    </div>
</template>


