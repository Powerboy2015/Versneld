const option = document.querySelector("#Reason");
const reasoning = document.querySelector("#Reasoning");

reasoning.style.display = "none";

option.addEventListener("change", (e) => {
    e.preventDefault();

    if (option.value == 1) {
        reasoning.style.display = "none";
    } else if (option.value == 2) {
        reasoning.style.display = "block";
    }
});
