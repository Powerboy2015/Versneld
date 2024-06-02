const panel = document.querySelector("#userTable > tbody");
const body = document.querySelector('body');

// fetches users from the server.
async function getUsers() {
    const response = await fetch('/api/fetchAdminTable',{
        method: "POST"
    })

    if (response.ok) {
        return response.json();
    } else {
        return null;
    }
}

async function openChangePanel(userId) {
    const response = await fetch('/api/fetchUpdatePanel', {
        method:"POST",
        body: userId
    })

    if (response.ok) {
        return response.json();
    } else {
        return null;
    }
}

// just copies the html code into the panel.
getUsers().then((resp) =>{
    panel.innerHTML = resp;
})

const rows = document.querySelectorAll('tbody > tr');

rows.forEach((element) =>{
    
    let changeUser = element.querySelector('.change-User');
    let userId = element.querySelector('tr');

    changeUser.addEventListener('click', (e) =>{
        // there is no default,this just checks incase.
        e.preventDefault();
        openChangePanel(userId);

    })
})

