const sideBut = document.querySelector(".aside-open");
const asideEl = document.querySelector("aside");
const body = document.querySelector("#open");

async function CallUpdatePanel() {
    const response = await fetch("/api/fetchUpdatePanel");

    if (response.ok) {
        return response.json();
    } else {
        return null;
    }
}

async function ChangeUser(data) {
    const response = await fetch("/api/changeData", {
        method: "POST",
        body: data,
    });

    if (response.ok) {
        return response.json();
    } else {
        return null;
    }
}

sideBut.addEventListener("click", () => {
    asideEl.classList.toggle("force-show");
});

const changeUser = document.querySelector("#ChangeInfo");

changeUser.addEventListener("click", (e) => {
    e.preventDefault();

    // fetches update panel HTML and puts it in the bodyHTML.
    CallUpdatePanel().then((resp) => {
        body.innerHTML = resp;
        let closebut = document.querySelector("#button-close");
        const form = document.querySelector("#changeForm");
        const msgEl = document.querySelector("#msg");

        // when form is subimtte, we change userdata and close the menu.
        // if something went wrong we send error message.
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            ChangeUser(new FormData(form)).then((ret) => {
                if (ret == true) {
                    body.innerHTML = "";
                    window.location.reload();
                } else {
                    msgEl.textContent = ret;
                }
            });
        });

        // closes the update user panel
        closebut.addEventListener("click", (e) => {
            body.innerHTML = "";
        });
    });
});
