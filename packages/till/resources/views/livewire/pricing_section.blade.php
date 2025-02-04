<div>
    <div class="text-center">
        <flux:tabs variant="segmented" size="sm">
            <flux:tab>Monthly</flux:tab>
            <flux:tab>Annual</flux:tab>
            <flux:tab>Lifetime</flux:tab>
        </flux:tabs>
    </div>
    <div class="mt-10 grid grid-cols-1 gap-4 sm:mt-16 lg:grid-cols-3">
    @foreach ($plans as $plan)
        <div class="'relative">
            <flux:card class="relative flex min-h-48 h-full flex-col overflow-hidden">
                <flux:heading>{{ $plan->heading }}</flux:heading>
                <flux:subheading>{{ $plan->subheading }}</flux:subheading>
            </flux:card>
        </div>
    @endforeach
</div>
</div>
