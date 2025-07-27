
function totxt(e) {
    e = e.value.trim();
    return e;
}

function validation(input, inputName, re) {

    function Rfalse() {
        input.style = "border-bottom:1px solid red;background-image: linear-gradient(0deg, rgba(255,0,0,.3) 0%, rgba(0,0,0,0) 30%);";

    }

    function Rtrue() {
        input.style = "border-bottom:1px solid green;background-image: linear-gradient(0deg, rgba(0,255,0,.3) 0%, rgba(0,0,0,0) 30%);";
    }

    function content() {
        swal("Noticeable", `The ${inputName} must Contains only letters and numbers for easy memorization`, "error");
    }

    function number(less, more) {
        if (totxt(input).length < less || totxt(input).length > more) {
            swal("Noticeable", `the ${inputName} Not less than ${less} and not more than ${more}.`, "error");

        } else {
            content()
        }
    }

    function empty() {
        swal("Noticeable", `You should not leave the  ${inputName} field blank .`, "error");

    }

    function incorrect() {
        swal("Noticeable", `The ${inputName} is in correct.`, "error");
    }

    if (re.test(totxt(input))) {
    
    Rtrue()
    return true
                    
    } else {


        if (totxt(input) == "") {
            empty();
        } else {

            if (inputName == "username") {
                number(5, 15)
            } else if (inputName == "password") {
                number(7, 14)
            } else {
                if (inputName == "email") {
                    incorrect()
                } else {
                    content()
                }

            }




        }

        Rfalse();
        return false
    }
}
function check() {



    let nameRe = /^\w{5,15}\s\w{5,15}$/;
    let usernameRe = /^[A-Za-z0-9]{5,15}$/;
    let emailRe = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let passwordRe = /^[A-Za-z0-9]{7,14}$/;
    let name = document.getElementById("name");
    let username = document.getElementById("username");
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let button = document.getElementById("button");
    let nameLabel = document.getElementById("nameLabel");
    let usernameLabel = document.getElementById("usernameLabel");
    let emailLabel = document.getElementById("emailLabel");
    let passwordLabel = document.getElementById("passwordLabel");



   
    let passwordCorrect = validation(password, "password", passwordRe);
    let emailCorrect = validation(email, "email", emailRe);
    let usernameCorrect = validation(username, "username", usernameRe);
    let nameCorrect = validation(name, "name", nameRe);
    if (usernameCorrect == true && emailCorrect == true && passwordCorrect == true && nameCorrect == true)  {
        

        name.style = "border-bottom:1px solid #fff;background-image: rgba(0,0,0,0);";
        username.style = "border-bottom:1px solid #fff;background-image: rgba(0,0,0,0);";

        email.style = "border-bottom:1px solid #fff;background-image: rgba(0,0,0,0);";

        password.style = "border-bottom:1px solid #fff;background-image: rgba(0,0,0,0);";



        return true


    }else{
        return false
    }



}

let nameIcon = document.getElementById("nameIcon");
let userIcon = document.getElementById("userIcon");
let emailIcon = document.getElementById("emailIcon");
let passIcon = document.getElementById("passIcon");

nameIcon.onclick = function() {

    swal(`name must be 
          # Contains +10 letters and numbers.
          # have a space.`);
}

userIcon.onclick = function() {

    swal(`Username must be 
          # Contains only letters and numbers for easy memorization.
          # Not less than 5 and not more than 15.
          #Not be already used before.`);
}
emailIcon.onclick = function() {

    swal(`The email must be valid to communicate with you in case of sending a confirmation code.`);
}
passIcon.onclick = function() {

    swal(`Password must be
         # Contains only letters and numbers for easy memorization.
         # Not less than 7 and not more than 14. `);
}


function login() {
    let username = document.getElementById("username2");
    let password = document.getElementById("password2");
    let button = document.getElementById("button2");



}
