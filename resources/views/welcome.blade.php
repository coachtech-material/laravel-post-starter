<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tsubu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #f7f9f9; color: #0f1419; min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 1rem; }
        .card { background: #ffffff; border: 1px solid #eff3f4; padding: 2.6rem 2.2rem; border-radius: 16px; width: 100%; max-width: 420px; text-align: center; }
        .brand { display: flex; align-items: center; justify-content: center; gap: 0.55rem; font-weight: 800; font-size: 1.7rem; margin-bottom: 0.5rem; }
        .brand .mark { width: 40px; height: 40px; border-radius: 50%; background: #059669; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: 800; }
        .tagline { color: #536471; margin-bottom: 1.8rem; }
        .user-info { background: #f0fdf4; border: 1px solid #bbf7d0; padding: 0.9rem 1rem; border-radius: 10px; margin-bottom: 1.4rem; font-size: 0.9rem; }
        .user-info p { color: #065f46; }
        .links { display: flex; flex-direction: column; gap: 0.75rem; }
        .links a { display: block; padding: 0.8rem 1.5rem; border-radius: 999px; text-decoration: none; font-size: 0.95rem; font-weight: 700; }
        .btn-primary { background: #059669; color: white; }
        .btn-primary:hover { background: #047857; }
        .btn-secondary { background: #ffffff; color: #0f1419; border: 1px solid #cfd9de; }
        .btn-secondary:hover { background: #f7f9f9; }
        .btn-danger { background: #ffffff; color: #dc2626; border: 1px solid #fecaca; padding: 0.8rem 1.5rem; border-radius: 999px; font-size: 0.95rem; font-weight: 700; cursor: pointer; width: 100%; }
        .btn-danger:hover { background: #fef2f2; }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand"><span class="mark">つ</span>Tsubu</div>
        <p class="tagline">いま思ったことを、ひとこと。</p>

        @auth
            <div class="user-info">
                <p><strong>ログイン中:</strong> {{ auth()->user()->name }}</p>
            </div>
            <div class="links">
                <a href="{{ route('posts.index') }}" class="btn-primary">タイムラインへ</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-danger">ログアウト</button>
                </form>
            </div>
        @else
            <div class="links">
                <a href="{{ route('login') }}" class="btn-primary">ログイン</a>
                <a href="{{ route('register') }}" class="btn-secondary">新規登録</a>
            </div>
        @endauth
    </div>
</body>
</html>
