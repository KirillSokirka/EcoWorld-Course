@extends('layout')
@section('container')

    <div class="annoumcments-area" data="{{ $id }}">
        <button class="show-more-btn">Показати більше</button>
    </div>

    <script type="text/javascript" src="../../../../../EcoWorldWithPHP/lab6/node_modules/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="../js/announcements-area.js"></script>
@endsection
