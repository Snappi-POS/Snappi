<div>
    <form wire:submit.prevent="submitForm">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="areaName" value="{{ __('modules.table.areaName') }}" />
                <x-input id="areaName" class="block mt-1 w-full" type="text"
                    placeholder="{{ __('placeholders.areaNamePlaceholder') }}" autofocus
                    wire:model='areaName' />
                <x-input-error for="areaName" class="mt-2" />
            </div>

            <!-- Hidden location fields -->
            <input type="hidden" id="latitude" wire:model="latitude">
            <input type="hidden" id="longitude" wire:model="longitude">

            <!-- Map preview -->
            <div id="map" class="mapa w-full h-64 rounded-md border mt-4" style="display:none;"></div>

            <p class="mapa text-sm text-gray-500 mt-2" style="display:none;">
                📍 Drag the marker to adjust your exact location before saving.
            </p>
        </div>

        <div class="flex w-full pb-4 space-x-4 mt-6 rtl:space-x-reverse">
            <x-button>@lang('app.save')</x-button>
            <x-button-cancel wire:click="$dispatch('hideAddArea')" wire:loading.attr="disabled">
                @lang('app.cancel')
            </x-button-cancel>
        </div>
    </form>
</div>

<!-- Google Maps Script -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_QuBPk0Yy5NR6_wQiSJU9nvvmVUKdY2Y&callback=initApp"></script>

<script>
    let map, marker;

    function initApp() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            showError({ message: "Geolocation not supported by this browser." });
        }
    }

    function showPosition(position) {
        const lat = parseFloat(position.coords.latitude);
        const lng = parseFloat(position.coords.longitude);

        if (isNaN(lat) || isNaN(lng)) {
            console.error("Invalid coordinates:", lat, lng);
            return;
        }

        console.log("User accepted location access. Latitude:", lat, "Longitude:", lng);

        // Update Livewire component
        @this.set('latitude', lat);
        @this.set('longitude', lng);

        // Show map elements
        document.querySelectorAll('.mapa').forEach(el => el.style.display = 'block');

        // Initialize map
        initMap(lat, lng);
    }

    function initMap(lat, lng) {
        const location = { lat: lat, lng: lng };

        map = new google.maps.Map(document.getElementById("map"), {
            center: location,
            zoom: 15,
        });

        marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true,
            title: "Drag to adjust location",
        });

        // Update Livewire when marker is dragged
        google.maps.event.addListener(marker, 'dragend', function (event) {
            const newLat = event.latLng.lat();
            const newLng = event.latLng.lng();
            @this.set('latitude', newLat);
            @this.set('longitude', newLng);
        });
    }

    function showError(error) {
        console.warn("Location error:", error.message || error);
        // Hide map interface
        document.querySelectorAll('.mapa').forEach(el => el.style.display = 'none');
        // Optional alert or message
        alert("Unable to get your location. Please allow location access or try again.");
    }
</script>
