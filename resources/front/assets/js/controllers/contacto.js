function validatePassword() {
    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
}

/* SHOW PASSWORD */
function showPassword () {
    var x = document.getElementById("password");
    var z = document.getElementById("confirm_password");
    var y = document.getElementById("form-eye");
    if (x.type === "password") {
        x.type = "text";
        z.type = "text";
        y.className = "fas fa-eye-slash";
    } else {
        x.type = "password";
        z.type = "password";
        y.className = "fas fa-eye";
    }
}

/* INPUT FILE */
$('#customFile').change(function() {
    var file = $('#customFile')[0].files[0].name;
    $('#fileInputName').text(file);
});

$(document).ready(function(){
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcsbbAUAAAAAIajsolNUK_l3XVsCsFdDZLueHPv', {action: 'comentario'}).then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
});

/* FORM VALIDATION */
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();