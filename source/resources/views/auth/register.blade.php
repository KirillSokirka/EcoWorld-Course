<div id="signUp-modal" class="auth-modal">
    <div class="modal-content">
        <span class="close"><a href="{{ route('home.perform')}}">&times;</a></span>
        <p>Вітаємо!</p>

        <form method="post" action="{{ route('register.perform') }}" id="form">
            @csrf
            @if ($errors->has('email'))
                <span>{{ $errors->first('email') }}</span>
            @endif
            <input class="info-input" name="email" value="{{ old('email') }}"
                   placeholder="Пошта" required>

            @if ($errors->has('username'))
                <span>{{ $errors->first('username') }}</span>
            @endif
            <input class="info-input" name="username" value="{{ old('username') }}"
                   placeholder="Ім'я" required>
            @if ($errors->has('password'))
                <span>{{ $errors->first('password') }}</span>
            @endif
            <input class="info-input" id="password" name="password" value="{{ old('password') }}"
                   placeholder="Пароль" required>
            <input class="info-input" id="confirmPassword" name="password_confirmation" value="{{ old('password') }}"
                   placeholder="Повторіть пароль">

            <button type="submit" >Зареєструватися</button>
        </form>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
