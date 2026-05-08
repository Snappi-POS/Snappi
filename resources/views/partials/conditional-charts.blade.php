{{-- Conditional asset loading for charts --}}
@once
    @push('scripts')
        <script>
            // Load charts only when needed
            document.addEventListener('DOMContentLoaded', async function() {
                // Check if there are any chart elements on the page
                const chartElements = document.querySelectorAll('[data-chart], .apexcharts-canvas, [id*="chart"]');
                
                if (chartElements.length > 0) {
                    console.log('Charts detected, loading chart modules...');
                    await window.moduleLoader.loadCharts();
                }
            });
        </script>
    @endpush
@endonce
