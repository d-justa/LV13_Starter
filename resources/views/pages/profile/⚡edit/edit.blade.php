<div>
    <div>
        <flux:heading size="xl" level="1">Manage Profile</flux:heading>
        <flux:text class="mt-2 text-base">
            <span class="font-medium">Role:</span>
            {{ Str::title(auth()->user()->getRoleNames()->first() ?? 'No Role Assigned') }}
        </flux:text>
        @env(['development', 'local'])
            <flux:text class="mt-2 mb-6 text-base">
                <span class="font-medium">User ID:</span>
                {{ Auth::id() }} (Visible on development only)
            </flux:text>
        @endenv
        <flux:separator variant="subtle" class="my-6" />
    </div>

    <div class="space-y-8">
        <flux:card class="max-w-3xl space-y-6">
            <flux:heading size="lg">Personal Info</flux:heading>
            <form wire:submit="update" class="space-y-4">
                <flux:input label="Name" wire:model="name" />
                <flux:input label="Email" wire:model="email" readonly />
                <flux:button type="submit" variant="primary">Update</flux:button>
            </form>
        </flux:card>

        <flux:card class="max-w-3xl space-y-6">
            <flux:heading size="lg">Update Password</flux:heading>
            <form wire:submit="updatePassword" class="space-y-4">
                <flux:input label="Current Password" wire:model="old_password" type="password" />
                <flux:input label="New Password" wire:model="password" type="password" />
                <flux:input label="Confirm New Password" wire:model="password_confirmation" type="password" />
                <flux:button type="submit" variant="filled">Update Password</flux:button>
            </form>
        </flux:card>

        @can('delete', Auth::user())
            <flux:card class="max-w-3xl space-y-6 bg-red-50 border border-red-200">
                <div>
                    <flux:heading size="lg" class="text-red-600">Delete Account</flux:heading>
                    <flux:text class="mt-2 text-gray-600">
                        Permanently delete your account and all associated data. This action cannot be undone.
                    </flux:text>
                </div>
                <flux:modal.trigger name="delete-profile">
                    <flux:button variant="danger">Delete Account</flux:button>
                </flux:modal.trigger>

                <flux:modal name="delete-profile" class="md:w-96">
                    <form wire:submit="deleteUser" class="space-y-6">
                        <div>
                            <flux:heading size="lg" class="text-red-600">
                                Delete Account
                            </flux:heading>

                            <flux:text class="mt-2 text-gray-600">
                                Are you sure you want to permanently delete your account? This action cannot be undone.
                            </flux:text>
                        </div>

                        <flux:input type="password" label="Current Password" placeholder="Enter your current password"
                            wire:model="current_password" />

                        <div class="flex justify-end gap-3">
                            <flux:modal.close>
                                <flux:button variant="ghost">
                                    Cancel
                                </flux:button>
                            </flux:modal.close>

                            <flux:button type="submit" variant="danger">
                                Delete Account
                            </flux:button>
                        </div>
                    </form>
                </flux:modal>
            </flux:card>
        @endcan

    </div>
</div>
