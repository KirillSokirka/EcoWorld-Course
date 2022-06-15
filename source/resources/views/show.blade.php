@extends('layout')

@section('container')
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
<div class="announcement-info-wrapper">
    <div class="wrapper__info__content">
        <div class="title">
            {{$item->title}}
            <hr class="hr" />
        </div>

        <div class="info">
            <label class="label" for="location">Адреса:</label>
            <p class="info__text" id="location">{{$item->location}}</p>
        </div>

        <div class="info">
            <label class="label" for="date">Час проведення:</label>
            <p class="info__text" id="date">{{$item->date}}</p>
        </div>

        <div class="info">
            <label class="label" for="people">Вже відгукнулося:</label>
            <p class="info__text" id="people">{{$item->likeCount}} небайдужих</p>
        </div>

        <div class="buttons" id="btn__big_screen">
            <button class="apply__btn">Відгукнутися</button>
            <a type="button"><img class="like__image" src="../images/heart.svg"></a>
        </div>
    </div>

    <div class="info__description" id="desc__small_screen">
        <div class="desc__header">
            <p class="desc__header__title">Опис</p>
            <img class="desc__header__img">
        </div>
        <div class="desc__content" id="desc_content" style="display: none;">
            <div class="desc__content__text">
                {{$item->description}}
            </div>
            <div class="desc__content__author">
                Автор оголошення: {{$item->author}}
            </div>
        </div>
        <hr class="hr" />
    </div>

    <div class="big__screen_grid">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($item->images as $image)
                    <div class="swiper-slide">
                        <img src={{ asset('/images/' . $image)}}>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
       <div class="info__description" id="desc__big_screen">
            <div class="desc__header">
                <p class="desc__header__title">Опис</p>
                <img class="desc__header__img">
            </div>
            <div class="desc__content" id="desc_content_big" style="display: none;">
                <div class="desc__content__text">
                    {{$item->description}}
                </div>
                <div class="desc__content__author">
                    Автор оголошення: Олена
                </div>
            </div>
            <hr class="hr" />
        </div>
    </div>

    <div class="buttons"  id="btn__small_screen">
        <button class="apply__btn">Відгукнутися</button>
        <a type="button"><img class="like__image" src="../images/heart.svg"></a>
    </div>

</div>
<script src="../js/announcment-info.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script type="text/javascript">
    const swiper = new Swiper('.swiper', {
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endsection

