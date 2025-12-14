<h1>配送先住所</h1>

<form action="{{ route('address.update') }}" method="POST">
    @csrf

    <div>
        <label>郵便番号</label><br>
        <input type="text" name="postal_code"
            value="{{ old('postal_code', $address->postal_code ?? '') }}">
    </div>

    <div>
        <label>住所</label><br>
        <input type="text" name="address"
            value="{{ old('address', $address->address ?? '') }}">
    </div>

    <div>
        <label>建物名</label><br>
        <input type="text" name="building"
            value="{{ old('building', $address->building ?? '') }}">
    </div>

    <button type="submit">保存</button>
</form>