<div>
    <h1 class="mb-2 font-extrabold text-white text-opacity-50 text-center text-xl">Choose a New Password</h1>
    <form wire:submit.prevent="resetPassword">
        <x-card class="transition-all duration-500 w-72 border border-gray-400 border-opacity-50 sm:w-96 hover:shadow-2xl transform hover:-translate-y-px">
            <x-input wire:model.defer="email" name="email" label="E-mail" />
            <div class="mt-3">
                <x-input wire:model.defer="password" type="password" name="password" label="New Password" />
            </div>
            <div class="mt-3">
                <x-input wire:model.defer="password_confirmation" type="password" name="password_confirmation" label="Confirm New Password" />
            </div>
            <div class="mt-3 text-right text-sm">
                <x-button type="submit">Update</x-button>
            </div>
        </x-card>
    </form>
</div>
