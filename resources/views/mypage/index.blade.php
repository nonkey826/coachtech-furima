<<h1>マイページ</h1>

{{-- プロフィール --}}
<section>
    <h2>プロフィール</h2>

    <p>
        ニックネーム：
        {{ $profile->nickname ?? '未設定' }}
    </p>

    <a href="{{ route('profile.edit') }}">プロフィール編集</a>
</section>

<hr>

{{-- タブ --}}
<nav>
    <a href="{{ route('mypage.index', ['page' => 'buy']) }}">購入した商品</a> |
    <a href="{{ route('mypage.index', ['page' => 'sell']) }}">出品した商品</a> |
    <a href="{{ route('mypage.index', ['page' => 'favorite']) }}">お気に入り</a>
</nav>

<hr>

<section>
    <h2>
        @if ($page === 'sell')
            出品した商品
        @elseif ($page === 'favorite')
            お気に入り商品
        @else
            購入した商品
        @endif
    </h2>

    @if ($items->isEmpty())
        <p>商品はありません。</p>

    {{-- 購入した商品（Purchase） --}}
    @elseif ($page === 'buy')
        <ul>
            @foreach ($items as $purchase)
                <li>
                    <strong>{{ $purchase->item->title }}</strong>
                    （¥{{ number_format($purchase->item->price) }}）

                    @if ($purchase->address)
                        <div>
                            配送先：
                            〒{{ $purchase->address->postal_code }}
                            {{ $purchase->address->address }}
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

    {{-- 出品・お気に入り（Item） --}}
    @else
        <ul>
            @foreach ($items as $item)
                <li>
                    <strong>{{ $item->title }}</strong>
                    （¥{{ number_format($item->price) }}）

                    @if ($item->is_sold)
                        <span style="color:red;">Sold</span>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</section>

