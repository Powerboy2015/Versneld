const tableContainer = document.querySelector(".reservationTable");

// #TODO we need a fetch here that transforms the userId to username,
// the pakketType to a name

function createCard(
    resId,
    userId,
    startDatum,
    eindDatum,
    pakketType,
    locatie,
    aantPers
) {
    const tableDiv = document.createElement("div");
    tableDiv.classList.add("card");

    const head = document.createElement("h2");
    head.textContent = "Reservation Date";

    tableDiv.appendChild(head);

    tableContainer.appendChild(tableDiv);
    return true;
}

for (let i = 0; i < 8; i++) {
    createCard();
}
