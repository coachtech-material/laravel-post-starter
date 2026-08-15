<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム / Tsubu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #ffffff; color: #0f1419; }
        a { text-decoration: none; color: inherit; }
        .shell { max-width: 640px; margin: 0 auto; border-left: 1px solid #eff3f4; border-right: 1px solid #eff3f4; min-height: 100vh; }
        .topbar { position: sticky; top: 0; z-index: 10; background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(8px); border-bottom: 1px solid #eff3f4; display: flex; justify-content: space-between; align-items: center; padding: 0.7rem 1rem; }
        .brand { display: flex; align-items: center; gap: 0.45rem; font-weight: 800; font-size: 1.15rem; }
        .brand .mark { width: 26px; height: 26px; border-radius: 50%; background: #059669; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 800; }
        .me { display: flex; align-items: center; gap: 0.6rem; }
        .me .name { font-size: 0.82rem; color: #536471; }
        .logout-btn { background: #ffffff; color: #0f1419; border: 1px solid #cfd9de; padding: 0.35rem 0.9rem; border-radius: 999px; font-size: 0.8rem; font-weight: 700; cursor: pointer; }
        .logout-btn:hover { background: #f7f9f9; }
        .page-head { padding: 0.9rem 1rem; border-bottom: 1px solid #eff3f4; font-weight: 800; font-size: 1.05rem; }
        .post { display: flex; gap: 0.75rem; padding: 0.9rem 1rem; border-bottom: 1px solid #eff3f4; }
        .post:hover { background: #f7f9f9; }
        .avatar { width: 42px; height: 42px; border-radius: 50%; flex-shrink: 0; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.05rem; }
        .post-body { flex: 1; min-width: 0; }
        .post-head { display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.1rem; }
        .post-head .name { font-weight: 700; font-size: 0.95rem; }
        .post-head .time { color: #536471; font-size: 0.8rem; }
        .topic { color: #536471; background: #eff3f4; border-radius: 999px; padding: 0.05rem 0.6rem; font-size: 0.72rem; }
        .post-title { font-weight: 700; font-size: 0.95rem; margin: 0.2rem 0 0.1rem; }
        .post-text { font-size: 0.95rem; line-height: 1.65; overflow-wrap: anywhere; }
        .post-actions { display: flex; gap: 1rem; margin-top: 0.5rem; }
        .post-actions a, .post-actions button { background: none; border: none; padding: 0; color: #536471; font-size: 0.8rem; cursor: pointer; font-family: inherit; }
        .post-actions a:hover { color: #059669; }
        .post-actions button:hover { color: #dc2626; }
        .empty { color: #536471; text-align: center; padding: 3rem 1rem; }
    </style>
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <a href="{{ route('posts.index') }}" class="brand"><span class="mark">つ</span>Tsubu</a>
            <div class="me">
                <span class="name">{{ auth()->user()->name }}（{{ auth()->user()->email }}）</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">ログアウト</button>
                </form>
            </div>
        </header>

        <div class="page-head">ホーム</div>

        @if($posts->isEmpty())
            <p class="empty">まだポストがありません。</p>
        @else
            @php
                $palette = ['#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#8b5cf6', '#f97316', '#06b6d4'];
            @endphp
            @foreach ($posts as $post)
                <article class="post">
                    <div class="avatar" style="background: {{ $palette[$post->user->id % count($palette)] }};">{{ mb_substr($post->user->name, 0, 1) }}</div>
                    <div class="post-body">
                        <div class="post-head">
                            <span class="name">{{ $post->user->name }}</span>
                            <span class="time">・{{ $post->created_at->format('n月j日 H:i') }}</span>
                            <span class="topic">{{ $post->category->name }}</span>
                        </div>
                        <p class="post-title">{{ $post->title }}</p>
                        <p class="post-text">{{ $post->content }}</p>
                        @canany(['update', 'delete'], $post)
                            <div class="post-actions">
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}">編集</a>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                @endcan
                            </div>
                        @endcanany
                    </div>
                </article>
            @endforeach
        @endif
    </div>
</body>
</html>
