// Toggle class
const headerSearch = document.querySelector(".c-header__search");
const headerSearchIcon = document.querySelector(".c-header__search-icon");

headerSearchIcon.addEventListener("click", function () {
  headerSearch.classList.toggle("toggled");
});
