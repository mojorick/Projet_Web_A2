const container =document.querySelector('.container');
const registerBtn =document.querySelector('.register-btn');
const loginBtn =document.querySelector('.login-btn');


registerBtn.addEventListener('click', function(e){
    container.classList.add('active');
});

loginBtn.addEventListener('click', function(e){
    container.classList.remove('active');
});


(function(){
var email = document.getElementById('email');
var errorMessage = document.getElementById('error-message');

function validateEmail() {
    if (/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$/i.test(email.value)) {
        email.classList.add('correct');
        email.classList.remove('incorrect');
        errorMessage.style.display = 'none';
    }else if(email.value==''){
        email.classList.add('correct');
        email.classList.remove('incorrect');
        errorMessage.style.display = 'none';
    } 
    else {
        email.classList.add('incorrect');
        email.classList.remove('correct');
        errorMessage.style.display = 'block';
    }
}

email.addEventListener('keyup', validateEmail);
email.addEventListener('blur', validateEmail);
})();
