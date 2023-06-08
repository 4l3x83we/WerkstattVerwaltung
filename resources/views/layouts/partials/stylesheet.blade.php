<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles

@push('js')
    @livewireScripts
@endpush
@push('scripts')

@endpush
