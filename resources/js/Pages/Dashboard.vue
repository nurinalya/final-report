<script setup>
import { ref, computed } from 'vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    studySessions: Array,
    mySessions: Array,
    helpRequests: Array,
    myHelpRequests: Array,
    stats: Object,
});

const page = usePage();
const flash = computed(() => page.props.flash);
const autoDismiss = ref(true);

const activeSection = ref('learner');
const searchQuery = ref('');
const showSessionModal = ref(false);
const showHelpModal = ref(false);
const editingSession = ref(null);
const editingHelp = ref(null);

const filteredSessions = computed(() => {
    if (!searchQuery.value.trim()) return props.studySessions;
    return props.studySessions.filter(s =>
        s.course_code.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const sessionForm = useForm({
    course_code: '',
    topic: '',
    type: 'study_group',
    location: '',
    session_date: '',
    session_time: '',
    max_slots: '',
});

const helpForm = useForm({
    course_code: '',
    topic: '',
    description: '',
    status: 'open',
});

const isEditingSession = computed(() => editingSession.value !== null);
const isEditingHelp = computed(() => editingHelp.value !== null);

function openCreateSession() {
    editingSession.value = null;
    sessionForm.reset();
    sessionForm.clearErrors();
    showSessionModal.value = true;
}

function openEditSession(s) {
    editingSession.value = s;
    sessionForm.reset();
    sessionForm.clearErrors();
    sessionForm.course_code = s.course_code;
    sessionForm.topic = s.topic;
    sessionForm.type = s.type;
    sessionForm.location = s.location;
    sessionForm.session_date = s.session_date;
    sessionForm.session_time = s.session_time;
    sessionForm.max_slots = String(s.max_slots);
    showSessionModal.value = true;
}

function closeSessionModal() {
    showSessionModal.value = false;
    editingSession.value = null;
    sessionForm.reset();
    sessionForm.clearErrors();
}

function submitSession() {
    if (isEditingSession.value) {
        sessionForm.put(route('sessions.update', editingSession.value.id), {
            onSuccess: () => closeSessionModal(),
        });
    } else {
        sessionForm.post(route('sessions.store'), {
            onSuccess: () => closeSessionModal(),
        });
    }
}

function confirmDeleteSession(s) {
    if (confirm(`Delete "${s.topic}"?`)) {
        router.delete(route('sessions.destroy', s.id), { preserveScroll: true });
    }
}

function joinSession(s) {
    router.post(route('sessions.join', s.id), {}, { preserveScroll: true });
}

function openCreateHelp() {
    editingHelp.value = null;
    helpForm.reset();
    helpForm.clearErrors();
    showHelpModal.value = true;
}

function openEditHelp(h) {
    editingHelp.value = h;
    helpForm.reset();
    helpForm.clearErrors();
    helpForm.course_code = h.course_code;
    helpForm.topic = h.topic;
    helpForm.description = h.description;
    helpForm.status = h.status;
    showHelpModal.value = true;
}

function closeHelpModal() {
    showHelpModal.value = false;
    editingHelp.value = null;
    helpForm.reset();
    helpForm.clearErrors();
}

function submitHelp() {
    if (isEditingHelp.value) {
        helpForm.put(route('help-requests.update', editingHelp.value.id), {
            onSuccess: () => closeHelpModal(),
        });
    } else {
        helpForm.post(route('help-requests.store'), {
            onSuccess: () => closeHelpModal(),
        });
    }
}

function confirmDeleteHelp(h) {
    if (confirm(`Delete help request "${h.topic}"?`)) {
        router.delete(route('help-requests.destroy', h.id), { preserveScroll: true });
    }
}

function formatType(t) {
    return t === 'study_group' ? 'Study Group' : 'Help Wanted';
}

function sessionStatusBadge(s) {
    if (s.available_slots === 0) return { label: 'Full', class: 'bg-red-100 text-red-700 ring-red-200' };
    if (s.status === 'in_progress') return { label: 'In-Progress', class: 'bg-amber-100 text-amber-700 ring-amber-200' };
    return { label: 'Upcoming', class: 'bg-emerald-100 text-emerald-700 ring-emerald-200' };
}

function helpStatusBadge(s) {
    if (s === 'resolved') return { label: 'Resolved', class: 'bg-gray-100 text-gray-600 ring-gray-200' };
    if (s === 'in_progress') return { label: 'In-Progress', class: 'bg-amber-100 text-amber-700 ring-amber-200' };
    return { label: 'Open', class: 'bg-emerald-100 text-emerald-700 ring-emerald-200' };
}

function formatDate(d) {
    if (!d) return '';
    const dt = new Date(d + 'T00:00:00');
    return dt.toLocaleDateString('en-MY', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Dashboard</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Welcome back, <span class="font-semibold text-brand-teal">{{ $page.props.auth.user.name }}</span>!</p>
                </div>
                <div class="flex items-center bg-gray-100 rounded-2xl p-1 shadow-inner">
                    <button
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2"
                        :class="activeSection === 'learner' ? 'bg-white text-brand-teal shadow-md ring-1 ring-brand-teal/20' : 'text-gray-500 hover:text-gray-700'"
                        @click="activeSection = 'learner'"
                    >
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                        </svg>
                        Learner
                    </button>
                    <button
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2"
                        :class="activeSection === 'host' ? 'bg-white text-brand-teal shadow-md ring-1 ring-brand-teal/20' : 'text-gray-500 hover:text-gray-700'"
                        @click="activeSection = 'host'"
                    >
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        Host
                    </button>
                    <button
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2"
                        :class="activeSection === 'help' ? 'bg-white text-brand-teal shadow-md ring-1 ring-brand-teal/20' : 'text-gray-500 hover:text-gray-700'"
                        @click="activeSection = 'help'"
                    >
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                        Help
                    </button>
                </div>
            </div>
        </template>

        <!-- Toast Notifications -->
        <div class="fixed top-4 right-4 z-50 space-y-3 max-w-sm">
            <div v-if="flash?.success" class="rounded-2xl bg-white border border-emerald-200 shadow-lg shadow-emerald-200/30 px-5 py-4 flex items-start gap-3 animate-slide-in">
                <div class="size-9 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                    <svg class="size-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-800 pt-1">{{ flash.success }}</p>
            </div>
            <div v-if="flash?.error" class="rounded-2xl bg-white border border-red-200 shadow-lg shadow-red-200/30 px-5 py-4 flex items-start gap-3 animate-slide-in">
                <div class="size-9 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="size-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-800 pt-1">{{ flash.error }}</p>
            </div>
        </div>

        <div class="py-8 space-y-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- HERO STATS -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-xl bg-brand-teal/10 flex items-center justify-center">
                                <svg class="size-6 text-brand-teal" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-gray-900">{{ stats.totalActiveGroups }}</p>
                                <p class="text-xs font-medium text-gray-500">Active Groups</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-xl bg-brand-indigo/10 flex items-center justify-center">
                                <svg class="size-6 text-brand-indigo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-gray-900">{{ stats.totalJoinedSessions }}</p>
                                <p class="text-xs font-medium text-gray-500">Joined Sessions</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-xl bg-brand-amber/10 flex items-center justify-center">
                                <svg class="size-6 text-brand-amber" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-gray-900">{{ stats.openHelpRequests }}</p>
                                <p class="text-xs font-medium text-gray-500">Open Help Requests</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center gap-4">
                            <div class="size-12 rounded-xl bg-purple-50 flex items-center justify-center">
                                <svg class="size-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-gray-900">{{ stats.trackedCourses }}</p>
                                <p class="text-xs font-medium text-gray-500">Tracked Courses</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LEARNER SECTION -->
                <div v-if="activeSection === 'learner'">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Study Groups</h3>
                        <div class="relative max-w-sm w-full">
                            <svg class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 size-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <input v-model="searchQuery" type="text" placeholder="Filter by Course Code..." class="block w-full rounded-xl border-gray-200 bg-white pl-10 pr-4 py-2.5 text-sm shadow-sm placeholder:text-gray-400 focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition" />
                        </div>
                    </div>

                    <div v-if="filteredSessions.length === 0" class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                        <svg class="mx-auto size-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <p class="mt-4 text-gray-500 font-medium">No study groups found</p>
                        <p class="text-sm text-gray-400">Try a different course code.</p>
                    </div>

                    <div v-else class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                        <div v-for="s in filteredSessions" :key="s.id" class="group bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-brand-teal/20 transition-all duration-300 overflow-hidden flex flex-col">
                            <div class="px-5 pt-5 pb-3 flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <span class="inline-flex items-center rounded-lg bg-brand-teal/10 px-3 py-1.5 text-xs font-bold text-brand-teal">{{ s.course_code }}</span>
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset" :class="sessionStatusBadge(s).class">{{ sessionStatusBadge(s).label }}</span>
                                </div>
                                <h4 class="text-base font-bold text-gray-900 leading-snug mb-3">{{ s.topic }}</h4>
                                <div class="space-y-2 text-sm text-gray-500">
                                    <div class="flex items-center gap-2">
                                        <svg class="size-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        <span>{{ s.location }}</span>
                                    </div>
                                    <div v-if="s.session_date" class="flex items-center gap-2">
                                        <svg class="size-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                        <span>{{ formatDate(s.session_date) }} {{ s.session_time ? 'at ' + s.session_time : '' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="size-4 text-gray-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <span>by <strong class="font-medium text-gray-700">{{ s.user?.name || 'Unknown' }}</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="flex gap-0.5">
                                            <span v-for="i in s.max_slots" :key="i" class="block size-2.5 rounded-full transition-all duration-300" :class="i <= s.joined_count ? 'bg-brand-teal' : 'bg-gray-200'"></span>
                                        </div>
                                        <span class="text-xs font-semibold text-gray-500">{{ s.joined_count }}/{{ s.max_slots }} joined</span>
                                    </div>
                                </div>
                                <button
                                    class="w-full rounded-xl px-4 py-2.5 text-sm font-bold shadow-sm transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                    :class="s.available_slots > 0 ? 'bg-brand-teal text-white shadow-brand-teal/20 hover:bg-brand-teal/90 hover:shadow-md' : 'bg-gray-100 text-gray-400'"
                                    :disabled="s.available_slots === 0"
                                    @click="joinSession(s)"
                                >
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                        </svg>
                                        {{ s.available_slots === 0 ? 'Session Full' : 'Join Group' }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HOST SECTION -->
                <div v-if="activeSection === 'host'">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Your Hosted Groups</h3>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-brand-teal px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-brand-teal/20 hover:bg-brand-teal/90 hover:shadow-lg transition-all duration-300" @click="openCreateSession">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Host a New Study Group
                        </button>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead>
                                    <tr class="bg-gray-50/80">
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Course</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Topic</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date / Time</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Location</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <tr v-for="s in mySessions" :key="s.id" class="hover:bg-gray-50/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center rounded-lg bg-brand-teal/10 px-2.5 py-1 text-xs font-bold text-brand-teal">{{ s.course_code }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700 max-w-[180px] truncate">{{ s.topic }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span v-if="s.session_date">{{ formatDate(s.session_date) }}<br v-if="s.session_time" /><span v-if="s.session_time" class="text-xs">{{ s.session_time }}</span></span>
                                            <span v-else class="text-gray-400">—</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-[160px] truncate">{{ s.location }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset" :class="sessionStatusBadge(s).class">{{ sessionStatusBadge(s).label }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                            <button class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-bold text-brand-indigo hover:bg-brand-indigo/5 transition" @click="openEditSession(s)">
                                                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-bold text-red-600 hover:bg-red-50 transition ml-1" @click="confirmDeleteSession(s)">
                                                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="mySessions.length === 0">
                                        <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                                            <svg class="mx-auto size-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                            </svg>
                                            <p class="font-semibold">No groups yet</p>
                                            <p class="text-sm mt-1">Click "Host a New Study Group" to get started.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- HELP WANTED SECTION -->
                <div v-if="activeSection === 'help'">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Peer Help Requests</h3>
                            <p class="text-sm text-gray-500">Browse open requests or post your own.</p>
                        </div>
                        <button class="inline-flex items-center gap-2 rounded-xl bg-brand-amber px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-brand-amber/20 hover:bg-brand-amber/90 hover:shadow-lg transition-all duration-300" @click="openCreateHelp">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Post a New Help Request
                        </button>
                    </div>

                    <div v-if="helpRequests.length === 0" class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                        <svg class="mx-auto size-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                        <p class="font-semibold text-gray-500">No help requests yet</p>
                        <p class="text-sm text-gray-400 mt-1">Be the first to post one.</p>
                    </div>

                    <div v-else class="grid gap-4 md:grid-cols-2">
                        <div v-for="h in helpRequests" :key="h.id" class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 p-5">
                            <div class="flex items-start justify-between mb-3">
                                <span class="inline-flex items-center rounded-lg bg-brand-amber/10 px-2.5 py-1 text-xs font-bold text-brand-amber">{{ h.course_code }}</span>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset" :class="helpStatusBadge(h.status).class">{{ helpStatusBadge(h.status).label }}</span>
                            </div>
                            <h4 class="text-base font-bold text-gray-900 leading-snug mb-2">{{ h.topic }}</h4>
                            <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ h.description }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-xs text-gray-400">
                                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                    </svg>
                                    <span class="font-medium">{{ h.response_count }} Peer Responses</span>
                                </div>
                                <div v-if="h.user_id === $page.props.auth.user.id" class="flex gap-1">
                                    <button class="rounded-lg px-2.5 py-1 text-xs font-semibold text-brand-indigo hover:bg-brand-indigo/5 transition" @click="openEditHelp(h)">Edit</button>
                                    <button class="rounded-lg px-2.5 py-1 text-xs font-semibold text-red-600 hover:bg-red-50 transition" @click="confirmDeleteHelp(h)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Session Create/Edit Modal -->
        <DialogModal :show="showSessionModal" @close="closeSessionModal" max-width="lg">
            <template #title>
                <span class="flex items-center gap-3">
                    <span class="size-8 rounded-lg bg-brand-teal/10 flex items-center justify-center">
                        <svg class="size-4 text-brand-teal" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </span>
                    {{ isEditingSession ? 'Edit Study Group' : 'Host a New Study Group' }}
                </span>
            </template>
            <template #content>
                <form @submit.prevent="submitSession" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="sc_course_code" value="Course Code"  />
                            <TextInput id="sc_course_code" v-model="sessionForm.course_code" type="text" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring-brand-teal/20" placeholder="e.g. INFO 3305" required />
                            <InputError :message="sessionForm.errors.course_code" />
                        </div>
                        <div>
                            <InputLabel for="sc_type" value="Session Type"  />
                            <select id="sc_type" v-model="sessionForm.type" class="mt-1.5 block w-full rounded-xl border-gray-200 shadow-sm focus:border-brand-teal focus:ring-brand-teal/20 text-sm" required>
                                <option value="study_group">Study Group</option>
                                <option value="help_wanted">Help Wanted</option>
                            </select>
                            <InputError :message="sessionForm.errors.type" />
                        </div>
                    </div>
                    <div>
                        <InputLabel for="sc_topic" value="Topic / Description"  />
                        <TextInput id="sc_topic" v-model="sessionForm.topic" type="text" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring-brand-teal/20" placeholder="e.g. Database Normalization & ER Diagrams" required />
                        <InputError :message="sessionForm.errors.topic" />
                    </div>
                    <div>
                        <InputLabel for="sc_location" value="Location / Coordinates"  />
                        <textarea id="sc_location" v-model="sessionForm.location" class="mt-1.5 block w-full rounded-xl border-gray-200 shadow-sm focus:border-brand-teal focus:ring-brand-teal/20 text-sm" placeholder="e.g. Library, Level 3 - Study Pod 4" rows="2" required></textarea>
                        <InputError :message="sessionForm.errors.location" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="sc_date" value="Date"  />
                            <TextInput id="sc_date" v-model="sessionForm.session_date" type="date" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring-brand-teal/20" required />
                            <InputError :message="sessionForm.errors.session_date" />
                        </div>
                        <div>
                            <InputLabel for="sc_time" value="Time"  />
                            <TextInput id="sc_time" v-model="sessionForm.session_time" type="time" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring-brand-teal/20" required />
                            <InputError :message="sessionForm.errors.session_time" />
                        </div>
                    </div>
                    <div>
                        <InputLabel for="sc_slots" value="Participant Limit"  />
                        <TextInput id="sc_slots" v-model="sessionForm.max_slots" type="number" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring-brand-teal/20" min="1" max="100" placeholder="e.g. 6" required />
                        <InputError :message="sessionForm.errors.max_slots" />
                    </div>
                </form>
            </template>
            <template #footer>
                <button class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-100 transition" @click="closeSessionModal">Cancel</button>
                <button class="ms-3 px-6 py-2.5 rounded-xl bg-brand-teal text-sm font-bold text-white shadow-md shadow-brand-teal/20 hover:bg-brand-teal/90 transition-all duration-300 disabled:opacity-50" :class="{ 'opacity-50': sessionForm.processing }" :disabled="sessionForm.processing" @click="submitSession">
                    {{ isEditingSession ? 'Update Group' : 'Create Group' }}
                </button>
            </template>
        </DialogModal>

        <!-- Help Request Create/Edit Modal -->
        <DialogModal :show="showHelpModal" @close="closeHelpModal" max-width="lg">
            <template #title>
                <span class="flex items-center gap-3">
                    <span class="size-8 rounded-lg bg-brand-amber/10 flex items-center justify-center">
                        <svg class="size-4 text-brand-amber" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </span>
                    {{ isEditingHelp ? 'Edit Help Request' : 'Post a New Help Request' }}
                </span>
            </template>
            <template #content>
                <form @submit.prevent="submitHelp" class="space-y-4">
                    <div v-if="isEditingHelp">
                        <InputLabel for="hc_status" value="Status"  />
                        <select id="hc_status" v-model="helpForm.status" class="mt-1.5 block w-full rounded-xl border-gray-200 shadow-sm focus:border-brand-amber focus:ring-brand-amber/20 text-sm" required>
                            <option value="open">Open</option>
                            <option value="in_progress">In-Progress</option>
                            <option value="resolved">Resolved</option>
                        </select>
                        <InputError :message="helpForm.errors.status" />
                    </div>
                    <div>
                        <InputLabel for="hc_course_code" value="Course Code"  />
                        <TextInput id="hc_course_code" v-model="helpForm.course_code" type="text" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-amber focus:ring-brand-amber/20" placeholder="e.g. MATH 2100" required />
                        <InputError :message="helpForm.errors.course_code" />
                    </div>
                    <div>
                        <InputLabel for="hc_topic" value="Topic Title"  />
                        <TextInput id="hc_topic" v-model="helpForm.topic" type="text" class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-amber focus:ring-brand-amber/20" placeholder="e.g. Struggling with Integration by Parts" required />
                        <InputError :message="helpForm.errors.topic" />
                    </div>
                    <div>
                        <InputLabel for="hc_desc" value="Issue Description"  />
                        <textarea id="hc_desc" v-model="helpForm.description" class="mt-1.5 block w-full rounded-xl border-gray-200 shadow-sm focus:border-brand-amber focus:ring-brand-amber/20 text-sm" placeholder="Describe what you need help with..." rows="4" required></textarea>
                        <InputError :message="helpForm.errors.description" />
                    </div>
                </form>
            </template>
            <template #footer>
                <button class="px-5 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-100 transition" @click="closeHelpModal">Cancel</button>
                <button class="ms-3 px-6 py-2.5 rounded-xl bg-brand-amber text-sm font-bold text-white shadow-md shadow-brand-amber/20 hover:bg-brand-amber/90 transition-all duration-300 disabled:opacity-50" :class="{ 'opacity-50': helpForm.processing }" :disabled="helpForm.processing" @click="submitHelp">
                    {{ isEditingHelp ? 'Update Request' : 'Post Request' }}
                </button>
            </template>
        </DialogModal>
    </AppLayout>
</template>
