<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<meta name="description" content="">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/0bcc8bf126.js" crossorigin="anonymous"></script>
	@stack('style')
</head>

<body>
	<header id="header" class="py-3">
		@yield('left_tab')
		<img id="klug_logo" src="{{ asset('img/klug_logo.jpg') }}">
		@yield('right_tab')
	</header>
	@yield('second_header')
	@yield('contents')
</body>

<script src="{{ asset('/js/main.js') }}"></script>