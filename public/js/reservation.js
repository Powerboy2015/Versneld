const tableContainer = document.querySelector(".reservationTable");

async function getReservations() {
    const response = await fetch("/api/getReservations", {
        method: "POST",
    });

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

async function callAPi(link) {
    const response = await fetch(link, {
        method: "POST",
    });

    if (response.ok) {
        return response.json();
    }
}

// calls the reservations and adds them to html
getReservations().then((resp) => {
    tableContainer.innerHTML = resp;
});
