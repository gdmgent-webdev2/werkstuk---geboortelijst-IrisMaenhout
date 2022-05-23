const openFilterBtn = document.querySelector('.open-sidebar');
const overlay = document.querySelector('.overlay');
const popup = document.querySelector('.popup');
const toggle = document.querySelectorAll('toggle');
const titles = document.querySelectorAll('.parent-toggle');

openFilterBtn.addEventListener('click', ()=>{
    popup.classList.remove('hidden');
    overlay.classList.remove('hidden');
})

titles.forEach(title => {
    title.addEventListener('click', ()=>{
        const parentDiv = title.parentNode;
        const child = parentDiv.querySelector('.child-toggle');
        child.classList.toggle('hidden');
    });

});

