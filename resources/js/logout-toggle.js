const user = document.querySelector('nav .cursor-pointer .username');
const arrow = user.querySelector('i');
const logoutLink = document.querySelector('nav .cursor-pointer .logout');

user.addEventListener('click', (toggle)=>{
    if(arrow.classList.contains('fa-angle-down')){
        arrow.classList.remove('fa-angle-down');
        arrow.classList.add('fa-angle-up');

        logoutLink.classList.remove('hidden');
    }else{
        arrow.classList.add('fa-angle-down');
        arrow.classList.remove('fa-angle-up');

        logoutLink.classList.add('hidden');
    }
})

