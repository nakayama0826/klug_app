const logoutEl = document.getElementById('logout_btn');

if (logoutEl !== null) {
    // ホーム画面のログアウトボタンが押された時の処理
    logoutEl.addEventListener('click', function () {
        var userConfirmed = confirm('ログアウトしますか？');
        if (userConfirmed) {
            document.getElementById('logout_form').submit();
        }
    })
}

const backEl = document.getElementById('back_btn');

if (backEl !== null) {
    // ヘッダーのログアウトボタンが押された時の処理
    backEl.addEventListener('click', function () {
        window.location.href = 'http://localhost/klug_app/public/home';
    })
}