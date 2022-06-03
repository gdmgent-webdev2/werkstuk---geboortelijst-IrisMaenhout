/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/logout-toggle.js ***!
  \***************************************/
var user = document.querySelector('nav .cursor-pointer .username');
var arrow = user.querySelector('i');
var logoutLink = document.querySelector('nav .cursor-pointer .logout');
user.addEventListener('click', function (toggle) {
  if (arrow.classList.contains('fa-angle-down')) {
    arrow.classList.remove('fa-angle-down');
    arrow.classList.add('fa-angle-up');
    logoutLink.classList.remove('hidden');
  } else {
    arrow.classList.add('fa-angle-down');
    arrow.classList.remove('fa-angle-up');
    logoutLink.classList.add('hidden');
  }
});
/******/ })()
;