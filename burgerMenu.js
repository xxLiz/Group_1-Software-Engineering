const menuButton = document.querySelector(".header__menu");
const nav = document.querySelector(".header__nav");
const body = document.querySelector("body");

console.log(1111)

menuButton.addEventListener("click", () => {
  body.classList.toggle("stopped");
  menuButton.classList.toggle("header__menu--active");
  nav.classList.toggle("header__nav--active");
});