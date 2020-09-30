<div>
    <h1 class="mb-2 font-extrabold text-white text-opacity-50 text-center text-xl">Reset Your Password</h1>
    <form wire:submit.prevent="sendEmail">
        <x-card class="transition-all duration-500 w-72 border border-gray-400 border-opacity-50 sm:w-96 hover:shadow-2xl transform hover:-translate-y-px">
            <div x-data="{ message: @entangle('message') }" x-show.transition="message" x-cloak class="transition-all duration-300 rounded-sm mb-5 mt-1 shadow overflow-hidden">
                <div class="border-l-4 bg-primary-50 shadow-xs p-3 border-primary-500 text-primary-700" x-text="message"></div>
            </div>
            <x-input wire:model.defer="email" name="email" label="E-mail Address" />
            <div class="mt-3 text-right text-sm">
                <x-button type="submit">Send Email</x-button>
            </div>
        </x-card>
    </form>
</div>
