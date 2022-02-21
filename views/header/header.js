"use strict";

let menuButton = document.querySelector('.menu-button');
let menu = document.querySelector('nav');
// let menu = document.querySelector('.menu');
let userMenuButton = document.querySelector('.user-menu-button');
let userMenu = document.querySelector('.user-menu');

// menuButton will open or close the menu
if (menuButton && menu) {
  menuButton.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
} else {
  console.error("menu-button or nav not found");
}

// userMenuButton will open or close the menu
if (userMenuButton && userMenu) {
  userMenuButton.addEventListener('click', () => {
    userMenu.classList.toggle('hidden');
  });
} else {
  console.error("user-menu-button or user-menu not found");
}
