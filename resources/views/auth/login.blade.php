@extends('layouts.guest')

@section('title', 'Log in')

@section('auth-content')
<div class="w-full sm:max-w-md px-8 py-7 bg-white dark:bg-slate-800 shadow-xl shadow-gray-200/50 dark:shadow-slate-950/50 sm:rounded-2xl border border-gray-100 dark:border-slate-700">
    @if (session('status'))
    <div class="mb-4 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 px-4 py-2.5 text-sm font-medium text-emerald-700 dark:text-emerald-300">
        {{ session('status') }}
    </div>
    @endif

    @if ($errors->has('email') && !old('email'))
    <div class="mb-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 px-4 py-2.5 text-sm font-medium text-red-700 dark:text-red-300">
        These credentials do not match our records.
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Student ID / Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="mt-1.5 block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                placeholder="you@student.edu"
                required
                autofocus
                autocomplete="username"
            />
            @error('email')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-5">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Password</label>
            <div class="relative mt-1.5" x-data="{ show: false }">
                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    class="block w-full rounded-xl border-gray-200 dark:border-slate-600 dark:bg-slate-700 dark:text-white pr-11 focus:border-brand-teal focus:ring focus:ring-brand-teal/20 transition placeholder:text-gray-400 dark:placeholder-slate-500"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                />
                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 dark:hover:text-slate-300 transition" @click="show = !show">
                    <svg x-show="!show" class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <svg x-show="show" class="size-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </button>
            </div>
            @error('password')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-5">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 dark:border-slate-600 text-brand-teal focus:ring-brand-teal/30 dark:bg-slate-700" />
                <span class="ms-2 text-sm text-gray-600 dark:text-slate-300">Remember me</span>
            </label>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-brand-teal dark:text-teal-400 hover:text-brand-teal/80 font-medium underline underline-offset-2 transition-colors">
                Forgot password?
            </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full inline-flex items-center justify-center rounded-xl bg-brand-teal px-4 py-3 text-sm font-bold text-white shadow-md shadow-brand-teal/20 hover:bg-brand-teal/90 focus:outline-none focus:ring-2 focus:ring-brand-teal/50 transition-all duration-300">
                <svg class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
                Log in
            </button>
        </div>
    </form>


    <div class="mt-6 pt-5 border-t border-gray-100 dark:border-slate-700/50">
        <p class="text-center text-sm text-gray-500 dark:text-slate-400">
            Don't have an account?
        </p>
        <a href="{{ route('register') }}" class="mt-3 w-full inline-flex items-center justify-center rounded-xl border border-brand-indigo/30 dark:border-indigo-500/30 bg-brand-indigo/5 dark:bg-indigo-500/10 px-4 py-2.5 text-sm font-semibold text-brand-indigo dark:text-indigo-400 hover:bg-brand-indigo/10 dark:hover:bg-indigo-500/20 transition-all duration-200">
            <svg class="size-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Create your account
        </a>
    </div>
</div>
@endsection
