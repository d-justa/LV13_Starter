<div class="flex-1 flex justify-center items-center p-2">
    <flux:card class="w-full md:w-2xl space-y-6">
        <div class="text-center">
            <flux:heading size="xl">Welcome! Let’s get you started</flux:heading>
            <flux:text class="mt-2">Create your account and unlock everything we have to offer.</flux:text>
        </div>
        <flux:separator />

        <form wire:submit="register" class="space-y-4">
            <flux:input wire:model="name" label="Name" placeholder="Your full name" />
            <flux:input wire:model="email" label="Email" type="email" placeholder="Your email address" />
            <flux:input wire:model="password" label="Password" type="password" placeholder="Create your password" />
            <flux:input wire:model="password_confirmation" label="Confirm Password" type="password"
                placeholder="Re enter your password" />
            <flux:button type="submit" variant="primary" class="w-full">Create Account</flux:button>
        </form>

        <div class="flex gap-2">
            <flux:button variant="primary" color="red" class="w-full" :href="route('oAuthRedirect', 'google')">Google</flux:button>
        </div>

        <flux:separator />
        <flux:button :href="route('login')" variant="ghost" class="w-full">Login to existing account</flux:button>
    </flux:card>
</div>
