const wrapper = document.querySelector(".filter-wrapper"),
selectBtn = wrapper.querySelector(".select-btn"),
searchInp = wrapper.querySelector("input"),
options = wrapper.querySelector(".options");

let cities = ["Kyiv", "Lviv", "Odesa", "Dnipro", "Donetsk", "Kherson", "Poltava",
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
    wrapper.classList.remove("active");
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

selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));
