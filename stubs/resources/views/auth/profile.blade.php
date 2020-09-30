<div class="container">
    <div class="mt-8">
        <x-card>
            <form wire:submit.prevent="save">
                <div class="md:flex space-y-4 md:space-y-0">
                    <div class="md:w-1/3 space-y-1 border-b border-gray-200 md:border-0">
                        <div class="text-lg font-semibold">
                            Information
                        </div>
                        <div class="text-gray-500 text-opacity-75 pb-2 text-sm">Your personal information</div>
                    </div>
                    <div class="md:w-2/3 space-y-3">
                        <div class="space-y-3 lg:space-y-0 lg:flex lg:space-x-3">
                            <div class="flex-1">
                                <x-input name="user.name" wire:model.defer="user.name" label="Your Name" />
                            </div>
                            <div class="flex-1">
                                <x-input name="user.email" wire:model="user.email" label="Email" />
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="md:flex space-y-4 md:space-y-0 md:border-t border-gray-200 border-opacity-50 md:mt-6 pt-6">
                    <div class="md:w-1/3 space-y-1 border-b border-gray-200 md:border-0">
                        <div class="text-lg font-semibold">
                            Change Password
                        </div>
                        <div class="text-gray-500 text-opacity-75 pb-2 text-sm">Leave the fields blank to keep it the same</div>
                    </div>
                    <div class="md:w-2/3 space-y-3">
                        <div class="space-y-3 lg:space-y-0 lg:flex lg:space-x-3">
                            <div class="flex-1">
                                <x-input type="password" name="password" wire:model.defer="password" label="New Password" />
                            </div>
                            <div class="flex-1">
                                <x-input type="password" name="password_confirmation" wire:model.defer="password_confirmation" label="Confirm New Password" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right border-t border-gray-200 border-opacity-50 mt-3 pt-3">
                    <div class="flex space-x-5 items-center justify-end">
                        <x-flash />
                        <x-button type="submit">Save Changes</x-button>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</div>