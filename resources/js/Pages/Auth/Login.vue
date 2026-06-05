<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-surface">
        <div class="mb-6 text-center">
            <div class="mx-auto flex items-center justify-center">
                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-lg">
                    <rect width="72" height="72" rx="20" fill="#0D9488" />
                    <path d="M24 48V32l12-6 12 6v16l-12 6-12-6z" fill="white" />
                    <path d="M24 32l12 6 12-6" fill="#0D9488" stroke="white" stroke-width="2" />
                    <path d="M36 38v9" stroke="white" stroke-width="2.5" stroke-linecap="round" />
                    <circle cx="36" cy="27" r="3.5" fill="white" />
                    <path d="M52 32a4.5 4.5 0 0 1 4.5 4.5v3l-3.5 1.8-3.5-1.8v-3A4.5 4.5 0 0 1 52 32z" fill="white" opacity="0.85" />
                    <path d="M20 32a4.5 4.5 0 0 0-4.5 4.5v3l3.5 1.8 3.5-1.8v-3A4.5 4.5 0 0 0 20 32z" fill="white" opacity="0.85" />
                    <path d="M30 16l6-3 6 3" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h1 class="mt-5 text-3xl font-extrabold text-brand-teal tracking-tight">StudyBuddy</h1>
            <p class="mt-1 text-sm font-semibold text-brand-indigo">Connect. Collaborate. Succeed Together.</p>
            <p class="mt-1 text-xs text-gray-500 max-w-xs mx-auto">Your campus hub for peer-to-peer academic support and mental well-being collaboration.</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-7 bg-white shadow-xl shadow-gray-200/50 sm:rounded-2xl border border-gray-100">
            <div v-if="status" class="mb-4 rounded-lg bg-emerald-50 border border-emerald-200 px-4 py-2.5 text-sm font-medium text-emerald-700">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-5">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1.5 block w-full rounded-xl border-gray-200 focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between mt-5">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-brand-teal hover:text-brand-teal/80 font-medium underline underline-offset-2 transition-colors">
                        Forgot password?
                    </Link>
                </div>

                <div class="mt-6">
                    <PrimaryButton
                        class="w-full justify-center rounded-xl bg-brand-teal px-4 py-3 text-sm font-bold text-white shadow-md shadow-brand-teal/20 hover:bg-brand-teal/90 focus:ring-brand-teal transition-all duration-300"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 size-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                        </svg>
                        Log in
                    </PrimaryButton>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                Don't have an account?
                <Link :href="route('register')" class="text-brand-indigo hover:text-brand-indigo/80 font-semibold underline underline-offset-2 transition-colors">Sign up</Link>
            </p>
        </div>

        <p class="mt-6 text-xs text-gray-400">BIIT 2305 — Web Application Development &middot; Section 1</p>
    </div>
</template>
