const nav = document.querySelector('nav');
const height = document.querySelector('header').offsetHeight

window.onscroll = function() {
    changeNav(nav.offsetHeight/1.20,nav);
}

function changeNav(height,nav) {
    if (document.body.scrollTop > height || document.documentElement.scrollTop > height) {
        nav.classList.add('scroll');
    } else {
        nav.classList.remove('scroll');
    }
}

const menuBut = document.querySelector("#hamburger");
const navi = document.querySelector('.navigation');


menuBut.addEventListener('click',(e) =>{
    e.preventDefault();

    navi.classList.toggle('responsive');
    menuBut.classList.toggle('change');
})