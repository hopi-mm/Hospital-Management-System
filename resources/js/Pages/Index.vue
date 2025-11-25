<script setup lang="ts">
import { ref } from 'vue'

import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import Badge from '@/components/ui/Badge.vue'
import Button from '@/components/ui/Button.vue'
import Card from '@/components/ui/Card.vue'
import CardContent from '@/components/ui/CardContent.vue'
import CardDescription from '@/components/ui/CardDescription.vue'
import CardFooter from '@/components/ui/CardFooter.vue'
import CardHeader from '@/components/ui/CardHeader.vue'
import CardTitle from '@/components/ui/CardTitle.vue'
import Input from '@/components/ui/Input.vue'
import Label from '@/components/ui/Label.vue'

const stats = [
    {
        label: 'Active Patients',
        value: 148,
        change: '+12% this week',
    },
    {
        label: 'Waiting Room',
        value: 24,
        change: 'Avg. wait 08m',
    },
    {
        label: 'ICU Occupancy',
        value: '68%',
        change: '4 beds remaining',
    },
]

const appointments = [
    {
        patient: 'Miles Carson',
        time: '09:15',
        doctor: 'Dr. Nguyen',
        type: 'Checkup',
    },
    {
        patient: 'Selena Hart',
        time: '10:30',
        doctor: 'Dr. Patel',
        type: 'Cardiology',
    },
    {
        patient: 'Jordan Kent',
        time: '11:10',
        doctor: 'Dr. Alvarez',
        type: 'Surgery consult',
    },
    {
        patient: 'Dana Riggs',
        time: '13:45',
        doctor: 'Dr. Osei',
        type: 'Orthopedics',
    },
]

const labs = [
    { title: 'CMP Panel', status: 'Completed', eta: '08:20' },
    { title: 'CBC w/ Diff', status: 'Processing', eta: '09:05' },
    { title: 'MRI Brain', status: 'Scheduled', eta: '14:40' },
]

const filters = ref({
    schedule: '',
})
</script>

<template>
    <DashboardLayout>
        <section class="grid gap-6 lg:grid-cols-3">
            <Card
                v-for="stat in stats"
                :key="stat.label"
                class="p-5"
            >
                <CardHeader class="p-0">
                    <CardDescription class="uppercase tracking-[0.35em] text-xs">
                        {{ stat.label }}
                    </CardDescription>
                    <CardTitle class="mt-3 text-4xl">
                        {{ stat.value }}
                    </CardTitle>
                    <p class="text-xs font-medium text-emerald-600">
                        {{ stat.change }}
                    </p>
                </CardHeader>
            </Card>
        </section>

        <section class="grid gap-6 lg:grid-cols-[minmax(0,_2fr)_minmax(280px,_1fr)]">
            <Card>
                <CardHeader class="flex flex-wrap items-center gap-4">
                    <div>
                        <CardDescription class="uppercase tracking-[0.35em]">
                            Today
                        </CardDescription>
                        <CardTitle>Appointment Schedule</CardTitle>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-3">
                        <div class="flex flex-col gap-1">
                            <Label class="sr-only" for="schedule-search">
                                Search appointments
                            </Label>
                            <Input
                                id="schedule-search"
                                v-model="filters.schedule"
                                placeholder="Search patient"
                                icon
                                class="max-w-sm"
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
                        <Button variant="secondary">Export</Button>
                        <Button size="sm">Add slot</Button>
                    </div>
                </CardHeader>

                <CardContent class="pt-0">
                    <ul class="divide-y divide-slate-100">
                        <li
                            v-for="appointment in appointments"
                            :key="appointment.patient"
                            class="flex flex-wrap items-center gap-4 py-4"
                        >
                            <span
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-sm font-semibold text-white"
                            >
                                {{ appointment.time }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="text-base font-semibold">
                                    {{ appointment.patient }}
                                </p>
                                <Badge variant="secondary">
                                    {{ appointment.type }}
                                </Badge>
                            </div>
                            <p class="text-sm font-medium text-slate-500">
                                {{ appointment.doctor }}
                            </p>
                            <Button size="sm" variant="ghost">Details</Button>
                        </li>
                    </ul>
                </CardContent>
            </Card>

            <aside class="flex flex-col gap-6">
                <Card>
                    <CardHeader>
                        <CardDescription class="uppercase tracking-[0.35em]">
                            Labs
                        </CardDescription>
                        <CardTitle>Diagnostic Queue</CardTitle>
                        <CardDescription>
                            Track live progress for inbound diagnostics.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <ul class="space-y-3">
                            <li
                                v-for="lab in labs"
                                :key="lab.title"
                                class="rounded-2xl border border-slate-100 px-4 py-3"
                            >
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold">
                                        {{ lab.title }}
                                    </p>
                                    <Badge
                                        :variant="
                                            lab.status === 'Completed'
                                                ? 'secondary'
                                                : lab.status === 'Processing'
                                                ? 'outline'
                                                : 'default'
                                        "
                                    >
                                        {{ lab.status }}
                                    </Badge>
                                </div>
                                <p class="text-xs text-slate-500">
                                    ETA {{ lab.eta }}
                                </p>
                            </li>
                        </ul>
                    </CardContent>
                    <CardFooter class="pt-0">
                        <Button block>Schedule new test</Button>
                    </CardFooter>
                </Card>

                <Card>
                    <CardHeader>
                        <CardDescription class="uppercase tracking-[0.35em]">
                            Shortcuts
                        </CardDescription>
                        <CardTitle>Team rituals</CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <div class="grid gap-3">
                            <Button variant="secondary" block>
                                Triaging checklist
                            </Button>
                            <Button variant="outline" block>
                                ER escalation
                            </Button>
                            <Button block>Discharge workflow</Button>
                        </div>
                    </CardContent>
                </Card>
            </aside>
        </section>
    </DashboardLayout>
</template>
