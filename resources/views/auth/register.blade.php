<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント作成 / つぶやき投稿アプリ</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #FBFAF7; color: #17181C; min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 1.2rem; font-feature-settings: "palt"; }
        .card { background: #FFFFFF; border: 1px solid #EDEBE4; padding: 2.4rem 2.2rem 2.2rem; border-radius: 22px; width: 100%; max-width: 400px; box-shadow: 0 18px 50px -24px rgba(60, 45, 20, 0.25); }
        .brand { display: flex; align-items: center; justify-content: center; gap: 0.55rem; font-weight: 800; font-size: 1.5rem; letter-spacing: -0.02em; margin-bottom: 0.35rem; }
        .brand .mark { width: 38px; height: 38px; border-radius: 38%; background: linear-gradient(135deg, #FFB03A, #FF7A59); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; font-weight: 800; }
        h1 { font-size: 0.92rem; text-align: center; color: #6E7076; font-weight: 500; margin-bottom: 1.6rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; color: #3A3C42; margin-bottom: 0.4rem; font-size: 0.8rem; font-weight: 600; }
        input { width: 100%; padding: 0.75rem 0.9rem; border: 1.5px solid #E3E1D9; border-radius: 12px; font-size: 0.95rem; background: #FFFFFF; color: #17181C; font-family: inherit; }
        input:focus { outline: none; border-color: #17181C; }
        button { width: 100%; padding: 0.85rem; background: #17181C; color: #fff; border: none; border-radius: 12px; font-size: 0.95rem; font-weight: 700; cursor: pointer; margin-top: 0.7rem; font-family: inherit; }
        button:hover { background: #33353C; }
        button:focus-visible { outline: 2px solid #FF7A59; outline-offset: 2px; }
        .error { color: #C2402A; font-size: 0.83rem; margin-top: 0.3rem; }
        .links { text-align: center; margin-top: 1.3rem; font-size: 0.88rem; color: #6E7076; }
        .links a { color: #17181C; text-decoration: underline; text-underline-offset: 3px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand"><span class="mark">つ</span>つぶやき投稿アプリ</div>
        <h1>アカウントを作成する</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">パスワード（確認）</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">登録</button>
        </form>

        <div class="links">
            登録済みですか？ <a href="{{ route('login') }}">ログイン</a>
        </div>
    </div>
</body>
</html>
