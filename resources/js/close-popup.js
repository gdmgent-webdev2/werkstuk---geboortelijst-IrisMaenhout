const closeBtn = document.querySelector('.close');
const popup = document.querySelector('.popup');
const overlay = document.querySelector('.overlay');

closeBtn.addEventListener('click', ()=>{
    popup.classList.add('hidden');
    overlay.classList.add('hidden');
});
