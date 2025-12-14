@extends('layouts.app')

@section('title', '商品出品')

@section('content')

<div class="form-container">
    <h1 class="page-title">商品の出品</h1>

    {{-- ▼ バリデーションエラー表示 --}}
    @if ($errors->any())
        <div style="color:red; margin-bottom:20px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('items.store') }}">
        @csrf

        <h2 class="section-title">商品の詳細</h2>

        {{-- カテゴリー --}}
        <label>カテゴリー</label>
        <div class="category-list">
            @foreach ([
                'ファッション','家電','インテリア','レディース','メンズ','コスメ',
                '本','ゲーム','スポーツ','キッチン','ハンドメイド','アクセサリー',
                'おもちゃ','ベビー・キッズ'
            ] as $category)
                <label class="category-item">
                    <input type="radio" name="category" value="{{ $category }}">
                    <span>{{ $category }}</span>
                </label>
            @endforeach
        </div>

        {{-- 商品画像URL（ここ重要） --}}
        <label>商品画像URL</label>
        <input
            type="text"
            name="image"
            class="input"
            placeholder="https://placehold.jp/300x200.png"
        >

        {{-- 商品の状態 --}}
        <label class="form-label">商品の状態</label>
        <select name="status" class="input">
            <option value="">選択してください</option>
            <option value="新品">新品</option>
            <option value="未使用に近い">未使用に近い</option>
            <option value="良好">良好</option>
            <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
            <option value="やや傷や汚れあり">やや傷や汚れあり</option>
            <option value="傷や汚れあり">傷や汚れあり</option>
        </select>

        {{-- 商品名 --}}
        <label>商品名</label>
        <input type="text" name="title" class="input">

        {{-- ブランド名（任意） --}}
        <label>ブランド名（任意）</label>
        <input type="text" name="brand" class="input">

        {{-- 商品説明 --}}
        <label>商品の説明</label>
        <textarea name="description" class="textarea"></textarea>

        {{-- 価格 --}}
        <label>価格</label>
        <input type="number" name="price" class="input">

        {{-- 出品ボタン --}}
        <button type="submit" class="submit-btn">出品する</button>
    </form>
</div>

@endsection
