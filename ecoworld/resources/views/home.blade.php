@extends('layout')
@section('container')
    <div class="banner">
        <div class="content">
            <div class="title">
                <p>EcoWorld</p>
            </div>
            <div class="slogan">
                <p>Прибери свою вулицю -<br>зроби країну краще!</p>
            </div>
        </div>
    </div>
    <hr>

    <div class="annoumcments-area" data="none" filter-route="">
        <button class="show-more-btn">Показати більше</button>
    </div>

    @yield('login-modal')
    @yield('register-modal')
    <script type="text/javascript" src="../node_modules/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="js/announcements-area.js"></script>
@endsection
