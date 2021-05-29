/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  // Detect
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

  // Menu header animation (Based on max-content)
  let castpress_isCollapsed = false;
  function castpress_slidetoggle() {
    const headerMain = document.querySelector(".js-header__main");

    const clientHeight = headerMain.clientHeight;
    const scrollerHeight = headerMain.scrollHeight;

    castpress_isCollapsed = !castpress_isCollapsed;
    const noHeightSet = !headerMain.style.height;

    headerMain.style.height =
      (castpress_isCollapsed || noHeightSet ? 0 : scrollerHeight) + "px";

    if (noHeightSet) return castpress_slidetoggle.call(this);
  }

  const siteNavigation = document.getElementById("site-navigation");

  const headerNavigation = document.querySelector(".c-header__navigation");

  headerNavigation.classList.add("is-close");

  // Return early if the navigation don't exist.
  if (!siteNavigation) {
    return;
  }

  const button = siteNavigation.querySelector(".c-header__menu");

  // Return early if the button don't exist.
  if ("undefined" === typeof button) {
    return;
  }

  const menu = siteNavigation.getElementsByTagName("ul")[0];

  // Hide menu toggle button if menu is empty and return early.
  if ("undefined" === typeof menu) {
    button.style.display = "none";
    return;
  }

  if (!menu.classList.contains("s-nav")) {
    menu.classList.add("s-nav");
  }

  // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
  button.addEventListener("click", function () {
    siteNavigation.classList.toggle("toggled");

    castpress_slidetoggle();

    if (button.getAttribute("aria-expanded") === "true") {
      button.setAttribute("aria-expanded", "false");
    } else {
      button.setAttribute("aria-expanded", "true");
    }
  });

  // Get all the link elements within the menu.
  const links = menu.getElementsByTagName("a");

  // Get all the link elements with children within the menu.
  const linksWithChildren = menu.querySelectorAll(
    ".menu-item-has-children > a, .page_item_has_children > a"
  );

  // Toggle focus each time a menu link is focused or blurred.
  for (const link of links) {
    link.addEventListener("focus", toggleFocus, true);
    link.addEventListener("blur", toggleFocus, true);
  }

  /**
   * Sets or removes .focus class on an element.
   */
  function toggleFocus() {
    if (event.type === "focus" || event.type === "blur") {
      let self = this;
      // Move up through the ancestors of the current link until we hit .nav-menu.
      while (!self.classList.contains("nav-menu")) {
        // On li elements toggle the class .focus.
        if ("li" === self.tagName.toLowerCase()) {
          self.classList.toggle("focus");
        }
        self = self.parentNode;
      }
    }
  }
})();
