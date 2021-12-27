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

  var cont_principal = document.querySelector('form div');
  var contenedores_estudiante = document.querySelectorAll('.estudiante');
  var contenedores_profesor = document.querySelectorAll('.profesor');
  var contenedores_administrador = document.querySelectorAll('.administrador');
  
  document.getElementById('usuario_rol').addEventListener('change', function(e){
    let val = e.target.value;
    console.log('Cambio');
  
    if(val == "ROLE_USER"){
      contenedores_estudiante.forEach( i =>  { cont_principal.appendChild(i); i.style.display="flex"; } );
      contenedores_profesor.forEach( i =>  {try{cont_principal.removeChild(i)} catch{}} )
      contenedores_administrador.forEach( i => {try{cont_principal.removeChild(i)} catch{}} )
    }
    if(val == "ROLE_TEACHER"){
      contenedores_profesor.forEach( i => { cont_principal.appendChild(i); i.style.display="flex"; } );
      contenedores_estudiante.forEach( i => {try{cont_principal.removeChild(i)} catch{}} )
      contenedores_administrador.forEach( i => {try{cont_principal.removeChild(i)} catch{}} )
    }
    if(val == "ROLE_ADMIN"){
      contenedores_administrador.forEach( i => { cont_principal.appendChild(i); i.style.display="flex"; } )
      contenedores_profesor.forEach( i => {try{cont_principal.removeChild(i)} catch{}} )
      contenedores_estudiante.forEach( i => {try{cont_principal.removeChild(i)} catch{}} )
    }
  
  });
  
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