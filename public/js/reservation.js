const tableContainer = document.querySelector(".reservationTable");

async function getReservations() {
    const response = await fetch('/api/getReservations',{
        method: "POST",
    })

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

// #TODO we need a fetch here that transforms the userId to username,
// the pakketType to a name;


getReservations().then((resp) =>{
   resp.forEach(data => {
     createCard(data['resId'],data['userId'],data['startDatum'],data['eindDatum'],data['pakketType'],data['locatie'],data['aantPers']);
     
   });
})

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
    head.textContent = "reservation Id: " +resId;
    
    const time = document.createElement("p");
    time.textContent = startDatum + ' - ' + eindDatum;
    
    const location = document.createElement("p");
    location.textContent = "Locatie: " + locatie;

    const pakket = document.createElement("p");
    pakket.textContent = pakketType;

    const aantal = document.createElement("p");
    aantal.textContent = "aantal personen: " +aantPers;

    tableDiv.appendChild(head);
    tableDiv.appendChild(location);
    tableDiv.appendChild(time);
    tableDiv.appendChild(pakket);
    tableDiv.appendChild(aantal);

    tableContainer.appendChild(tableDiv);
    return true;
}
