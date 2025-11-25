<script setup lang="ts">
import { computed, ref } from 'vue'

import Button from '@/components/ui/Button.vue'
import Input from '@/components/ui/Input.vue'
import Label from '@/components/ui/Label.vue'

const props = withDefaults(
    defineProps<{
        navigation?: Array<{
            label: string
            value: string
        }>
        user?: {
            name: string
            role?: string
        }
    }>(),
    {
        navigation: () => [],
        user: () => ({
            name: 'Dr. Juno Neal',
            role: 'Medical Director',
        }),
    },
)

const search = ref('')

const navItems = computed(() =>
    props.navigation.length
        ? props.navigation
        : [
              { label: 'Overview', value: 'overview' },
              { label: 'Patients', value: 'patients' },
              { label: 'Appointments', value: 'appointments' },
              { label: 'Billing', value: 'billing' },
              { label: 'Settings', value: 'settings' },
          ],
)

const active = ref(navItems.value[0]?.value ?? 'overview')
</script>

<template>
    <div class="min-h-screen bg-slate-50 text-slate-900 lg:flex">
        <aside
            class="hidden w-64 flex-col border-r border-slate-200 bg-white px-6 py-8 lg:flex"
        >
            <div class="mb-8 flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white">
                    HM
                </span>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">
                        Hospital
                    </p>
                    <p class="text-base font-semibold text-slate-900">
                        Command Center
                    </p>
                </div>
            </div>
            <nav class="flex flex-1 flex-col gap-1">
                <button
                    v-for="item in navItems"
                    :key="item.value"
                    class="w-full rounded-xl px-4 py-2.5 text-left text-sm font-medium transition"
                    :class="
                        active === item.value
                            ? 'bg-slate-900 text-white shadow'
                            : 'text-slate-600 hover:bg-slate-100'
                    "
                    @click="active = item.value"
                >
                    {{ item.label }}
                </button>
            </nav>
            <div class="mt-8 rounded-2xl bg-slate-900/90 p-4 text-white">
                <p class="text-sm text-white/80">Today's occupancy</p>
                <p class="mt-3 text-3xl font-semibold">82%</p>
                <p class="mt-1 text-xs text-white/70">Based on 320 active beds</p>
            </div>
        </aside>

        <div class="flex flex-1 flex-col">
            <header class="border-b border-slate-200 bg-white">
                <div
                    class="flex flex-wrap items-center gap-4 px-6 py-4 sm:flex-nowrap"
                >
                    <div class="min-w-0 flex-1">
                        <slot name="header">
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-500">
                                {{ navItems.find(item => item.value === active)?.label }}
                            </p>
                            <h1 class="mt-1 text-2xl font-semibold">
                                Welcome back, {{ user.name }}
                            </h1>
                            <p class="text-sm text-slate-500">
                                {{ user.role }}
                            </p>
                        </slot>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex flex-col gap-2">
                            <Label class="sr-only" for="global-search">
                                Global search
                            </Label>
                            <Input
                                id="global-search"
                                v-model="search"
                                placeholder="Quick search"
                                class="min-w-[220px]"
                                icon
                            >
                                <template #icon>
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m21 21-4.35-4.35m0-6.4a6.4 6.4 0 1 1-12.8 0 6.4 6.4 0 0 1 12.8 0Z"
                                        />
                                    </svg>
                                </template>
                            </Input>
                        </div>
                        <Button variant="ghost">Share</Button>
                        <Button>New Report</Button>
                    </div>
                </div>
            </header>

            <main class="flex flex-1 flex-col gap-6 px-6 py-6">
                <slot>
                    <p class="text-sm text-slate-500">
                        Drop your dashboard widgets into the default slot.
                    </p>
                </slot>
            </main>
        </div>
    </div>
</template>

