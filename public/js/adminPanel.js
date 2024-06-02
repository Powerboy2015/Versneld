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

async function openPanel(link){
    const response = await fetch(link)

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

async function openElevationPanel(link){
    const response = await fetch(link)

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

async function updateUserType(data,link) {
    const response = await fetch(link,{
        method: "POST",
        body:data
    })

    if(response.ok) {
        return response.json();
    } else {
        return null;
    }

}

function createCloseBut() {
    const closeBut= document.querySelector('#button-close');
                closeBut.addEventListener('click',(e) =>{
                    bod.innerHTML = '';
                })
}

function addResponseEvent() {
    const form = document.querySelector("#userForm");
    form.addEventListener('submit',(e) =>{
        e.preventDefault();

        let data = new FormData(form);
        console.log(form.action)
        updateUserType(data,form.action);
    })
}

const bod = document.querySelector('#open');
// just copies the html code into the panel.



// START IS HERE
getUsers().then((resp) =>{
    panel.innerHTML = resp;

    const changeUser = document.querySelectorAll('.change-User');
    
    changeUser.forEach((element) => {
        element.addEventListener('click', (e) =>{
            e.preventDefault();
            openPanel(element.href).then((resp) => {
                bod.innerHTML = resp;
                
                // closes the update user panel
                createCloseBut();
                
            });
        })
    })

    const userTypes = document.querySelectorAll('.user-type');

    userTypes.forEach((element) =>{
        element.addEventListener('click',(e) =>{
            e.preventDefault();
            openElevationPanel(element.href).then((resp) =>{
                bod.innerHTML= resp;
                createCloseBut();
                addResponseEvent();
            })
        })
    })
    
})




