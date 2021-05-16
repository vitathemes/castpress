/*--------------------------------------*\
  #Detect Element inside other element
\*--------------------------------------*/
function castpress_childFinder(
  castpress_parentElement,
  castpress_childElement
) {
  let castpress_result = document
    .querySelector(castpress_parentElement)
    .getElementsByClassName(castpress_childElement)[0]
    ? true
    : false;
  return castpress_result;
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
  #Toggle Header Search Class
\*--------------------------------------*/
const castpress_headerSearch = document.querySelector(".js-header__search");
const castpress_headerSearchIcon = document.querySelector(
  ".js-header__search-icon"
);

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
  #Menu Trap focus ( Mobile )
\*--------------------------------------*/
if (castpress_childFinder("body", "s-nav")) {
  let castpress_mainHeader = document.querySelector(".js-header__main");
  let castpress_menuToggle = document.querySelector(".js-header__menu");

  let castpress_menu = document.querySelector(".s-nav");

  let castpress_menuListItems = castpress_menu.querySelectorAll("li");
  let castpress_menuLinks = castpress_menu.querySelectorAll(".menu-item__link");

  let firstMenuItem = document.querySelector(".menu-item__link");

  const lastMenuItem = document.querySelector(
    ".s-nav > .menu-item:last-child > .sub-menu > .menu-item:first-child > .menu-item__link"
  );

  lastMenuItem.style.backgroundColor = "red";

  let castpress_lastIndex = castpress_menuListItems.length - 1;
  let castpress_isBackward;

  document.addEventListener("keydown", function (e) {
    if (e.shiftKey && e.keyCode == 9) {
      castpress_isBackward = true;
    } else {
      castpress_isBackward = false;
    }
  });

  castpress_menuToggle.addEventListener("blur", function (e) {
    if (castpress_mainHeader.classList.contains("toggled")) {
      if (castpress_isBackward === true) {
        firstMenuItem.focus();
      }
    }
  });

  lastMenuItem.addEventListener("blur", function () {
    console.log("blured");
    if (castpress_IsBackward === false) {
      castpress_menuToggle.focus();
    }
  });
}

/*--------------------------------------*\
  #Toggle Transcript
\*--------------------------------------*/
if (castpress_childFinder("body", "js-single__transcript__more")) {
  const castpress_transcript = document.querySelector(
    ".js-single__transcript__more"
  );
  const castpress_transcriptBlock = document.querySelector(
    ".c-single__transcript__content"
  );

  castpress_transcript.addEventListener("click", function () {
    castpress_transcriptBlock.classList.toggle("is-open");
  });
}
