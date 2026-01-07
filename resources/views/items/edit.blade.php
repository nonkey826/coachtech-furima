@extends('layouts.app')

@section('content')
<h1>商品画像の変更</h1>

<form method="POST" action="{{ route('items.update', $item) }}">
    @csrf
    @method('PUT')

    <label>画像URL</label>
    <input type="text" name="image" value="{{ $item->image }}" style="width:100%">

    <button>更新する</button>
</form>
@endsection
