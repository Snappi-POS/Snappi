<?php return array (
  'Illuminate\\Foundation\\Support\\Providers\\EventServiceProvider' => 
  array (
    'App\\Events\\NotifyWaiter' => 
    array (
      0 => 'App\\Listeners\\NotifyWaiterListener@handle',
    ),
    'App\\Events\\ReservationReceived' => 
    array (
      0 => 'App\\Listeners\\SendReservationListener@handle',
    ),
    'App\\Events\\SendNewOrderReceived' => 
    array (
      0 => 'App\\Listeners\\NewOrderReceivedListener@handle',
    ),
  ),
);