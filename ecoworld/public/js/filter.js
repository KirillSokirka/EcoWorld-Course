const filterBlock = document.querySelector('.filter-block');
const wrapperCity = filterBlock.querySelector('#cities');
    const selectBtn = wrapperCity.querySelector(".select-btn");
    const searchInp = wrapperCity.querySelector("input");
    const options = wrapperCity.querySelector(".options");

let cities = ["Київ", "Львів", "Одеса", "Дніпро", "Донець", "Херсон", "Полтава",
];

function addCity(selecteCity) {
    options.innerHTML = "";
    cities.forEach(city => {
        let isSelected = city == selecteCity ? "selected" : "";
        let li = `<li onclick="updateName(this)" class="${isSelected}">${city}</li>`;
        options.insertAdjacentHTML("beforeend", li);
    });
}

addCity();

function updateName(selectedLi) {
    searchInp.value = "";
    addCity(selectedLi.innerText);
    wrapperCity.classList.remove("active");
    selectBtn.firstElementChild.innerText = selectedLi.innerText;
}

searchInp.addEventListener("keyup", () => {
    let arr = [];
    let searchWord = searchInp.value.toLowerCase();
    arr = cities.filter(data => {
        return data.toLowerCase().startsWith(searchWord);
    }).map(data => {
        let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
        return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
    }).join("");
    options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! City not found</p>`;
});

selectBtn.addEventListener("click", () => wrapperCity.classList.toggle("active"));

const wrapperPopular = filterBlock.querySelector("#popular"),
    selectBtnPopular = wrapperPopular.querySelector(".select-btn"),
    optionsPopular = wrapperPopular.querySelector(".options");

let popular = ["Найбільш", "Найменш"];

function addPopular(selecteCity) {
    optionsPopular.innerHTML = "";
    popular.forEach(city => {
        let isSelected = city == selecteCity ? "selected" : "";
        let li = `<li onclick="updatePopular(this)" class="${isSelected}">${city}</li>`;
        optionsPopular.insertAdjacentHTML("beforeend", li);
    });
}

addPopular();

function updatePopular(selectedLi) {
    addPopular(selectedLi.innerText);
    wrapperPopular.classList.remove("active");
    selectBtnPopular.firstElementChild.innerText = selectedLi.innerText;
}

selectBtnPopular.addEventListener("click", () => wrapperPopular.classList.toggle("active"));

const wrapperTime = filterBlock.querySelector("#time"),
    selectBtnTime = wrapperTime.querySelector(".select-btn"),
    optionsTime = wrapperTime.querySelector(".options");

let time = ["Місяць", "Тиждень"];

function addTime(selecteCity) {
    optionsTime.innerHTML = "";
    time.forEach(city => {
        let isSelected = city == selecteCity ? "selected" : "";
        let li = `<li onclick="updateTime(this)" class="${isSelected}">${city}</li>`;
        optionsTime.insertAdjacentHTML("beforeend", li);
    });
}

addTime();

function updateTime(selectedLi) {
    addPopular(selectedLi.innerText);
    wrapperTime.classList.remove("active");
    selectBtnTime.firstElementChild.innerText = selectedLi.innerText;

}

selectBtnTime.addEventListener("click", () => wrapperTime.classList.toggle("active"));
