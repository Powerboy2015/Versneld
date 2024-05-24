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
const router = document.querySelector("#router");
const data = new URLSearchParams();

data.append("type", "testpage");



FetchServerData("/user/test", data).then((resp) => {
    if (resp != false) {
        console.log(resp);
        router.innerHTML = resp;
    }
});
