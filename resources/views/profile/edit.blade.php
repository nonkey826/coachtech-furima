<h1>プロフィール編集</h1>

<form action="{{ route('profile.update') }}" method="POST">
    @csrf

    <div>
        <label>ニックネーム</label><br>
        <input type="text" name="nickname"
            value="{{ old('nickname', $profile->nickname ?? '') }}">
    </div>

    <button type="submit">保存</button>
</form>
