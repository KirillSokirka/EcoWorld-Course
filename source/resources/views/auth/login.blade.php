<div id="signIn-modal" class="auth-modal">

    <div class="modal-content">
        <span class="close"><a href="{{ route('home.perform')}}">&times;</a></span>
        <p>Вітаємо знову!</p>

        <form action="{{ route('login.perform') }}" method="POST">
            @csrf
            @if ($errors->has('username'))
                <span>{{ $errors->first('username') }}</span>
            @endif
            <input class="info-input" name="username" value="{{ old('username') }}" id="email" placeholder="Пошта">

            @if ($errors->has('password'))
                <span>{{ $errors->first('password') }}</span>
            @endif
            <input class="info-input" name="password" id="password" placeholder="Пароль">

            <button type="submit">Вхід</button>
        </form>
    </div>
</div>
