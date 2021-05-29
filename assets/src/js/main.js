/*--------------------------------------*\
  #Detect Element inside other element
\*--------------------------------------*/
function castpress_childFinder(castpress_parentElement, castpress_childElement) {
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
    const castpress_headerSearchButton = document.querySelector(".c-search-form__submit");
    castpress_headerSearchButton.addEventListener("blur", function (e) {
      if (castpress_IsBackward === false) {
        castpress_headerSearchIcon.focus();
      }
    });
  }
});

/*--------------------------------------*\
  #Menu Trap focus ( Mobile )
\*--------------------------------------*/
let castpress_mainHeader = document.querySelector(".js-header__main");
let castpress_menuToggle = document.querySelector(".js-header__menu");
let castpress_menu = document.querySelector(".s-nav");
let castpress_lastMenuItem = document.querySelector(
  ".s-nav > .menu-item:last-child > .menu-item__link"
);
const lastMenuItemWithSubmenu = document.querySelector(
  ".s-nav > .menu-item:last-child > .sub-menu > .menu-item:last-child > .menu-item__link"
);

if (castpress_childFinder("body", "s-nav")) {
  let firstMenuItem = document.querySelector(".menu-item__link");
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
      const castpress_defaultHeaderSize = castpress_mainHeader.scrollHeight;

      castpress_mainHeader.style.height = castpress_defaultHeaderSize + "px";

      if (castpress_isBackward === true) {
        firstMenuItem.focus();
      }
    }
  });

  if (castpress_childFinder("body", "sub-menu")) {
    lastMenuItemWithSubmenu.addEventListener("blur", function () {
      if (castpress_IsBackward === false) {
        castpress_menuToggle.focus();
      }
    });
  } else {
    castpress_lastMenuItem.addEventListener("blur", function () {
      if (castpress_IsBackward === false) {
        castpress_menuToggle.focus();
      }
    });
  }
}

/*--------------------------------------*\
  #Toggle Transcript
\*--------------------------------------*/
if (castpress_childFinder("body", "js-single__transcript__more")) {
  const castpress_transcript = document.querySelector(".js-single__transcript__more");
  const castpress_transcriptBlock = document.querySelector(
    ".c-single__transcript__content"
  );

  castpress_transcript.addEventListener("click", function () {
    castpress_transcriptBlock.classList.toggle("is-open");
  });
}

/*--------------------------------------*\
  #Detect Screen Size
\*--------------------------------------*/
function castpress_isMobile() {
  // Get the dimensions of the viewport
  let width =
    window.innerWidth ||
    document.documentElement.clientWidth ||
    document.body.clientWidth;
  return width <= 980 ? true : false;
}
window.onload = castpress_isMobile; // When the page first loads
window.onresize = castpress_isMobile; // When the browser changes size
