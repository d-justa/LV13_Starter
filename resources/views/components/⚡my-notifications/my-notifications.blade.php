<div>
    <div class="space-y-4">
        <flux:heading size="xl">My Notifications</flux:heading>
        <div class="md:flex gap-2 space-y-2">
            <flux:input wire:model.live.debounce.500ms="search" icon="magnifying-glass" placeholder="search..." clearable
                size="sm" />
            <flux:radio.group wire:model.live="status" variant="segmented" size="sm">
                <flux:radio value="all" label="All" />
                <flux:radio value="unread" label="Unread" />
                <flux:radio value="read" label="Read" />
            </flux:radio.group>
        </div>
    </div>

    <flux:separator class="my-4" />

    <div class="space-y-4" wire:loading.remove wire:target="status,search">
        @foreach ($this->notifications as $notification)
            <div @class([
                'p-4 rounded-xl border transition-all duration-200',
                // Indigo highlight for unread, subtle gray for read
                'bg-indigo-50/30 border-indigo-100 dark:bg-indigo-500/5 dark:border-indigo-500/20' => !$notification->read_at,
                'bg-white border-zinc-200 dark:bg-zinc-900 dark:border-zinc-800' =>
                    $notification->read_at,
            ])>
                <div class="flex items-start gap-4">
                    <div @class([
                        'mt-1 flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full',
                        'bg-accent text-accent-foreground' => !$notification->read_at,
                        'bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400' =>
                            $notification->read_at,
                    ])>
                        <flux:icon :name="($notification->data['icon'] ?? '') ?: 'bell'" variant="micro" />
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <flux:text :variant="!$notification->read_at ? 'strong' : 'default'" class="text-base">
                                {{ $notification->data['title'] ?? 'Notification' }}
                            </flux:text>

                            <flux:text class="text-xs" variant="subtle">
                                {{ $notification->created_at->diffForHumans() }}
                            </flux:text>
                        </div>

                        <flux:text class="mt-1">
                            {{ $notification->data['description'] ?? '' }}
                        </flux:text>

                        <div class="mt-3 flex gap-2">
                            @if(filled($notification->data['action_url'] ?? null))
                                <flux:button size="xs" variant="subtle" :href="$notification->data['action_url'] ?? '#'">
                                    {{ $notification->data['action_text'] ?? 'View Details'  }}
                                </flux:button>
                            @endif
                            @if (!$notification->read_at)
                                <flux:button size="xs" variant="subtle"
                                    wire:click="markAsRead('{{ $notification->id }}')">
                                    Mark as read
                                </flux:button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if ($this->totalCount > $perPage)
        <div x-intersect="$wire.loadMore()" class="flex justify-center py-4">
            <div wire:loading wire:target="loadMore">
                <flux:icon name="arrow-path" class="animate-spin text-accent" />
            </div>
        </div>
    @endif
</div>
