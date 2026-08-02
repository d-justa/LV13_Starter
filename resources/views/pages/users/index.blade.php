<x-layouts::app>
    <div>
        <flux:heading size="xl" level="1">Users</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">
            Browse, search, and manage all users.
        </flux:text>
        <flux:separator variant="subtle" class="my-6" />
    </div>

    <livewire:powergridtables.users-table/>
</x-layouts::app>
