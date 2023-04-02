// サイドメニュー開閉
const hamburgerMenu = document.querySelector(".hamburger-menu");
const sideNav = document.querySelector(".side-nav");
const main = document.querySelector("main");
const modalButtons = document.querySelectorAll("button[data-toggle='modal']");
const modal = document.querySelector(".modal");
const closeButton = document.querySelector("button[data-dismiss='modal']");

sideNav.classList.add("open");
main.classList.add("open");

hamburgerMenu.addEventListener("click", () => {
  sideNav.classList.toggle("open");
  main.classList.toggle("open");
});

modalButtons.forEach(modalButton => {
  modalButton.addEventListener("click", () => {
    if (sideNav.classList.contains("open")) {
      sideNav.classList.remove("open");
      main.classList.remove("open");
    }
    modal.classList.add("open");
  });
});

closeButton.addEventListener("click", () => {
  modal.classList.remove("open");
  if (!sideNav.classList.contains("open")) {
    sideNav.classList.add("open");
    main.classList.add("open");
  }
});






