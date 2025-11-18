import './bootstrap';
import { config } from '@inertiajs/vue3'

// Set a single value using dot notation...
config.set('form.recentlySuccessfulDuration', 1000)
config.set('prefetch.cacheFor', '5m')

// Set multiple values at once...
config.set({
    'form.recentlySuccessfulDuration': 1000,
    'prefetch.cacheFor': '5m',
})
