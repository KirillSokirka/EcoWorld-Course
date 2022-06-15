@extends('layout')

@section('container')
<div class="announcment-creation-wrapper">

    @if (count($errors) > 0)
        <div class="input_errors">
            There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form" action="{{ route('store.perform') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form__group field">
            <input type="input" class="form__field" placeholder="Заголовок оголошення" name="title" id='name'
                   required />
            <label for="name" class="form__label">Заголовок оголошення</label>
        </div>

        <div class="form__group field">
            <textarea type="input" class="form__field big" placeholder="Опис оголошення" required
                      name="description" id="description">
            </textarea>
            <label for="name" class="form__label">Опис оголошення</label>
        </div>

        <div class="form__group field">
            <input type="input" class="form__field" placeholder="Місце прибрання" name="location" id='location'
                   required />
            <label for="location" class="form__label">Місце прибрання</label>
        </div>

        <div class="form__group datetime field">
            <input type="datetime-local" class="form__field" data-date-format="dd/mm/yyyy" name="date" id='date'
                   required />
        </div>

        <div class="form__group field file">
            <input type="file" class="file__field" name="images[]" multiple/>
            <label for="file" class="file__label" >Завантажте фото сміття</label>
        </div>

        <div class="form__group">
            <button type="submit" class="form__btn">Розмістити оголошення</button>
        </div>
    </form>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="../js/files.js"></script>
@endsection
