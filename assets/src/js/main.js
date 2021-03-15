// Toggle class
const headerSearch = document.querySelector(".c-header__search");
const headerSearchIcon = document.querySelector(".c-header__search-icon");

headerSearchIcon.addEventListener("click", function () {
  headerSearch.classList.toggle("toggled");
});

// Toggle Transcript
const transcript = document.querySelector(".js-single__transcript__more");
const transcriptBlock = document.querySelector(
  ".c-single__transcript__content"
);

transcript.addEventListener("click", function () {
  transcriptBlock.classList.toggle("is-open");
});
