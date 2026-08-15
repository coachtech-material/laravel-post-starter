<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポストを編集 / Tsubu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #FBFAF7; color: #17181C; font-feature-settings: "palt"; }
        a { text-decoration: none; color: inherit; }
        .shell { max-width: 620px; margin: 0 auto; }
        .topbar { position: sticky; top: 0; z-index: 10; background: rgba(251, 250, 247, 0.88); backdrop-filter: blur(10px); display: flex; align-items: center; padding: 0.8rem 1.1rem; }
        .brand { display: flex; align-items: center; gap: 0.5rem; font-weight: 800; font-size: 1.2rem; letter-spacing: -0.02em; }
        .brand .mark { width: 30px; height: 30px; border-radius: 38%; background: linear-gradient(135deg, #FFB03A, #FF7A59); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; font-weight: 800; }
        .panel { background: #FFFFFF; border: 1px solid #EDEBE4; border-radius: 18px; margin: 0.4rem 0.75rem 3rem; overflow: hidden; }
        .panel-head { padding: 1rem 1.25rem 0.85rem; font-weight: 700; font-size: 1rem; border-bottom: 1px solid #F1EFE9; }
        form.editor { padding: 1.3rem 1.25rem 1.5rem; }
        .form-group { margin-bottom: 1.15rem; }
        label { display: block; color: #3A3C42; margin-bottom: 0.4rem; font-size: 0.8rem; font-weight: 600; }
        input[type="text"], textarea, select { width: 100%; padding: 0.7rem 0.85rem; border: 1.5px solid #E3E1D9; border-radius: 12px; font-size: 0.95rem; font-family: inherit; background: #fff; color: #17181C; }
        textarea { min-height: 140px; resize: vertical; line-height: 1.7; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #17181C; }
        .actions { display: flex; gap: 0.7rem; margin-top: 1.4rem; }
        .btn { padding: 0.7rem 1.6rem; border-radius: 12px; font-size: 0.9rem; font-weight: 700; cursor: pointer; text-align: center; font-family: inherit; }
        .btn-primary { background: #17181C; color: #fff; border: none; }
        .btn-primary:hover { background: #33353C; }
        .btn-secondary { background: transparent; color: #17181C; border: 1.5px solid #D9D6CE; }
        .btn-secondary:hover { border-color: #17181C; }
        .btn:focus-visible { outline: 2px solid #FF7A59; outline-offset: 2px; }
        .error { color: #C2402A; font-size: 0.83rem; margin-top: 0.3rem; }
    </style>
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <a href="{{ route('posts.index') }}" class="brand"><span class="mark">つ</span>Tsubu</a>
        </header>

        <main class="panel">
            <div class="panel-head">ポストを編集</div>

            <form class="editor" action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>
                    @error('title')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">トピック</label>
                    <select id="category_id" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">本文</label>
                    <textarea id="content" name="content" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">更新する</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">キャンセル</a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
