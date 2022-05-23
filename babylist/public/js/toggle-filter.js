/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/toggle-filter.js ***!
  \***************************************/
var openFilterBtn = document.querySelector('.open-sidebar');
var overlay = document.querySelector('.overlay');
var popup = document.querySelector('.popup');
var toggle = document.querySelectorAll('toggle');
var titles = document.querySelectorAll('.parent-toggle');
openFilterBtn.addEventListener('click', function () {
  popup.classList.remove('hidden');
  overlay.classList.remove('hidden');
});
titles.forEach(function (title) {
  title.addEventListener('click', function () {
    var parentDiv = title.parentNode;
    var child = parentDiv.querySelector('.child-toggle');
    child.classList.toggle('hidden');
  });
});
/******/ })()
;