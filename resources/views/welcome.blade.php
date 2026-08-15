<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>つぶやき投稿アプリ</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #FBFAF7; color: #17181C; min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 1.2rem; font-feature-settings: "palt"; }
        .card { width: 100%; max-width: 400px; text-align: center; }
        .mark { width: 76px; height: 76px; border-radius: 38%; background: linear-gradient(135deg, #FFB03A, #FF7A59); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 2.3rem; font-weight: 800; margin: 0 auto 1.1rem; box-shadow: 0 18px 40px -18px rgba(232, 121, 43, 0.55); }
        .wordmark { font-weight: 800; font-size: 2rem; letter-spacing: -0.02em; margin-bottom: 0.3rem; }
        .tagline { color: #6E7076; margin-bottom: 2.2rem; }
        .user-info { background: #FFFFFF; border: 1px solid #EDEBE4; padding: 0.9rem 1rem; border-radius: 12px; margin-bottom: 1.3rem; font-size: 0.9rem; color: #3A3C42; }
        .links { display: flex; flex-direction: column; gap: 0.7rem; }
        .links a { display: block; padding: 0.85rem 1.5rem; border-radius: 12px; text-decoration: none; font-size: 0.95rem; font-weight: 700; }
        .btn-primary { background: #17181C; color: #fff; }
        .btn-primary:hover { background: #33353C; }
        .btn-secondary { background: transparent; color: #17181C; border: 1.5px solid #D9D6CE; }
        .btn-secondary:hover { border-color: #17181C; }
        .btn-danger { background: transparent; color: #C2402A; border: 1.5px solid #EBD5CE; padding: 0.85rem 1.5rem; border-radius: 12px; font-size: 0.95rem; font-weight: 700; cursor: pointer; width: 100%; font-family: inherit; }
        .btn-danger:hover { border-color: #C2402A; }
        .links a:focus-visible, .btn-danger:focus-visible { outline: 2px solid #FF7A59; outline-offset: 2px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="mark">つ</div>
        <div class="wordmark">つぶやき投稿アプリ</div>
        <p class="tagline">いま思ったことを、ひとこと。</p>

        @auth
            <div class="user-info"><strong>ログイン中:</strong> {{ auth()->user()->name }}</div>
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
                <a href="{{ route('register') }}" class="btn-secondary">アカウントを作成</a>
            </div>
        @endauth
    </div>
</body>
</html>
