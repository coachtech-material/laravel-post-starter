<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポストを編集 / Tsubu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #ffffff; color: #0f1419; }
        a { text-decoration: none; color: inherit; }
        .shell { max-width: 640px; margin: 0 auto; border-left: 1px solid #eff3f4; border-right: 1px solid #eff3f4; min-height: 100vh; }
        .topbar { position: sticky; top: 0; z-index: 10; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(8px); border-bottom: 1px solid #eff3f4; display: flex; justify-content: space-between; align-items: center; padding: 0.7rem 1rem; }
        .brand { display: flex; align-items: center; gap: 0.45rem; font-weight: 800; font-size: 1.15rem; }
        .brand .mark { width: 26px; height: 26px; border-radius: 50%; background: #059669; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 800; }
        .page-head { padding: 0.9rem 1rem; border-bottom: 1px solid #eff3f4; font-weight: 800; font-size: 1.05rem; }
        form.editor { padding: 1.2rem 1rem; }
        .form-group { margin-bottom: 1.1rem; }
        label { display: block; color: #536471; margin-bottom: 0.4rem; font-size: 0.82rem; font-weight: 700; }
        input[type="text"], textarea, select { width: 100%; padding: 0.7rem 0.8rem; border: 1px solid #cfd9de; border-radius: 10px; font-size: 0.95rem; font-family: inherit; background: #fff; color: #0f1419; }
        textarea { min-height: 140px; resize: vertical; line-height: 1.6; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #059669; box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12); }
        .actions { display: flex; gap: 0.75rem; margin-top: 1.4rem; }
        .btn { padding: 0.6rem 1.5rem; border-radius: 999px; font-size: 0.9rem; font-weight: 700; cursor: pointer; text-align: center; }
        .btn-primary { background: #059669; color: white; border: none; }
        .btn-primary:hover { background: #047857; }
        .btn-secondary { background: #ffffff; color: #0f1419; border: 1px solid #cfd9de; }
        .btn-secondary:hover { background: #f7f9f9; }
        .error { color: #dc2626; font-size: 0.85rem; margin-top: 0.3rem; }
    </style>
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <a href="{{ route('posts.index') }}" class="brand"><span class="mark">つ</span>Tsubu</a>
        </header>

        <div class="page-head">ポストを編集</div>

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
    </div>
</body>
</html>
