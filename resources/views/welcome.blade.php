<x-app-layout>
    <div class="flex items-center my-24 gap-24">
        <x-svg.dogfood-logo class="ml-24 size-48 text-gray-400" />
        <h1 class="text-6xl font-bold text-center text-neutral-400">Welcome to Dogfood.</h1>
    </div>
    <livewire:marketing:email-subscription-form
        heading="Get Notified When We Launch"
        subheading="We will be opening early access very soon."
        icon="envelope"
    />

</x-app-layout>
