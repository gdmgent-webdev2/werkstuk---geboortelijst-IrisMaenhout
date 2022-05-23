const descriptionToggle = document.querySelector('.description');
const descriptionText = document.querySelector('.description-text');

descriptionToggle.addEventListener('click', ()=>{
    descriptionText.classList.toggle('hidden');
})

