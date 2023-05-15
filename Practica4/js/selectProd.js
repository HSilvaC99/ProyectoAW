// Obtener todas las checkbox
const checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Obtener los elementos <a>
const anularSeleccion = document.getElementById('anular-seleccion');
const noSeleccionado = document.getElementById('no-seleccionado');
const seleccionarTodos = document.getElementById('seleccionar-todos');

// Agregar un event listener a cada checkbox para detectar cuándo cambian
checkboxes.forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
    
    // Obtener todas las checkbox marcadas
    const checkboxesMarcadas = document.querySelectorAll('input[type="checkbox"]:checked');

    // Verificar si hay alguna checkbox marcada
    if(checkboxesMarcadas.length === 0){
      anularSeleccion.style.display = "none";
      seleccionarTodos.style.display = "none";
      noSeleccionado.style.display = "block";

    }else if(checkboxesMarcadas.length > 0 && checkboxesMarcadas.length != checkboxes.length){
        // Si hay una o más checkbox marcadas, mostrar el mensaje de "anular selección"
      anularSeleccion.style.display = "none";
      seleccionarTodos.style.display = "block";
      noSeleccionado.style.display = "none";
    }else{
        // Si todas las checkboxes están marcadas, mostrar el mensaje de "anular selección"
      anularSeleccion.style.display = "block";
      seleccionarTodos.style.display = "none";
      noSeleccionado.style.display = "none";
    }
  });
});



// Agregar event listener a los enlaces
anularSeleccion.addEventListener('click', function(event) {
    event.preventDefault();
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = false;
    });
    anularSeleccion.style.display = 'none';
    noSeleccionado.style.display = 'inline';
    seleccionarTodos.style.display = 'none';
  });
  
  noSeleccionado.addEventListener('click', function(event) {
    event.preventDefault();
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = true;
    });
    anularSeleccion.style.display = 'inline';
    noSeleccionado.style.display = 'none';
    seleccionarTodos.style.display = 'none';
  });
  
  seleccionarTodos.addEventListener('click', function(event) {
    event.preventDefault();
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = true;
    });
    anularSeleccion.style.display = 'inline';
    noSeleccionado.style.display = 'none';
    seleccionarTodos.style.display = 'none';
  });

