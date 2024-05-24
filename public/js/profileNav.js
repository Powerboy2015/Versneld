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

const navButton = document.querySelector("#menuBut");
const navItem = document.querySelectorAll(".phoneMenu");

navButton.addEventListener("click", (e) => {
    e.preventDefault();

    navItem.forEach((element) => {
        console.log(element);
        element.classList.toggle("force-show");
    });
});
const createBut = document.querySelector("#test");
const router = document.querySelector("#overview");
const data = new URLSearchParams();

createBut.addEventListener("click", (e) => {
    e.preventDefault();
});

data.append("type", "testpage");

FetchServerData("/user/test", data).then((resp) => {
    if (resp != false) {
        console.log(resp);
        router.innerHTML = resp;
    }
});
