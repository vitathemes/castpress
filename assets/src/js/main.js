/*--------------------------------------*\
  #Detect Element inside other element
\*--------------------------------------*/
function cavatina_childFinder(parentElement, childElement) {
  let result = document
    .querySelector(parentElement)
    .getElementsByClassName(childElement)[0]
    ? true
    : false;
  return result;
}

/*--------------------------------------*\
  #Detect keyboard navigation action
\*--------------------------------------*/
let castpress_IsBackward;
document.addEventListener("keydown", function (e) {
  if (e.shiftKey && e.keyCode == 9) {
    // Shift + tab
    castpress_IsBackward = true;
  } else {
    // Tab
    castpress_IsBackward = false;
  }
});

/*--------------------------------------*\
  #Toggle Header Class
\*--------------------------------------*/
const castpress_headerSearch = document.querySelector(".js-header__search");
const castpress_headerSearchIcon = document.querySelector(".js-header__search-icon");

castpress_headerSearchIcon.addEventListener("click", function () {
  castpress_headerSearch.classList.toggle("toggled");

  // Search form trap focus
  if (castpress_headerSearch.classList.contains("toggled")) {
    // Backward
    const castpress_headerSearchField = document.querySelector(".search-field");
    castpress_headerSearchIcon.addEventListener("blur", function (e) {
      if (castpress_IsBackward) {
        castpress_headerSearchField.focus();
      }
    });
    // Forward
    const castpress_headerSearchButton = document.querySelector(
      ".c-search-form__submit"
    );
    castpress_headerSearchButton.addEventListener("blur", function (e) {
      console.log(castpress_IsBackward);
      if (castpress_IsBackward === false) {
        castpress_headerSearchIcon.focus();
      }
    });
  }
});

/*--------------------------------------*\
  #Toggle Transcript
\*--------------------------------------*/
const castpress_transcript = document.querySelector(".js-single__transcript__more");
const castpress_transcriptBlock = document.querySelector(
  ".c-single__transcript__content"
);

castpress_transcript.addEventListener("click", function () {
  castpress_transcriptBlock.classList.toggle("is-open");
});
