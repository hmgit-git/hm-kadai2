<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録サイト</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- ← ここ追加！ --}}
    @yield('css')
</head>

<body>
    <header>
        <h1>商品登録サイト</h1>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>