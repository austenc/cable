<x-layouts.app>
    <div class="flex h-screen items-center justify-center text-white text-5xl font-bold bg-gradient-to-br from-primary-600 to-secondary-200">
        <div class="text-center">
            <div class="mb-20">
                <x-logo class="mx-auto text-white text-opacity-50" />
            </div>
            @auth
                <div>
                    Hello, {{ auth()->user()->name }}!
                </div>
                <div class="font-medium mt-8 text-3xl opacity-75">
                    You are now logged in. 
                    <div class="mt-10 flex justify-center space-x-4 text-base">
                        <a href="{{ route('profile') }}">
                            <x-button>Your Profile</x-button>
                        </a>
                        <livewire:logout />
                    </div>
                </div>
            @else
                <div>
                    Welcome to your new app.
                </div>
                <div class="mt-16 flex justify-between text-3xl font-medium">
                    <a href="{{ route('login') }}" class="opacity-75 hover:opacity-100">Log In</a>
                    <a href="{{ route('register') }}" class="opacity-75 hover:opacity-100">Register</a>
                </div>
            @endauth
        </div>
    </div>
</x-layouts.app>