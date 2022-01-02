document.addEventListener('DOMContentLoaded', ()=>{


  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()
    
  // VALIDACION PERSONALIZADA
  document.querySelector('form').addEventListener('submit', function(e){
    let pass = document.querySelector('#password');
    let re_pass = document.querySelector('#rep_password');
  
    if(pass.value != re_pass.value){
      pass.setCustomValidity("Las contraseñas no coinciden.")
      pass.parentElement.querySelector('.invalid-feedback').innerHTML = pass.validationMessage
      e.preventDefault();
      e.stopPropagation();
    }
  
  });
}, false);