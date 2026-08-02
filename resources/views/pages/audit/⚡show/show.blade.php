<div class="space-y-6">

    <flux:card class="space-y-6 max-w-3xl">
        <div class="flex items-start justify-between">
            <div>
                <flux:heading size="lg">
                    {{ $this->activity->description }}
                </flux:heading>

                <flux:text class="mt-1">
                    {{ $this->activity->created_at->format('d M Y, h:i A') }}
                </flux:text>
            </div>

            <flux:badge color="zinc">
                {{ $this->activity->event }}
            </flux:badge>
        </div>

        <div class="grid gap-4 md:grid-cols-2">

            <div>
                <flux:label class="!mb-0">User</flux:label>
                <flux:text>
                    {{ $this->activity->causer?->name ?? 'System' }}
                </flux:text>
            </div>

            <div>
                <flux:label class="!mb-0">Subject</flux:label>
                <flux:text>
                    {{ class_basename($this->activity->subject_type) }}
                    #{{ $this->activity->subject_id }}
                </flux:text>
            </div>

            @foreach ($activity->properties as $key => $value)
                <div>
                    <flux:label class="!mb-0">{{ Str::title($key) }}</flux:label>
                    <flux:text>
                        {{ $activity->getProperty($key) }}
                    </flux:text>
                </div>
            @endforeach

        </div>
    </flux:card>

    @if ($this->activity->attribute_changes->isNotEmpty())

        <div class="grid gap-6 lg:grid-cols-2">

            @isset ($this->activity->attribute_changes['old'])
                <flux:card class="space-y-4">
                    <flux:heading>Previous Values</flux:heading>
                    <flux:table>
                        <flux:table.rows>
                            @foreach ($this->activity->attribute_changes['old'] as $key => $value)
                                <flux:table.row>
                                    <flux:table.cell>
                                        <span class="font-medium">
                                            {{ Str::headline($key) }}
                                        </span>
                                    </flux:table.cell>
                                    <flux:table.cell>
                                        <span class="text-zinc-600">
                                            {{ blank($value) ? '—' : $value }}
                                        </span>
                                    </flux:table.cell>
                                </flux:table.row>
                            @endforeach
                        </flux:table.rows>
                    </flux:table>
                </flux:card>
            @endisset


            <flux:card class="space-y-4">
                <flux:heading>New Values</flux:heading>
                <flux:table>
                    <flux:table.rows>
                        @foreach ($this->activity->attribute_changes['attributes'] as $key => $value)
                            <flux:table.row>
                                <flux:table.cell>
                                    <span class="font-medium">
                                        {{ Str::headline($key) }}
                                    </span>
                                </flux:table.cell>
                                <flux:table.cell>
                                    <span class="text-zinc-600">
                                        {{ blank($value) ? '—' : $value }}
                                    </span>
                                </flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            </flux:card>

        </div>

    @endif

</div>
