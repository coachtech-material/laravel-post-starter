<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン / Tsubu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #f7f9f9; color: #0f1419; min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 1rem; }
        .card { background: #ffffff; border: 1px solid #eff3f4; padding: 2.2rem 2rem; border-radius: 16px; width: 100%; max-width: 420px; }
        .brand { display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-weight: 800; font-size: 1.4rem; margin-bottom: 0.4rem; }
        .brand .mark { width: 34px; height: 34px; border-radius: 50%; background: #059669; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; font-weight: 800; }
        h1 { font-size: 1.05rem; text-align: center; color: #536471; font-weight: 500; margin-bottom: 1.4rem; }
        .test-accounts { background: #f0fdf4; border: 1px solid #bbf7d0; padding: 0.9rem 1rem; border-radius: 10px; margin-bottom: 1.4rem; font-size: 0.85rem; }
        .test-accounts h3 { color: #047857; margin-bottom: 0.4rem; font-size: 0.82rem; }
        .test-accounts p { color: #065f46; margin: 0.2rem 0; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; color: #536471; margin-bottom: 0.4rem; font-size: 0.82rem; font-weight: 700; }
        input[type="email"], input[type="password"] { width: 100%; padding: 0.75rem 0.85rem; border: 1px solid #cfd9de; border-radius: 10px; font-size: 0.95rem; }
        input:focus { outline: none; border-color: #059669; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12); }
        button { width: 100%; padding: 0.8rem; background: #059669; color: white; border: none; border-radius: 999px; font-size: 0.95rem; font-weight: 700; cursor: pointer; margin-top: 0.6rem; }
        button:hover { background: #047857; }
        .error { color: #dc2626; font-size: 0.85rem; margin-top: 0.3rem; }
        .links { text-align: center; margin-top: 1.2rem; font-size: 0.9rem; }
        .links a { color: #059669; text-decoration: none; font-weight: 700; }
        .links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand"><span class="mark">つ</span>Tsubu</div>
        <h1>いま思ったことを、ひとこと。</h1>

        <div class="test-accounts">
            <h3>テストアカウント</h3>
            <p><strong>ユーザーA:</strong> usera@example.com / password</p>
            <p><strong>ユーザーB:</strong> userb@example.com / password</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
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

            <button type="submit">ログイン</button>
        </form>

        <div class="links">
            <a href="{{ route('register') }}">アカウントを作成</a>
        </div>
    </div>
</body>
</html>
