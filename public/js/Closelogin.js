const loginBut = document.querySelector("#login");
const closeBut = document.querySelector("#LoginMenuClose");
const loginContainer = document.querySelector("#loginContainer");

// an easier way to fetch data from sever
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

closeBut.addEventListener("click", (e) => {
    e.preventDefault;

    loginContainer.classList.remove("appear");
});

loginBut.addEventListener("click", (e) => {
    e.preventDefault;
    loginContainer.classList.add("appear");
});

const form = document.querySelector("#loginForm");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log("Loggin in user...");

    // tries to login user
    FetchServerData("/home/login", new FormData(form)).then((res) => {
        console.log(res);

        if (res == true) {
            // sends the form and the action
            form.submit();
        }
    });
});
