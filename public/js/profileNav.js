const sideBut = document.querySelector(".aside-open");
const asideEl = document.querySelector('aside');

sideBut.addEventListener('click',() =>{
    asideEl.classList.toggle('force-show');
})