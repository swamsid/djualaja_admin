<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

  		<link rel="stylesheet" href="{{ asset('js/plugins/Croppie-master/croppie.css') }}">


    </head>
    <body>
		
		<img class="my-image" src="{{ asset("js/plugins/Croppie-master/demo/demo-1.jpg") }}" />

		<script src="{{ URL::asset('js/app.js') }}"></script>
		<script src="{{ asset('js/plugins/Croppie-master/croppie.min.js') }}"></script>

		<script>
			$('.my-image').croppie();
		</script>
       
    </body>
</html>
