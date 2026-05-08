<a>
</a>

@push('scripts')

    @if(pusherSettings()->is_enabled_pusher_broadcast)
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const channel = PUSHER.subscribe('today-reservations');
                channel.bind('today-reservations.created', function(data) {
                    @this.call('refreshReservations');
                    console.log('✅ Pusher received data for today reservations!. Refreshing...');
                });
                PUSHER.connection.bind('connected', () => {
                    console.log('✅ Pusher connected for Today Reservations!');
                });
                channel.bind('pusher:subscription_succeeded', () => {
                    console.log('✅ Subscribed to today-reservations channel!');
                });
            });
        </script>
    @endif
@endpush
