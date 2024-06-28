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
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
	<header id="header" class="py-3">
		@yield('left_tab')
		<form id="logout_form" method="POST" action="{{ route('logout') }}" class="inline" style="display: none;">
			@csrf
			<button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2"></button>
		    </form>
		<img id="klug_logo" src="{{ asset('img/klug_logo.jpg') }}">
		<i id="menu_tab" class="fa-solid fa-ellipsis" style="font-size: 140%; color:rgb(106, 184, 99)"></i>
	</header>
</body>