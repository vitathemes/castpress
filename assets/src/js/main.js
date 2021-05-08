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
let makemeup_IsBackward;
document.addEventListener("keydown", function (e) {
  if (e.shiftKey && e.keyCode == 9) {
    // Shift + tab
    makemeup_IsBackward = true;
  } else {
    // Tab
    makemeup_IsBackward = false;
  }
});

/*--------------------------------------*\
  #Toggle Header Class
\*--------------------------------------*/
const makemeup_headerSearch = document.querySelector(".js-header__search");
const makemeup_headerSearchIcon = document.querySelector(".js-header__search-icon");

makemeup_headerSearchIcon.addEventListener("click", function () {
  makemeup_headerSearch.classList.toggle("toggled");

  // Search form trap focus
  if (makemeup_headerSearch.classList.contains("toggled")) {
    // Backward
    const makemeup_headerSearchField = document.querySelector(".search-field");
    makemeup_headerSearchIcon.addEventListener("blur", function (e) {
      if (makemeup_IsBackward) {
        makemeup_headerSearchField.focus();
      }
    });
    // Forward
    const makemeup_headerSearchButton = document.querySelector(
      ".c-search-form__submit"
    );
    makemeup_headerSearchButton.addEventListener("blur", function (e) {
      console.log(makemeup_IsBackward);
      if (makemeup_IsBackward === false) {
        makemeup_headerSearchIcon.focus();
      }
    });
  }
});

/*--------------------------------------*\
  #Toggle Transcript
\*--------------------------------------*/
const makemeup_transcript = document.querySelector(".js-single__transcript__more");
const makemeup_transcriptBlock = document.querySelector(
  ".c-single__transcript__content"
);

makemeup_transcript.addEventListener("click", function () {
  makemeup_transcriptBlock.classList.toggle("is-open");
});
