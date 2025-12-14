<!-- resources/views/purchase/confirm.blade.php -->

<h1>購入確認</h1>

<p>商品名：{{ $item->title }}</p>
<p>価格：¥{{ number_format($item->price) }}</p>

<p>
    支払い方法：
    @if ($paymentMethod === 'credit')
        クレジットカード
    @elseif ($paymentMethod === 'bank')
        銀行振込
    @else
        コンビニ払い
    @endif
</p>

<form action="{{ route('item.purchase', $item) }}" method="POST">
    @csrf
    <button type="submit">購入確定</button>
</form>
