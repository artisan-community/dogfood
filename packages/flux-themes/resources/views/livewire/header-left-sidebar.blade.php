<flux:navbar class="max-lg:hidden">
    @foreach ($items as $item)
        <x-flux-themes::navbar-item-loader :item="$item"/>
    @endforeach
</flux:navbar>
