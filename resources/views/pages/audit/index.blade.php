<x-layouts::app>
    <div>
        <flux:heading size="xl" level="1">Activity Logs</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">
            Review and monitor system activity, including user actions, changes, logins, and other important events
            across the application.
        </flux:text>
        <flux:separator variant="subtle" class="my-6" />
    </div>

    <livewire:powergridtables.activity-logs-table />
</x-layouts::app>
