<x-layouts::app>
    <div>
        <flux:heading size="xl" level="1">Good afternoon, {{ auth()->user()->name }}</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">Here's what's new today</flux:text>
        <flux:separator variant="subtle" class="my-6" />
    </div>
</x-layouts::app>
