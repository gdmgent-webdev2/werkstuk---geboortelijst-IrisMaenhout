const link = document.querySelector('.add-email');
const div = document.querySelector('.email-adresses');

let counter = 1

link.addEventListener('click', () => {
    counter++;
    div.innerHTML +=
        `
    <div class="mt-4">
        <label for="email-${counter}">Persoon ${counter}: email</label>

        <input type="text" class="rounded-md shadow-sm focus:ring focus:border-yellow-500 focus:ring-yellow-500 focus:opacity-40 input-field block mt-1 w-full email-input" name="email-${counter}" id="email-${counter}"/>
    </div>

    `

});




