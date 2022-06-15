const area = document.querySelector(".annoumcments-area"),
    button = area.querySelector(".show-more-btn");

const placeAnnouncements = async () => {

    let data = [];
    let imageUrl = 'images/'
    try {
        if (area.getAttribute('data') !== null) {
            id = area.getAttribute('data');
            data = await axios.get('/EcoWorldWithPHP/lab6/public/announcements/user/' + id)
            imageUrl = '../images/'
        } else {
            data = await axios.get('/EcoWorldWithPHP/lab6/public/announcements/')
        }
    }
    catch (error) {
        console.log(error);
    }

    let rows = []

    if (window.innerWidth <= 550) {
        rows = configureAnnouncementsOnScreen(2, data.data.data, imageUrl);
    } else if (window.innerWidth > 550 && window.innerWidth <= 800) {
        rows = configureAnnouncementsOnScreen(3, data.data.data, imageUrl);
    } else {
        rows = configureAnnouncementsOnScreen(4, data.data.data, imageUrl);
    }

    const elements = area.querySelectorAll(".annoumcment-row");
    elements.forEach(element => element.remove())
    rows.reverse().forEach(row => {
        area.insertAdjacentHTML('afterbegin', row);
    })

    let nonDisplayedRows = selectNonDisplayedRows();

    if (nonDisplayedRows.length !== 0) {
        button.style.display = 'flex';
    }
}

function configureAnnouncementsOnScreen(size, announcements, imageUrl) {
    let rows = [];
    let count = 0, rowCount = 0;
    announcements.forEach(item => {

        if (count === 0) {
            rows[rowCount] = ["<div class='annoumcment-row'>"];
        } else if ((count % size) === 0) {
            rows[rowCount] += "</div>";
            rows[++rowCount] = "<div class='annoumcment-row'>";
        }
        rows[rowCount] += ` <div class="annoumcment-block">
                                <div class="image-part">
                                    <a href='announcements/${item.id}' >
                                    <img src='${imageUrl + item.images[0]}'></a>
                                    <img class="heart-image">
                                    <div class="person-info">
                                        <p>${item.likeCount}</p>
                                        <img class="person-image">
                                    </div>
                                </div>
                                <div class="info-part">
                                    <p class="title">${item.title}</p>
                                    <p class="location-info">локація: ${item.location}</p>
                                    <p class="date-info">дата: ${item.date}</p>
                                </div>
                            </div>`;
        count++;

        if (count === announcements.length) {
            rows[rowCount] += "</div>";
        }
    });
    return rows;
}

window.addEventListener('resize', placeAnnouncements);
placeAnnouncements();

function selectNonDisplayedRows() {
    let rows = area.querySelectorAll('.annoumcment-row');
    let nonDisplayedRows = [];
    rows.forEach(row => {
        var style = window.getComputedStyle(row);
        if (style.display === 'none') {
            nonDisplayedRows.push(row);
        }
    });
    return nonDisplayedRows;
}

button.addEventListener('click', () => {
    var nonDisplayedRows = selectNonDisplayedRows();

    if (nonDisplayedRows.length != 0) {
        var rowToDisplay = nonDisplayedRows[0];
        rowToDisplay.style.display = 'flex';
        nonDisplayedRows.shift();
    }

    if (nonDisplayedRows.length == 0) {
        button.style.display = 'none';
    }
});
