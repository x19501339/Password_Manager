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


let container = document.querySelector('.container');
function runcheck(){
    let password = document.querySelector('#myPassword').value;
    /*displaying if the password is "weak", "medium" or "strong" */
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
}
/* Button to diplay password in hased or plain text */
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
