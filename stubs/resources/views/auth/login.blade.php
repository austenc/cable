<div>
    <h1 class="mb-2 font-extrabold text-white text-opacity-50 text-center text-xl">Sign In</h1>
    <form wire:submit.prevent="login">
        <x-card class="transition-all duration-500 w-72 border border-gray-400 border-opacity-50 sm:w-96 hover:shadow-2xl transform hover:-translate-y-px">
            <div class="">
                <x-input wire:model.defer="email" name="email" label="Email" placeholder="you@example.com" />
            </div>
            <div class="mt-2">
                <x-input wire:model.defer="password" type="password" name="password" label="Password" placeholder="Password" />
            </div>
            <div class="mt-3 flex justify-between items-center">
                <div class="text-xs font-medium">
                    <a href="{{ route('password.forgot') }}" class="text-gray-500 hover:text-primary-500">Forgot Password?</a>
                </div>
                <div class="text-right text-sm">
                    <x-button type="submit">Sign In</x-button>
                </div>
            </div>
        </x-card>
        <div class="text-center mt-5 text-white text-opacity-75">
            Need an account? <a href="{{ route('register') }}" class="text-white hover:text-primary-100 font-medium">Sign up</a>
        </div>
    </form>
</div>