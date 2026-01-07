@extends('layouts.app')

@section('title', 'マイページ')

@section('content')

<style>
.mypage-wrapper{
    width:900px;
    margin:40px auto 80px;
}

/* ===== プロフィール ===== */
.mypage-profile-section{
    display:flex;
    align-items:center;
    gap:24px;
    margin-bottom:30px;
}

.mypage-avatar{
    width:80px;
    height:80px;
    border-radius:50%;
    background:#ddd;
}

.mypage-username{
    font-size:20px;
    font-weight:700;
}

.edit-profile-btn{
    padding:8px 14px;
    border:1px solid #333;
    border-radius:6px;
    text-decoration:none;
    color:#333;
    font-size:14px;
}

/* ===== タブ ===== */
.mypage-tabs{
    display:flex;
    gap:30px;
    border-bottom:1px solid #ccc;
    margin-bottom:30px;
}

.mypage-tab{
    padding-bottom:10px;
    text-decoration:none;
    color:#333;
}

.mypage-tab.active{
    color:red;
    border-bottom:2px solid red;
}

/* ===== 商品一覧 ===== */
.mypage-items-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:24px;
}

.mypage-item-image{
    width:100%;
    height:180px;
    background:#eee;
    border-radius:6px;
    overflow:hidden;
}

.mypage-item-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.mypage-item-title{
    margin-top:8px;
    font-size:14px;
    text-align:center;
}
</style>

<div class="mypage-wrapper">

    {{-- ===== プロフィール ===== --}}
    <div class="mypage-profile-section">

        <div class="mypage-avatar"></div>

        <div>
            <p class="mypage-username">
                {{ $profile->nickname ?? '未設定' }}
            </p>
        </div>

        <div style="margin-left:auto;">
            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                プロフィールを編集
            </a>
        </div>

    </div>

    {{-- ===== タブ ===== --}}
    <div class="mypage-tabs">

        <a href="{{ route('mypage.index',['page'=>'sell']) }}"
           class="mypage-tab {{ $page==='sell' ? 'active' : '' }}">
            出品した商品
        </a>

        <a href="{{ route('mypage.index',['page'=>'buy']) }}"
           class="mypage-tab {{ $page==='buy' ? 'active' : '' }}">
            購入した商品
        </a>

    </div>

    {{-- ===== 商品一覧 ===== --}}
    <div class="mypage-items-grid">

        {{-- 出品した商品 --}}
        @if ($page === 'sell')
            @foreach($sellItems as $item)
                <a href="{{ route('items.show', $item) }}">

                    <div class="mypage-item-image">
                        <img
                            src="{{ \Illuminate\Support\Str::startsWith($item->image,['http://','https://'])
                                ? $item->image
                                : asset('images/dummy.png') }}"
                            alt="{{ $item->title }}"
                        >
                    </div>

                    <p class="mypage-item-title">
                        {{ $item->title }}
                    </p>

                </a>
            @endforeach
        @endif

        {{-- 購入した商品 --}}
        @if ($page === 'buy')
            @foreach($buyItems as $item)
                <a href="{{ route('items.show', $item) }}">

                    <div class="mypage-item-image">
                        <img
                            src="{{ \Illuminate\Support\Str::startsWith($item->image,['http://','https://'])
                                ? $item->image
                                : asset('images/dummy.png') }}"
                            alt="{{ $item->title }}"
                        >
                    </div>

                    <p class="mypage-item-title">
                        {{ $item->title }}
                    </p>

                </a>
            @endforeach
        @endif

    </div>

</div>

@endsection
