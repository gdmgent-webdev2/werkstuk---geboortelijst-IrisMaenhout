/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/js/share-add-email.js ***!
  \*****************************************/
var link = document.querySelector('.add-email');
var div = document.querySelector('.email-adresses');
var counter = 1;
link.addEventListener('click', function () {
  counter++;
  div.innerHTML += "\n    <div class=\"mt-4\">\n        <label for=\"email-".concat(counter, "\">Persoon ").concat(counter, ": email</label>\n\n        <input type=\"text\" class=\"rounded-md shadow-sm focus:ring focus:border-yellow-500 focus:ring-yellow-500 focus:opacity-40 input-field block mt-1 w-full\" name=\"email-").concat(counter, "\" id=\"email-").concat(counter, "\"/>\n    </div>\n\n    ");
});
/******/ })()
;