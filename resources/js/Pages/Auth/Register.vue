<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    matric_number: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-surface dark:bg-slate-900">
        <div class="mb-6 text-center">
            <div class="mx-auto flex items-center justify-center">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-lg">
                    <rect width="64" height="64" rx="18" fill="#0D9488" />
                    <path d="M22 42V28l10-5 10 5v14l-10 5-10-5z" fill="white" />
                    <path d="M22 28l10 5 10-5" fill="#0D9488" stroke="white" stroke-width="2" />
                    <path d="M32 33v8" stroke="white" stroke-width="2.2" stroke-linecap="round" />
                    <circle cx="32" cy="24" r="3" fill="white" />
                    <path d="M46 28a4 4 0 0 1 4 4v3l-3 1.5-3-1.5v-3a4 4 0 0 1 1-4z" fill="white" opacity="0.8" />
                    <path d="M18 28a4 4 0 0 0-4 4v3l3 1.5 3-1.5v-3a4 4 0 0 0-1-4z" fill="white" opacity="0.8" />
                    <path d="M28 14l4-2 4 2" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1 class="mt-4 text-3xl font-extrabold text-brand-teal dark:text-teal-400 tracking-tight">StudyBuddy</h1>
            <p class="mt-1 text-sm font-semibold text-brand-indigo dark:text-indigo-400">Create your account</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-7 bg-white dark:bg-slate-800 shadow-xl shadow-gray-200/50 dark:shadow-slate-950/50 sm:rounded-2xl border border-gray-100 dark:border-slate-700">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <InputLabel for="name" value="Full Name" class="dark:text-slate-300" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        placeholder="e.g. Alex Johnson"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="matric_number" value="Matric Number" class="dark:text-slate-300" />
                    <TextInput
                        id="matric_number"
                        v-model="form.matric_number"
                        type="text"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        placeholder="e.g. 2410123"
                        required
                        autocomplete="off"
                    />
                    <InputError class="mt-2" :message="form.errors.matric_number" />
                </div>

                <div>
                    <InputLabel for="email" value="Student Email" class="dark:text-slate-300" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        placeholder="you@student.edu"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="password" value="Password" class="dark:text-slate-300" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        placeholder="Min. 8 characters"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div>
                    <InputLabel for="password_confirmation" value="Confirm Password" class="dark:text-slate-300" />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        placeholder="Re-enter your password"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-2">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required class="dark:border-slate-600" />
                            <div class="ms-2 text-sm text-gray-600 dark:text-slate-300">
                                I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-brand-teal dark:text-teal-400 hover:text-brand-teal/80 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-teal">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-brand-teal dark:text-teal-400 hover:text-brand-teal/80 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-teal">Privacy Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="mt-6">
                    <button
                        class="w-full inline-flex items-center justify-center rounded-xl bg-brand-teal px-4 py-3 text-sm font-bold text-white shadow-md shadow-brand-teal/20 hover:bg-brand-teal/90 focus:outline-none focus:ring-2 focus:ring-brand-teal/50 transition-all duration-300 disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 size-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                        </svg>
                        <svg v-else class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Create Account
                    </button>
                </div>
            </form>


            <div class="mt-6 pt-5 border-t border-gray-100 dark:border-slate-700/50">
                <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                    Already registered?
                </p>
                <Link :href="route('login')" class="mt-3 w-full inline-flex items-center justify-center rounded-xl border border-brand-indigo/30 dark:border-indigo-500/30 bg-brand-indigo/5 dark:bg-indigo-500/10 px-4 py-2.5 text-sm font-semibold text-brand-indigo dark:text-indigo-400 hover:bg-brand-indigo/10 dark:hover:bg-indigo-500/20 transition-all duration-200">
                    <svg class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Log in
                </Link>
            </div>
        </div>

        <p class="mt-6 text-xs text-gray-400 dark:text-slate-500">BIIT 2305 — Web Application Development &middot; Section 3</p>
    </div>
</template>
