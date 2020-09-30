<div>
    <h1 class="mb-2 font-extrabold text-white text-opacity-50 text-center text-xl">Register an Account</h1>
    <form wire:submit.prevent="register">
        <x-card class="transition-all duration-500 w-72 border border-gray-400 border-opacity-50 sm:w-96 hover:shadow-2xl transform hover:-translate-y-px">
            <div class="">
                <x-input wire:model.defer="name" name="name" label="Your Name" placeholder="Your Name" />
            </div>
            <div class="mt-2">
                <x-input wire:model="email" name="email" label="Email" placeholder="you@example.com" />
            </div>
            <div class="mt-2">
                <x-input wire:model.defer="password" type="password" name="password" label="Password" placeholder="Password" />
            </div>
            <div class="mt-2">
                <x-input wire:model.defer="password_confirmation" type="password" name="password_confirmation" label="Confirm Password" placeholder="Confirm Password" />
            </div>
            <div class="mt-3 flex justify-between items-center">
                <div class="text-xs font-medium">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-primary-500">Back to Login</a>
                </div>
                <div class="text-right">
                    <x-button type="submit">Register</x-button>
                </div>
            </div>
        </x-card>
    </form>
</div>