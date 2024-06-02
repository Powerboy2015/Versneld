const form = document.querySelector('#reserveForm');

async function createReservation(data) {
    const respsone = await fetch('/api/createReservation', {
        method: "POST",
        body: data
    })

    if (respsone.ok) {
        // response needs to be a boolean.
        return respsone.json();
    } else {
        return null;
    }
}

// #TODO might have to change the enddate according to the pakket chosen.
form.addEventListener("submit", (e) => {
    e.preventDefault();

    let data = new FormData(form);
    createReservation(data).then((resp) =>{
        form.submit();
    });
})