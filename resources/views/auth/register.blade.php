@extends('layouts.guest')

@section('title', 'Register')

@section('auth-content')
<div class="w-full sm:max-w-md px-8 py-7 bg-white dark:bg-slate-800 shadow-xl shadow-gray-200/50 dark:shadow-slate-950/50 sm:rounded-2xl border border-gray-100 dark:border-slate-700">
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Full Name</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                placeholder="e.g. Alex Johnson"
                required
                autofocus
                autocomplete="name"
            />
            @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="matric_number" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Matric Number</label>
            <input
                id="matric_number"
                type="text"
                name="matric_number"
                value="{{ old('matric_number') }}"
                class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                placeholder="e.g. 2410123"
                required
                autocomplete="off"
            />
            @error('matric_number')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Student Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                placeholder="you@student.edu"
                required
                autocomplete="username"
            />
            @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                placeholder="Min. 8 characters"
                required
                autocomplete="new-password"
            />
            @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Confirm Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                placeholder="Re-enter your password"
                required
                autocomplete="new-password"
            />
            @error('password_confirmation')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mt-2">
            <label class="flex items-center">
                <input type="checkbox" name="terms" id="terms" class="rounded border-gray-300 dark:border-slate-600 text-brand-teal focus:ring-brand-teal/30 dark:bg-slate-700" required />
                <span class="ms-2 text-sm text-gray-600 dark:text-slate-300">
                    I agree to the <a href="{{ route('terms.show') }}" target="_blank" class="underline text-brand-teal dark:text-teal-400 hover:text-brand-teal/80">Terms of Service</a> and <a href="{{ route('policy.show') }}" target="_blank" class="underline text-brand-teal dark:text-teal-400 hover:text-brand-teal/80">Privacy Policy</a>
                </span>
            </label>
            @error('terms')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        @endif

        <div class="mt-6">
            <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-brand-teal px-4 py-3 text-sm font-bold text-white shadow-md shadow-brand-teal/20 hover:bg-brand-teal/90 focus:outline-none focus:ring-2 focus:ring-brand-teal/50 transition-all duration-300">
                <svg class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
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
        <a href="{{ route('login') }}" class="mt-3 w-full inline-flex items-center justify-center rounded-xl border border-brand-indigo/30 dark:border-indigo-500/30 bg-brand-indigo/5 dark:bg-indigo-500/10 px-4 py-2.5 text-sm font-semibold text-brand-indigo dark:text-indigo-400 hover:bg-brand-indigo/10 dark:hover:bg-indigo-500/20 transition-all duration-200">
            <svg class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            Log in
        </a>
    </div>
</div>
@endsection
