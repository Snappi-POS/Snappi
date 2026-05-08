<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ isRtl() ? 'rtl' : 'ltr' }}">

<head>
   @php
        $lastSegment = last(request()->segments());
    @endphp
    @if (user()->restaurant_id)
        <link rel="manifest" href="{{ asset('manifest.json') }}@if($lastSegment)?url={{ $lastSegment }}&hash={{ user()->restaurant->hash }}@endif" crossorigin="use-credentials">
    @else
        <link rel="manifest" href="{{ asset('manifest.json') }}@if($lastSegment)?url={{ $lastSegment }}@endif" crossorigin="use-credentials">
    @endif
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="{{ global_setting()->name }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/trix/trix.css') }}" />


    <link rel="apple-touch-icon" sizes="180x180" href="{{ restaurantOrGlobalSetting()->upload_fav_icon_apple_touch_icon_url }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ restaurantOrGlobalSetting()->upload_fav_icon_android_chrome_192_url }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ restaurantOrGlobalSetting()->upload_fav_icon_android_chrome_512_url }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ restaurantOrGlobalSetting()->upload_favicon_16_url }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ restaurantOrGlobalSetting()->upload_favicon_32_url }}">
    <link rel="shortcut icon" href="{{ restaurantOrGlobalSetting()->favicon_url }}">


    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ global_setting()->logoUrl }}">

    <title>{{ global_setting()->name }}</title>
    
    

 <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <!-- Select2 Dark Theme CSS -->
    <style>
    
    /* Hide number input spinners */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
    appearance: textfield;
}
        /* Select2 Dark Theme Styles */
        .dark .select2-container--default .select2-selection--single {
            background-color: rgb(55 65 81); /* dark:bg-gray-700 */
            border-color: rgb(75 85 99); /* dark:border-gray-600 */
            color: white;
        }
        
        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: white;
            line-height: 36px;
        }
        
        .dark .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: rgb(156 163 175); /* gray-400 */
        }
        
        .dark .select2-container--default .select2-selection--single .select2-selection__arrow {
            background-color: rgb(55 65 81);
        }
        
        /* Dropdown dark theme */
        .dark .select2-container--default .select2-dropdown {
            background-color: rgb(55 65 81);
            border-color: rgb(75 85 99);
        }
        
        .dark .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: rgb(31 41 55); /* dark:bg-gray-800 */
            border-color: rgb(75 85 99);
            color: white;
        }
        
        .dark .select2-container--default .select2-results__option {
            color: white;
            background-color: rgb(55 65 81);
        }
        
        .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rgb(59 130 246); /* blue-500 */
            color: white;
        }
        
        .dark .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: rgb(37 99 235); /* blue-600 */
            color: white;
        }
        
        /* Focus state */
        .dark .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: rgb(59 130 246); /* focus:border-primary-500 */
        }
        
        /* Match Tailwind styling */
        .select2-container--default .select2-selection--single {
            height: 38px;
            border-radius: 0.375rem; /* rounded-md */
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05); /* shadow-sm */
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        
        /* Light theme refinements */
        .select2-container--default .select2-selection--single {
            background-color: white;
            border-color: rgb(209 213 219); /* border-gray-300 */
        }
        
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: rgb(59 130 246);
            outline: 2px solid transparent;
            outline-offset: 2px;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @stack('styles')

    @include('sections.theme_style', [
        'baseColor' => restaurantOrGlobalSetting()->theme_rgb,
        'baseColorHex' => restaurantOrGlobalSetting()->theme_hex,
    ])


    @if (File::exists(public_path() . '/css/app-custom.css'))
        <link href="{{ asset('css/app-custom.css') }}" rel="stylesheet">
    @endif

    @if (App::environment('codecanyon') && pusherSettings()->beamer_status)
        <script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js" async></script>
    @endif
<script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js"></script>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <script>
        if (localStorage.getItem("menu-collapsed") === "true") {
            document.documentElement.style.visibility = 'hidden';
            window.addEventListener('DOMContentLoaded', () => {
                const sidebar = document.getElementById('sidebar');
                const openIcon = document.getElementById('toggle-sidebar-open');
                const closeIcon = document.getElementById('toggle-sidebar-close');

                if (sidebar) {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('flex', 'lg:flex');
                }

                if (openIcon && closeIcon) {
                    openIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                }

                setTimeout(() => {
                    document.documentElement.style.visibility = 'visible';
                }, 50);
            });
        } else {
            // Handle expanded state icons without hiding the page
            window.addEventListener('DOMContentLoaded', () => {
                const openIcon = document.getElementById('toggle-sidebar-open');
                const closeIcon = document.getElementById('toggle-sidebar-close');

                if (openIcon && closeIcon) {
                    openIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                }
            });
        }
    </script>

    {{-- Include file for widgets if exist --}}
    @includeIf('sections.custom_script_admin')
</head>


<body class="font-sans antialiased dark:bg-gray-900" id="main-body">

    @if (user()->restaurant_id)
        @livewire('navigation-menu')
    @else
        @livewire('superadmin-navigation-menu')
    @endif

    <div class="flex rtl:flex-row-reverse pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900 h-screen">

        @if (user()->restaurant_id)
            @livewire('sidebar')
        @else
            @livewire('superadmin-sidebar')
        @endif


        <div id="main-content"
            class="relative w-full h-full overflow-y-auto bg-gray-50 ltr:lg:ml-64 rtl:lg:mr-64 dark:bg-gray-900">
            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>


        </div>


    </div>

    @stack('modals')


    @livewireScripts

    @include('layouts.update-uri')

    @livewire('raise-support-ticket')

    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}" defer data-navigate-track></script>
    <x-livewire-alert::flash />

    @if (superadminPaymentGateway()->razorpay_status)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif

    @if (user()->restaurant_id)

        @livewire('order.OrderDetail')

        @livewire('customer.addCustomer')

        @livewire('settings.upgradeLicense')

        @livewire('order.addPayment')

        @include('sections.payment-gateway-include')

    @endif


    @if (App::environment('codecanyon') && pusherSettings()->beamer_status)
        <script>
            const currentUserId = "{{ Str::slug(global_setting()->name) }}-{{ auth()->id() }}"; // Get this from your auth system

            const beamsClient = new PusherPushNotifications.Client({
                instanceId: "{{ pusherSettings()->instance_id }}",
            });

            const beamsTokenProvider = new PusherPushNotifications.TokenProvider({
                url: "{{ route('beam_auth') }}",
            });

            beamsClient.start()
                .then(() => beamsClient.addDeviceInterest('{{ Str::slug(global_setting()->name) }}'))
                .then(() => beamsClient.setUserId(currentUserId, beamsTokenProvider))
                .then(() => console.log('Successfully registered and subscribed!'))
                .catch(console.error);

            beamsClient
                .getUserId()
                .then((userId) => {
                    console.log(userId, currentUserId);
                    // Check if the Beams user matches the user that is currently logged in
                    if (userId !== currentUserId) {
                        // Unregister for notifications
                        return beamsClient.stop();
                    }
                })
                .catch(console.error);
        </script>
    @endif

    <script>
        var elem = document.getElementById("main-body");

        function openFullscreen() {
            if (!document.fullscreenElement) {
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.webkitRequestFullscreen) {
                    /* Safari */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    /* IE11 */
                    elem.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    /* IE11 */
                    document.msExitFullscreen();
                }
            }
        }
    </script>

    @include('sections.pusher-script')

    @include('layouts.service-worker-js')
    @stack('scripts')
    <script src="{{ asset('vendor/trix/trix.umd.min.js') }}"></script>
    
     <!-- jQuery (load before Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Global Select2 Initialization Script -->
    <script>
        // Global function to initialize Select2
        window.initSelect2 = function(selector = '.select2-livewire') {
            $(selector).each(function() {
                const $element = $(this);
                
                // Skip if already initialized
                if ($element.hasClass("select2-hidden-accessible")) {
                    return;
                }
                
                // Get options from data attributes
                const options = {
                    placeholder: $element.data('placeholder') || 'Select an option',
                    allowClear: $element.data('allow-clear') !== false,
                    width: '100%',
                    dropdownParent: $element.closest('[wire\\:ignore]').length ? 
                        $element.parent() : $(document.body)
                };
                
                // Initialize Select2
                $element.select2(options);
                
                // Sync with Livewire
                $element.off('change.select2-livewire').on('change.select2-livewire', function() {
                    const component = window.Livewire.find(
                        $(this).closest('[wire\\:id]').attr('wire:id')
                    );
                    
                    if (component) {
                        const model = $(this).attr('wire:model') || $(this).data('model');
                        if (model) {
                            component.set(model, $(this).val());
                        }
                        
                        // Call custom method if specified
                        const method = $(this).data('change-method');
                        if (method) {
                            component.call(method, $(this).val());
                        }
                    }
                });
            });
        };
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            window.initSelect2();
        });
        
        // Re-initialize after Livewire updates
        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.updated', ({ el, component }) => {
                // Small delay to ensure DOM is ready
                setTimeout(() => {
                    window.initSelect2();
                }, 50);
            });
        });
        
        // For Livewire navigation (if using Livewire 3 SPA mode)
        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                window.initSelect2();
            }, 100);
        });
    </script>
    
    
   <!-- app.blade.php — only handles non-POS pages now -->
<script>
    (function () {
        let buffer = '';
        let lastKeyTime = Date.now();

        document.addEventListener('keydown', function (e) {
            // Only run on non-POS pages — POS handles its own scanning
            if (window.location.pathname.startsWith('/pos')) return;

            const tag = document.activeElement.tagName.toLowerCase();
            const isEditable = document.activeElement.isContentEditable;
            if (['input', 'textarea', 'select'].includes(tag) || isEditable) return;

            const now = Date.now();

            if (now - lastKeyTime > 300) buffer = '';
            lastKeyTime = now;

            if (e.key === 'Enter') {
                const barcode = buffer.trim();
                buffer = '';
                if (barcode.length > 2) {
                    window.location.href = '/pos?scan=' + encodeURIComponent(barcode);
                }
            } else if (e.key.length === 1) {
                buffer += e.key;
            }
        });
    })();
</script>
</body>
</html>
