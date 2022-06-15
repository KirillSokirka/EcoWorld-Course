@extends('layout')
@section('container')

    <div class="filter-block">

        <form>
            <input class="adress-search" placeholder="Адреса місця">
        </form>

        <div class="filter-wrapper">
            <div class="select-btn">
                <span>За містом</span>
                <i class="uil uil-angle-down"></i>
            </div>
            <div class="content">
                <div class="search">
                    <i class="uil uil-search icon"></i>
                    <input spellcheck="false" type="text" placeholder="Search">
                </div>
                <ul class="options"></ul>
            </div>
        </div>

        <div class="filter-wrapper">
            <div class="select-btn">
                <span>За датою</span>
                <i class="uil uil-angle-down"></i>
            </div>
            <div class="content">
                <div class="search">
                    <i class="uil uil-search"></i>
                    <input spellcheck="false" type="text" placeholder="Search">
                </div>
                <ul class="options"></ul>
            </div>
        </div>

        <div class="filter-wrapper">
            <div class="select-btn">
                <span>За популярністю</span>
                <i class="uil uil-angle-down"></i>
            </div>
            <div class="content">
                <div class="search">
                    <i class="uil uil-search"></i>
                    <input spellcheck="false" type="text" placeholder="Search">
                </div>
                <ul class="options"></ul>
            </div>
        </div>

        <div class="more-filters"><a href="src/html/mobile-filters.html">Ще фільтри</a></div>
    </div>

    <div class="annoumcments-area" data="{{ $id }}">
        <button class="show-more-btn">Показати більше</button>
    </div>

    <script type="text/javascript" src="../../node_modules/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="../js/announcements-area.js"></script>
@endsection
