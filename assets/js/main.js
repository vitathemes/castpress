/*--------------------------------------*\
  #Detect screen size
\*--------------------------------------*/
let castpress_clientWindowSize = window.matchMedia("(max-width: 979px)");
function castpress_isMobile(castpress_clientWindowSize) {
    if (castpress_clientWindowSize.matches) {
        // If media query matches
        return true;
    } else {
        return false;
    }
}

castpress_isMobile(castpress_clientWindowSize); // Call listener function at run time
castpress_clientWindowSize.addListener(castpress_isMobile); // Attach listener function on state changes

/*--------------------------------------*\
  #Detect Screen Size
\*--------------------------------------*/
function castpress_isMobile() {
    // Get the dimensions of the viewport
    let width =
        window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    return width <= 980 ? true : false;
}
window.onload = castpress_isMobile; // When the page first loads
window.onresize = castpress_isMobile; // When the browser changes size

/*------------------------------------*\
  #Fade Out Vanilla JS
\*------------------------------------*/
function castpress_fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= 0.04) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

/*------------------------------------*\
  #Fade In Vanilla JS
\*------------------------------------*/
function castpress_fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "block";
    (function fade() {
        let val = parseFloat(el.style.opacity);
        if (!((val += 0.01) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}

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
        if (castpress_isMobile() === true) {
            if (lastMenuItemWithSubmenu === true) {
                lastMenuItemWithSubmenu.addEventListener("blur", function () {
                    console.log("tets");
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
    const castpress_transcriptBlock = document.querySelector(".c-single__transcript__content");

    castpress_transcript.addEventListener("click", function () {
        castpress_transcriptBlock.classList.toggle("is-open");
    });
}

/*--------------------------------------*\
  #Display Audio player 
\*--------------------------------------*/
const castpress_audioPlayer = document.querySelector(".js-single__audio");
const castpress_audioPlayerButton = document.querySelector(".js-btn--play");
const castpress_audioPlayerDownloadButton = document.querySelector(".js-btn--download");
const castpress_externalAudio = document.querySelector(".js-episode__player--embed");

if (castpress_childFinder("body", "js-btn--play")) {
    castpress_audioPlayerButton.addEventListener("click", function () {
        castpress_fadeOut(castpress_audioPlayerButton);

        setTimeout(() => {
            if (castpress_externalAudio !== null) {
                castpress_fadeIn(castpress_audioPlayer, "inline-block");
            } else {
                castpress_fadeIn(castpress_audioPlayerDownloadButton, "flex");
                castpress_fadeIn(castpress_audioPlayer, "inline-block");
            }
        }, 500);
    });
}
