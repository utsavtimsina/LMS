var emailError = document.getElementById('email-error');
var passwordError = document.getElementById('password-error');





//email
function validateEmail() {
    
    var email = document.getElementById('email').value;

    if (email.length == 0) {
        emailError.innerHTML = 'Email is required';
        return false;
    }
    if (!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
        emailError.innerHTML = 'Please enter a valid email';
        return false;
    }
    emailError.innerHTML = 'valid';
    return true;
}


//password
function validatePassword() {
    var password = document.getElementById('pass').value;

    if (password.length == 0) {
        passwordError.innerHTML = 'Password is required';
        return false;
    }
    // if (!password.match(/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/)) {
    //     passwordError.innerHTML = 'Enter valid password';
    //     return false;
    // }
    passwordError.innerHTML = 'valid';
    return true;
}