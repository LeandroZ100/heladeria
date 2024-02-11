let profile = document.querySelector('.header .flex .profile-detail');
let userBtn = document.querySelector('#user-btn');

userBtn.addEventListener('click', () => {
    profile.classList.toggle('active');
    searchForm.classList.remove('active');
});

let searchForm = document.querySelector('.header .flex .search-form');
let searchBtn = document.querySelector('#search-btn');

searchBtn.addEventListener('click', () => {
    searchForm.classList.toggle('active');
    profile.classList.remove('active');
});

let navbar = document.querySelector('.header .navbar');
let menuBtn = document.querySelector('#menu-btn');

menuBtn.addEventListener('click', () => {
    navbar.classList.toggle('active');
});

/*--------------home slider------------------------*/
const imgBox = document.querySelector('.slider-container');
const slides = document.getElementsByClassName('slideBox');
var i = 0;

function nextSlide() {
    slides[i].classList.remove('active');
    i = (i + 1) % slides.length;
    slides[i].classList.add('active');
}

function prevSlide() {
    slides[i].classList.remove('active');
    i = (i - 1 + slides.length) % slides.length;
    slides[i].classList.add('active');
}




/*--------------testimonial------------------------*/
// Selecciona los elementos por clase sin el punto
const btns = document.querySelectorAll('.btn1');
const slide = document.getElementById('slide');

for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', function () {
        slide.style.transform = `translateX(${-800 * i}px)`;

        for (let j = 0; j < btns.length; j++) {
            btns[j].classList.remove('active');
        }

        this.classList.add('active');
    });
}
