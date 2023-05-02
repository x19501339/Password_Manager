/* javascript for password strength tester */

// Function to determine the strength of the password
function Strength(password){
    let i = 0;
    if(password.length > 6){
        i++;
    }
    if(password.length >= 10){
        i++;
    }
    /* to detect specail characters */
    if(/[A-Z]/.test(password)){
        i++;
    }
    if(/[0-9]/.test(password)){
        i++;
    }
    if(/[A-Za-z0-8]/.test(password)){
        i++;
    }
    return i;  
}

// Get the container element for displaying the strength
let container = document.querySelector('.container');
// Listen for keyup events on the password input field
document.addEventListener("keyup",function(e){
    // Get the password from the input field
    let password = document.querySelector('#myPassword').value;

    // Determine the strength of the password and add/remove CSS classes to display it
    let strength = Strength(password);
    if(strength <= 2){
        container.classList.add('weak');
        container.classList.remove('medium');
        container.classList.remove('strong');
    } else if (strength > 2 && strength < 4){
        container.classList.remove('weak');
        container.classList.add('medium');
        container.classList.remove('strong');
    }  else {
        container.classList.remove('weak');
        container.classList.remove('medium');
        container.classList.add('strong');
    }
})
// Toggle the visibility of the password between plain text and hashed
let pswrd = document.querySelector('#myPassword');
let show = document.querySelector('.show');
show.onclick = function(){
    if(pswrd .type === 'password'){
        pswrd.setAttribute('type', 'text');
        show.classList.add('hide');
    }
    else{
        pswrd.setAttribute('type', 'password');
        show.classList.remove('hide');
    }
}