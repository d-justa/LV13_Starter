<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand href="#" logo="https://fluxui.dev/img/demo/logo.png"
                logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." />

            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" :href="route('dashboard')">Dashboard</flux:sidebar.item>
            <flux:sidebar.item icon="users" :href="route('users.index')">Users</flux:sidebar.item>
            <flux:sidebar.item icon="document-text" href="#">Documents</flux:sidebar.item>
            <flux:sidebar.item icon="calendar" href="#">Calendar</flux:sidebar.item>

            <flux:sidebar.group expandable icon="star" heading="Favorites" class="grid">
                <flux:sidebar.item href="#">Marketing site</flux:sidebar.item>
                <flux:sidebar.item href="#">Android app</flux:sidebar.item>
                <flux:sidebar.item href="#">Brand guidelines</flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
            <flux:sidebar.item icon="information-circle" :href="route('audit.index')">Activity Logs</flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile :avatar="auth()->user()->getFirstMediaUrl('avatar')" :name="auth()->user()->name" />

            <flux:menu>
                <flux:menu.item icon="user" :href="route('profile.edit')">Manage Profile</flux:menu.item>

                <flux:menu.separator />
                @if (session()->has('impersonator_id'))
                    <form method="POST" action="{{ route('impersonation.stop') }}">
                        @csrf
                        <flux:button type="submit" variant="danger" size="xs" class="w-full my-2">
                            Return to Admin
                        </flux:button>
                    </form>
                @endif

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <flux:button type="submit" class="w-full">Logout</flux:button>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <flux:header class="bg-zinc-100 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />
        <flux:navbar class="me-2">
            <flux:modal.trigger name="my-notifications">
                <flux:navbar.item icon="bell-alert" label="Notifications" />
            </flux:modal.trigger>
        </flux:navbar>
        @if (session()->has('impersonator_id'))
            <form method="POST" action="{{ route('impersonation.stop') }}">
                @csrf
                <flux:button type="submit" variant="danger" size="xs" class="w-full my-2">
                    Return to Admin
                </flux:button>
            </form>
        @endif
        <flux:dropdown position="top" align="start">
            <flux:profile :avatar="auth()->user()->getFirstMediaUrl('avatar', 'thumb')" />

            <flux:menu class="w-64">
                <div class="px-2 py-3 border-b border-zinc-100 dark:border-zinc-800 mb-2">
                    <div class="flex flex-col gap-0.5">
                        <p class="text-sm font-semibold text-zinc-800 dark:text-white truncate">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

                <flux:menu.item icon="user-circle" :href="route('profile.edit')">Manage Profile</flux:menu.item>

                <flux:menu.item icon="cog-6-tooth">
                    Account Settings
                </flux:menu.item>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" class="cursor-pointer"
                        icon="arrow-right-start-on-rectangle" variant="danger">
                        Log Out
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>

    <flux:modal name="my-notifications" flyout class="w-full md:w-2xl p-2">
        <livewire:my-notifications />
    </flux:modal>

    @fluxScripts
</body>

</html>
