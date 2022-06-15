const description = document.querySelector(".info__description")
const descHeader = description.querySelector(".desc__header");

descHeader.addEventListener('click', () => {
    var descContent = document.getElementById("desc_content");
    var arrow = descHeader.querySelector(".desc__header__img");
    if (descContent.style.display === "none") {
        descContent.style.display = 'flex';
        arrow.style.transform = "rotate(180deg)";
    } else {
        descContent.style.display = 'none';
        arrow.style.transform = "";
    }
})

const bigdescription = document.querySelector(".big__screen_grid .info__description");
const bigdescHeader = bigdescription.querySelector(".desc__header");

bigdescHeader.addEventListener('click', () => {
    var descContent = document.getElementById("desc_content_big");
    var arrow = bigdescHeader.querySelector(".desc__header__img");
    if (descContent.style.display === "none") {
        descContent.style.display = 'flex';
        arrow.style.transform = "rotate(180deg)";
    } else {
        descContent.style.display = 'none';
        arrow.style.transform = "";
    }
})

const big_scren_buttons = document.querySelector("#btn__big_screen");
const small_screen_buttons = document.querySelector("#btn__small_screen");
const desc__big_screen = document.querySelector("#desc__big_screen");
const desc__small_screen = document.querySelector("#desc__small_screen");

function initial_resize() {
    if (window.window.innerWidth <= 900) {
        big_scren_buttons.style.display = 'none'
        small_screen_buttons.style.display = 'flex'
        desc__big_screen.style.display = 'none'
        desc__small_screen.style.display = 'block'
    } else {
        small_screen_buttons.style.display = 'none'
        big_scren_buttons.style.display = 'flex'
        desc__big_screen.style.display = 'block'
        desc__small_screen.style.display = 'none'
    }
}

initial_resize();

window.addEventListener('resize', () => {
    if (window.window.innerWidth <= 900) {
        big_scren_buttons.style.display = 'none'
        small_screen_buttons.style.display = 'flex'
        desc__big_screen.style.display = 'none'
        desc__small_screen.style.display = 'block'
    } else {
        small_screen_buttons.style.display = 'none'
        big_scren_buttons.style.display = 'flex'
        desc__big_screen.style.display = 'block'
        desc__small_screen.style.display = 'none'
    }
});
