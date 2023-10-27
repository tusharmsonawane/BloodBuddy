let Menubtn =document.querySelector(".menu");
let Menupage =document.querySelector(".navlist");

Menubtn.onclick =function () {
  $(Menupage).toggleClass('active');
}

window.addEventListener("scroll", function () {
    var header =document.querySelector('header');
    header.classList.toggle('active',window.scrollY > 0);
     })

