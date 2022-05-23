/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/close-popup.js ***!
  \*************************************/
var closeBtn = document.querySelector('.close');
var popup = document.querySelector('.popup');
var overlay = document.querySelector('.overlay');
closeBtn.addEventListener('click', function () {
  popup.classList.add('hidden');
  overlay.classList.add('hidden');
});
/******/ })()
;