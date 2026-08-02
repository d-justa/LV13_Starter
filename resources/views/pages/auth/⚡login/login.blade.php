<div class="flex-1 flex justify-center items-center p-2">
    <flux:card class="w-full md:w-2xl space-y-6">
        <div class="text-center">
            <flux:heading size="xl">Log in to your account</flux:heading>
            <flux:text class="mt-2">Welcome back!</flux:text>
        </div>
        <flux:error name="oAuth" class="text-center" />
        <flux:separator />

        <form wire:submit="login" class="space-y-4">
            <flux:input wire:model="email" label="Email" type="email" placeholder="Your email address" />

            <flux:field>
                <div class="flex justify-between">
                    <flux:label>Password</flux:label>

                    <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
                </div>
                <flux:input type="password" placeholder="Your password" wire:model="password" />
                <flux:error name="password" />
            </flux:field>

            <div class="flex items-center justify-between">
                <flux:field variant="inline">
                    <flux:checkbox wire:model="remember" />
                    <flux:label>Remember Me</flux:label>
                </flux:field>
            </div>

            <flux:button type="submit" variant="primary" class="w-full">Log in</flux:button>
        </form>

        <div class="flex gap-2">
            <flux:button variant="filled" class="w-full" wire:click="sendOtp">Login with OTP</flux:button>
            <flux:button variant="primary" color="red" class="w-full" :href="route('oAuthRedirect', 'google')">Google</flux:button>
        </div>

        @if (Route::has('register'))
            <flux:separator />
            <flux:button variant="ghost" class="w-full">Sign up for a new account</flux:button>
        @endif
    </flux:card>

    <flux:modal name="login-otp" class="md:w-96">
        <form wire:submit="verifyOtp" class="space-y-8">
            <div class="max-w-64 mx-auto space-y-2">
                <flux:heading size="lg" class="text-center">Verify your account</flux:heading>
                <flux:text class="text-center">Please enter a one-time password sent to your email.</flux:text>
            </div>

            <flux:otp wire:model="otp" length="6" label="OTP Code" label:sr-only error:class="text-center"
                class="mx-auto" />

            <div class="space-y-4">
                <flux:button variant="primary" type="submit" class="w-full">Verify</flux:button>
                <flux:button wire:click="resend" class="w-full">Resend code</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
