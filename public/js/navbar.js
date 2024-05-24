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