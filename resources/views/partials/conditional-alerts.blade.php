{{-- Conditional asset loading for alerts --}}
@once
    @push('scripts')
        <script>
            // Preload alerts on user interaction
            document.addEventListener('DOMContentLoaded', function() {
                // Preload on first click anywhere (user is active)
                document.addEventListener('click', async function preloadAlerts() {
                    await window.moduleLoader.loadAlerts();
                    document.removeEventListener('click', preloadAlerts);
                }, { once: true });
            });
        </script>
    @endpush
@endonce
