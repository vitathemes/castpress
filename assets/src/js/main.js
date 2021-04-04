// let isCollapsed = false;
// function slidetoggle() {
//   const headerMain = document.querySelector(".c-header__main");

//   const clientHeight = headerMain.clientHeight;
//   const scrollerHeight = headerMain.scrollHeight;

//   isCollapsed = !isCollapsed;
//   const noHeightSet = !headerMain.style.height;

//   headerMain.style.height = (isCollapsed || noHeightSet ? 0 : scrollerHeight) + "px";
//   if (noHeightSet) return slidetoggle.call(this);
// }

// document.querySelector(".c-header__menu").addEventListener("click", slidetoggle);

// Toggle Class
const headerSearch = document.querySelector(".c-header__search");
const headerSearchIcon = document.querySelector(".c-header__search-icon");

headerSearchIcon.addEventListener("click", function () {
  headerSearch.classList.toggle("toggled");
});

// Toggle Transcript
const transcript = document.querySelector(".js-single__transcript__more");
const transcriptBlock = document.querySelector(".c-single__transcript__content");

transcript.addEventListener("click", function () {
  transcriptBlock.classList.toggle("is-open");
});
