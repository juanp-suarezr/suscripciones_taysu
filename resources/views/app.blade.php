<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    {{-- SDK de Mercado Pago --}}
    <?php
// require base_path('vendor/autoload.php');

// use MercadoPago\MercadoPagoConfig;
// use MercadoPago\Client\Preference\PreferenceClient;
// use MercadoPago\Resources\Preference\Item;

// MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));

// // Create a preference
// $preference = new PreferenceClient();

// // Create an item
// $item = new Item();
// $item->title = 'suscripcion';
// $item->quantity = 1;
// $item->unit_price = 180000;
// $item->currency_id = "COP";

// // Add the item to the preference
// $preference->items = [$item];

// // Save the preference by sending it to MercadoPago API
// $preference->save();

// // Access the ID of the saved preference
// $preferenceId = $preference->id;

// // Now you can use $preferenceId as needed
// ?>

</head>

<body class="font-sans antialiased">
    @inertia
    {{-- SDK MercadoPago.js --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>


    

</body>



</html>
