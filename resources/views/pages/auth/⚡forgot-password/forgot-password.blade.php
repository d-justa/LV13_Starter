<div class="flex-1 flex justify-center items-center p-2">
    <flux:card class="w-full md:w-2xl space-y-6">
        <div class="text-center">
            <flux:heading size="xl">Forgot Password</flux:heading>
            <flux:text class="mt-2">Welcome back!</flux:text>
        </div>
        <flux:separator />

        <form wire:submit="sendResetLink" class="space-y-4">
            <flux:input wire:model="email" label="Email" type="email" placeholder="Your email address" />
            <flux:button type="submit" variant="primary" class="w-full">Send Reset Link</flux:button>
        </form>

        @if (session('success'))
           <flux:callout variant="success" icon="envelope" :heading="session('success')" />
        @endif
    </flux:card>
</div>
