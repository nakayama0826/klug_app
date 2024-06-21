<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<meta name="description" content="">
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/0bcc8bf126.js" crossorigin="anonymous"></script>
	@stack('style')
</head>

<script>
	document.addEventListener('DOMContentLoaded', function () {
	    axios.get('/getUser') // ユーザー情報を取得するエンドポイント
		.then(function (response) {
		    const data = response.data;
		    
		    // 条件をチェック
		    if (data.adminAuth !== 1) {
			console.error('アクセスが許可されていません。');
			window.location.href = "http://application.gulk.co.jp";
		    } else {
			document.getElementById('hiddenContents').classList.remove('display-hidden');
		    }
		})
		.catch(function (error) {
		    console.error('Error fetching user info:', error);
		});
	});
</script>

<body id="hiddenContents" class="display-hidden">
	<header id="header" class="py-3">
		@yield('left_tab')
		<img id="klug_logo" src="{{ asset('img/klug_logo.jpg') }}">
		@yield('right_tab')
	</header>
	@yield('second_header')
	@yield('contents')
</body>

<script src="{{ asset('/js/main.js') }}"></script>