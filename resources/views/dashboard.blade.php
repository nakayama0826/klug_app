<script>
    // ページが読み込まれた後、すぐにhome.blade.phpにリダイレクトします
    setTimeout(function() {
        window.location.href = "{{ secure_route('/') }}"; // 'web'という名前のルートにリダイレクト
    }, 10);
</script>