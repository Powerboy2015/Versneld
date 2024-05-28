const loginBut = document.querySelector("#login");
const closeBut = document.querySelectorAll(".LoginMenuClose");
const loginContainer = document.querySelector("#loginContainer");

//used to login an user. but is also a more streamlined ez way to do fetches.
async function FetchServerData(location, data) {
    const response = await fetch(location, {
        method: "POST",
        body: data,
    });

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

// sends register form data to the server.
async function CreateUser(data) {
    const response = await fetch("/api/Register", {
        method: "POST",
        body: data,
    });

    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

closeBut.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault;

        loginContainer.classList.remove("appear");
    });
});

if (loginBut != undefined) {
    loginBut.addEventListener("click", (e) => {
        e.preventDefault;
        loginContainer.classList.add("appear");
    });
}

const form = document.querySelector("#loginForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log("Loggin in user...");

    // tries to login user
    FetchServerData("/api/login", new FormData(form)).then((res) => {
        console.log(res);

        if (res == true) {
            // sends the form and the action
            form.submit();
        } else if (res === "Admin") {
            window.location("/admin/profile");
        }
    });
});

// gets the register form values and sends them to the database.
const registerForm = document.querySelector("#registerForm");

registerForm.addEventListener("submit", (e) => {
    e.preventDefault();

    console.log("Creating new account...");
    // redirects the register inputs to the serverside
    CreateUser(new FormData(registerForm)).then((res) => {
        if (res == true) {
            // #TODO okay so now it redirects but doesn't set the user yet. so uhm yeah just do that shit.
            window.location.href = "/user/verifyUserPass";
        }
    });
});

// switches between the login menu and the register menu.
const loginMenu = document.querySelector(".loginMenu");
const registerMenu = document.querySelector(".registerMenu");

const switchMenuBut = document
    .querySelectorAll(".switchMenu")
    .forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();

            loginMenu.classList.toggle("appear");
            registerMenu.classList.toggle("appear");
        });
    });
