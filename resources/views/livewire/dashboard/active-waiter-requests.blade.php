
<a></a>

@push('scripts')
    @if ($playSound)
    <script>
        new Audio("{{ asset('sound/new_order.wav')}}").play();
    </script>
    @endif

    @if(pusherSettings()->is_enabled_pusher_broadcast)
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const channel = PUSHER.subscribe('active-waiter-requests');
                channel.bind('active-waiter-requests.created', function(data) {
                    @this.call('refreshActiveWaiterRequests');
                    new Audio("{{ asset('sound/new_order.wav')}}").play();
                    console.log('✅ Pusher received data for active waiter requests!. Refreshing...');
                });
                PUSHER.connection.bind('connected', () => {
                    console.log('✅ Pusher connected for Active Waiter Requests!');
                });
                channel.bind('pusher:subscription_succeeded', () => {
                    console.log('✅ Subscribed to active-waiter-requests channel!');
                });
            });
        </script>
    @endif
@endpush
