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

async function openElevationPanel(){
    const response = await fetch('/api/elevation')

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

function createCloseBut() {
    const closeBut= document.querySelector('#button-close');
                closeBut.addEventListener('click',(e) =>{
                    bod.innerHTML = '';
                })
}

function userTypeListener(){

}


const bod = document.querySelector('#open');
// just copies the html code into the panel.
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
            openElevationPanel().then((resp) =>{
                bod.innerHTML= resp;
            })
        })
    })
    
})


