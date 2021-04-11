// Toggle Header Class
const makemeup_headerSearch = document.querySelector(".c-header__search");
const makemeup_headerSearchIcon = document.querySelector(".c-header__search-icon");

makemeup_headerSearchIcon.addEventListener("click", function () {
  makemeup_headerSearch.classList.toggle("toggled");
});

// Toggle Transcript
const makemeup_transcript = document.querySelector(".js-single__transcript__more");
const makemeup_transcriptBlock = document.querySelector(
  ".c-single__transcript__content"
);

makemeup_transcript.addEventListener("click", function () {
  makemeup_transcriptBlock.classList.toggle("is-open");
});

const makemeup_navArrow = document.querySelector(".js-nav__arrow");

// makemeup_isNavArrowClicked = false;
// makemeup_navArrow.addEventListener("click", function () {
//   makemeup_isNavArrowClicked = !makemeup_isNavArrowClicked;
//   makemeup_navArrowFlag = 0;
//   if (makemeup_isNavArrowClicked === true) {
//     if (makemeup_navArrowFlag > 0) {
//       document.querySelector(".js-nav__arrow + .sub-menu").style.display = "block";
//     }
//   }
// });
