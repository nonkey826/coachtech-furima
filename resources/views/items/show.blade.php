@extends('layouts.app')

@section('title', $item->title)

@section('content')

<h1>{{ $item->title }}</h1>

@php
    use Illuminate\Support\Str;
@endphp

<img
    src="{{ Str::startsWith($item->image, ['http://', 'https://'])
            ? $item->image
            : asset('images/dummy.png') }}"
    alt="{{ $item->title }}"
    style="width:300px; margin-bottom:20px;"
>


<p>{{ $item->description }}</p>

<hr>

<h2>コメント</h2>

@if ($item->comments->isEmpty())
    <p>まだコメントはありません</p>
@else
    <ul>
        @foreach ($item->comments as $comment)
            <li>{{ $comment->comment }}</li>
        @endforeach
    </ul>
@endif

<hr>

<h3>コメントを書く</h3>

<form action="{{ route('comments.store', $item) }}" method="POST">
    @csrf
    <textarea name="comment" rows="3" required></textarea>
    <br>
    <button type="submit">投稿</button>
</form>

<hr>

@if ($address)
    <h3>配送先</h3>
    <p>
        〒{{ $address->postal_code }}<br>
        {{ $address->address }}<br>
        @if (!empty($address->building))
            {{ $address->building }}
        @endif
    </p>
@else
    <p>
        配送先が未登録です。
        <a href="{{ route('address.edit') }}">住所を登録する</a>
    </p>
@endif

@if(!$item->is_sold)
    <form action="{{ route('item.purchase', $item) }}" method="POST">
        @csrf
        <button type="submit">購入する</button>
    </form>
@else
    <p>売り切れました</p>
@endif

{{-- 出品者のみ削除可能 --}}
@if(auth()->check() && auth()->id() === $item->user_id)
    <hr>
    <form action="{{ route('items.destroy', $item) }}" method="POST"
          onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button style="color:red;">この商品を削除する</button>
    </form>
@endif

@endsection
