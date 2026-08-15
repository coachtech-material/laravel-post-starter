<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム / Tsubu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Noto Sans JP", sans-serif; background: #FBFAF7; color: #17181C; font-feature-settings: "palt"; }
        a { text-decoration: none; color: inherit; }
        .shell { max-width: 620px; margin: 0 auto; }
        .topbar { position: sticky; top: 0; z-index: 10; background: rgba(251, 250, 247, 0.88); backdrop-filter: blur(10px); display: flex; justify-content: space-between; align-items: center; padding: 0.8rem 1.1rem; }
        .brand { display: flex; align-items: center; gap: 0.5rem; font-weight: 800; font-size: 1.2rem; letter-spacing: -0.02em; }
        .brand .mark { width: 30px; height: 30px; border-radius: 38%; background: linear-gradient(135deg, #FFB03A, #FF7A59); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; font-weight: 800; }
        .me { display: flex; align-items: center; gap: 0.7rem; }
        .me .name { font-size: 0.8rem; color: #6E7076; }
        .logout-btn { background: transparent; color: #17181C; border: 1.5px solid #D9D6CE; padding: 0.35rem 0.95rem; border-radius: 10px; font-size: 0.8rem; font-weight: 600; cursor: pointer; font-family: inherit; }
        .logout-btn:hover { border-color: #17181C; }
        .logout-btn:focus-visible { outline: 2px solid #FF7A59; outline-offset: 2px; }
        .feed { background: #FFFFFF; border: 1px solid #EDEBE4; border-radius: 18px; margin: 0.4rem 0.75rem 3rem; overflow: hidden; }
        .feed-head { padding: 1rem 1.25rem 0.85rem; font-weight: 700; font-size: 1rem; border-bottom: 1px solid #F1EFE9; }
        .post { display: flex; gap: 0.8rem; padding: 1.05rem 1.25rem; }
        .post + .post { border-top: 1px solid #F1EFE9; }
        .post:hover { background: #FDFCF9; }
        .avatar { width: 44px; height: 44px; border-radius: 38%; flex-shrink: 0; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.1rem; }
        .post-body { flex: 1; min-width: 0; }
        .post-head { display: flex; align-items: baseline; gap: 0.45rem; flex-wrap: wrap; }
        .post-head .name { font-weight: 700; font-size: 0.92rem; }
        .post-head .time { color: #9A9CA3; font-size: 0.76rem; font-variant-numeric: tabular-nums; }
        .topic { margin-left: auto; border-radius: 8px; padding: 0.12rem 0.55rem; font-size: 0.7rem; font-weight: 600; }
        .post-title { font-weight: 600; font-size: 0.95rem; margin: 0.3rem 0 0.1rem; }
        .post-text { font-size: 0.92rem; line-height: 1.75; color: #3A3C42; overflow-wrap: anywhere; }
        .post-actions { display: flex; gap: 1.1rem; margin-top: 0.55rem; }
        .post-actions a, .post-actions button { background: none; border: none; padding: 0; color: #9A9CA3; font-size: 0.78rem; font-weight: 600; cursor: pointer; font-family: inherit; }
        .post-actions a:hover { color: #17181C; }
        .post-actions button:hover { color: #C2402A; }
        .post-actions a:focus-visible, .post-actions button:focus-visible { outline: 2px solid #FF7A59; outline-offset: 2px; border-radius: 4px; }
        .empty { color: #6E7076; text-align: center; padding: 3.5rem 1rem; }
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

        <main class="feed">
            <div class="feed-head">ホーム</div>

            @if($posts->isEmpty())
                <p class="empty">まだポストがありません。</p>
            @else
                @php
                    $grad = [
                        ['#F7B733', '#E8792B'],
                        ['#5B8DEF', '#3F5FD0'],
                        ['#34B58B', '#1E8A6E'],
                        ['#EF6A6A', '#D03F55'],
                        ['#9B6CE8', '#6E48C9'],
                        ['#F2955C', '#DB6B3A'],
                        ['#46B5C9', '#2E8BA8'],
                    ];
                    $topicTone = [
                        'お知らせ' => ['#FFF3DB', '#8A5A16'],
                        '技術メモ' => ['#E7F0FD', '#2F5AA8'],
                        '雑記' => ['#EFEDE6', '#6E6A5B'],
                    ];
                @endphp
                @foreach ($posts as $post)
                    @php
                        [$g1, $g2] = $grad[$post->user->id % count($grad)];
                        [$tBg, $tFg] = $topicTone[$post->category->name] ?? ['#EFEDE6', '#6E6A5B'];
                    @endphp
                    <article class="post">
                        <div class="avatar" style="background: linear-gradient(135deg, {{ $g1 }}, {{ $g2 }});">{{ mb_substr($post->user->name, 0, 1) }}</div>
                        <div class="post-body">
                            <div class="post-head">
                                <span class="name">{{ $post->user->name }}</span>
                                <span class="time">{{ $post->created_at->format('n月j日 H:i') }}</span>
                                <span class="topic" style="background: {{ $tBg }}; color: {{ $tFg }};">{{ $post->category->name }}</span>
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
        </main>
    </div>
</body>
</html>
