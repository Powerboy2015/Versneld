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

async function callAPi(link) {
    const response = await fetch(link,{
        method:"POST"
    })

    if (response.ok) {
        return response.json();
    }
}

// #TODO we need a fetch here that transforms the userId to username,
// the pakketType to a name;





// rework this shit into php
// THIS SHIT GOTTA GO JUST MAKE IT PAGES

getReservations().then((resp) =>{
    console.log(resp);
    tableContainer.innerHTML = resp;

    // #FIXME delete this shit if not useable.
    // const changeBut = document.querySelectorAll('.changeRes');

    // changeBut.forEach((button) => {
    //     button.addEventListener('click',(e) =>{
    //         e.preventDefault();
    //         callAPi(button.href).then((panel) =>{
    //             console.log(panel);
    //         });
    //     })
    // })
})