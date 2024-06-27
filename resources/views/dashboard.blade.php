<script>
    // ページが読み込まれた後、すぐにhome.blade.phpにリダイレクトします
    setTimeout(function() {
        window.location.href = "{{ route('/') }}"; // 'web'という名前のルートにリダイレクト
    }, 10);
</script>