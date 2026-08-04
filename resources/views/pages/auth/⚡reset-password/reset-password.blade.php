<div class="flex-1 flex justify-center items-center p-2">
    <flux:card class="w-full md:w-2xl space-y-6">
        <div class="text-center">
            <flux:heading size="xl">Reset Password</flux:heading>
            <flux:text class="mt-2">Welcome back!</flux:text>
        </div>
        <flux:separator />

        <form wire:submit="resetPassword" class="space-y-4">

            <flux:input wire:model="email" type="email" label="Email" readonly />

            <flux:input wire:model="password" type="password" label="New Password" />

            <flux:input wire:model="password_confirmation" type="password" label="Confirm Password" />

            <flux:button type="submit" variant="primary" class="w-full">
                Reset Password
            </flux:button>

        </form>
    </flux:card>
</div>
