@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<h1>商品一覧</h1>

<div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px;">
@foreach ($items as $item)
    <div>
        <img
    src="{{ Str::startsWith($item->image, ['http://', 'https://'])
            ? $item->image
            : asset('images/dummy.png') }}"
    alt="{{ $item->title }}"
    style="width:100%; height:auto;"
>
        <strong>
            <a href="{{ route('items.show', $item) }}">
                {{ $item->title }}
            </a>
        </strong><br>

        ¥{{ number_format($item->price) }}
    </div>
@endforeach
</div>

@endsection
