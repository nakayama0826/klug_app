<script>
    // ページが読み込まれた後、すぐにweb.blade.phpにリダイレクトします
    setTimeout(function() {
        window.location.href = "{{ route('admin') }}"; // 'web'という名前のルートにリダイレクト
    }, 10);
</script>