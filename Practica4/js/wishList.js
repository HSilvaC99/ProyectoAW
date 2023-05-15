

// Obtener el valor del parámetro "listID" de la URL
const urlParams = new URLSearchParams(window.location.search);
const listID = urlParams.get('listID');

// Si el parámetro existe, establecer el color de fondo en el elemento correspondiente
if (listID) {
  const lista = document.getElementById(`lista-${listID}`);
  lista.style.backgroundColor = '#e6f2f5';
}

function redColor(listID){
    const link = document.getElementById(`link-${listID}`)
    const linkTipo = document.getElementById(`link-tipo-${listID}`)
    link.style.color = "blue"
    link.style.textDecoration = "underline"
    linkTipo.style.color = "blue"
}


function blackColor(listID){
    const link = document.getElementById(`link-${listID}`)
    const linkTipo = document.getElementById(`link-tipo-${listID}`)
    link.style.color = "black"
    link.style.textDecoration = "none"
    linkTipo.style.color = "black"
}

function blueColor(){
  const cl = document.getElementById(`crear-lista`)
  cl.style.color = "blue"
  cl.style.textDecoration = "none"
}


function blackColorCL(){
  const cl = document.getElementById(`crear-lista`)
  const el = document.getElementById(`edit-lista`)
  const dl = document.getElementById(`delete-lista`)
  el.style.textDecoration="none"
  el.style.color = "black"
  dl.style.textDecoration ="none"
  dl.style.color = "black"
  cl.style.color = "black"
  cl.style.textDecoration = "none"
}



function greenColorList(){
  const cl = document.getElementById(`edit-lista`)
  cl.style.color = "green"
  cl.style.textDecoration = "none"
}

function redColorList(){
  const cl = document.getElementById(`delete-lista`)
  cl.style.color = "red"
  cl.style.textDecoration = "none"
}


function moveToSelectedList(newListID,oldListID,productID){

  console.log(oldListID);
  console.log(newListID);
  $.ajax({
    url: "moveProductDesired.php",
    data: {"product_id": productID, "oldListID": oldListID, "newListID":newListID},
    type: 'GET',
    success: function(response) {
      console.log("gola");
      console.log(response);
      if (response['success'] == false){
        const button = document.getElementById(`mover-${productID}`);
        const popover = new bootstrap.Popover(button, {
            content: response['error'],
            placement: "bottom",
        });
        popover.show();
        setTimeout(() => {
            popover.dispose();
        }, 2000);
        return ;
      }else{
        document.getElementById(`prod-${productID}`).style.display = "none"
      }
      
    },
    error: function() {},
    
    dataType : "json"
  })
}


function deleteProdList(productID, listID, productName) {
  document.getElementById('eliminado').style.display = "block";
  document.getElementById('h1').style.display = "block";
  document.getElementById('h2').style.display = "block";
  document.getElementById('p').style.display = "block";
  document.getElementById('p1').style.display = "block";
  document.getElementById('icon').style.display = "block";
  document.getElementById('elim').style.display = "block";
  //document.getElementById('des').style.display = "block";
  document.getElementById('producto-eliminado').textContent = "Producto eliminado: " + productName ;
  document.getElementById('producto-eliminado').style.display = "block";

  $.ajax({
    url: "deleteProdDesired.php",
    data: {"product_id": productID, "listID": listID},
    type: 'GET',
    success: function(response) {
     
        document.getElementById(`prod-${productID}`).style.display = "none"
      
      
    },
    error: function() {},
    
    dataType : "json"
  })
  // ...
}


function undo(listID,productID,date){
  document.getElementById('eliminado').style.display = "none";
  document.getElementById('h1').style.display = "none";
  document.getElementById('h2').style.display = "none";
  document.getElementById('p').style.display = "none";
  document.getElementById('p1').style.display = "none";
  document.getElementById('icon').style.display = "none";
  document.getElementById('elim').style.display = "none";
  document.getElementById('des').style.display = "none";
  document.getElementById('producto-eliminado').style.display = "none";
  console.log(date);
  $.ajax({
    url: "undoProdDesired.php",
    data: {"product_id": productID, "listID": listID, "date":date},
    type: 'GET',
    success: function(response) {
     
      console.log(response['success'])
      document.getElementById(`prod-${productID}`).style.display = "block"
      
      
    },
    error: function() {},
    
    dataType : "json"
  })

}

const heartButton = document.querySelector('.heart-button');
heartButton.addEventListener('click', () => {
  const selectedList = document.getElementById('lista-deseos').querySelector('.active');

    if (selectedList) {
        const selectedListID = selectedList.dataset.listId;
       
        const productID = document.getElementById('prodID').textContent;
        
        // Aquí puedes hacer una petición fetch para agregar el producto a la lista de deseos
        $.ajax({
          url: "addProductDesired.php",
          data: {"product_id": productID, "listID": selectedListID},
          type: 'GET',
          success: function(response) {
            if (response['success'] == false){
              const popover = new bootstrap.Popover(heartButton, {
                content: "No ha podido añadir el producto a la lista de deseos",
                placement: "bottom",
              });
              popover.show();
              setTimeout(() => {
                  popover.dispose();
              }, 2000);
              return ;

            }else{
              const popover = new bootstrap.Popover(heartButton, {
                content: "Se ha añadido el producto a la lista de deseos",
                placement: "bottom",
              });
              popover.show();
              setTimeout(() => {
                  popover.dispose();
              }, 2000);
              return ;

            }
            
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            console.log(jqXHR.responseText);
            
          },
          
          dataType : "json"
        })
      } else {
        console.log('No se ha seleccionado ninguna lista de deseos');
    }
});

const dropdownItems = document.querySelectorAll('#lista-deseos a');
dropdownItems.forEach(item => {
    item.addEventListener('click', () => {
        dropdownItems.forEach(item => {
            item.classList.remove('active');
        });
        item.classList.add('active');
        const selectedListName = item.innerText;
        const dropdownButton = document.getElementById('boton');
        dropdownButton.innerText = selectedListName;
    });
});

function createList(option, name,listID){
  if (option ==2){
    var listName = name;
  }else if(option ==1){
    var listName = $('#list-name-to-edit').val();
  
  }else{
    var listName = $('#list-name').val(); // Obtener el nombre de la lista del campo de texto
  }
   console.log(option)
    console.log(listName)
    console.log(listID)
    $.ajax({
        type: 'GET',
        url: 'editList.php', // Ruta donde está el endpoint para crear la lista
        data: {'listName': listName, 'op': option, 'listID':listID},
        success: function(response) {
          console.log(response['pos'])
            if (response['success']) {
                // Si la creación de la lista fue exitosa, actualiza la página
                if (option == 2 || option == 0){//Como se ha borrado, tenemos que cambiar la nueva lista seleccionada
                  history.pushState(null, null, 'wishList.php?listID=' + response['pos']);
                }
                location.reload();
            } else {
                // Si hubo un error en el servidor, muestra un mensaje de error
                alert('Error al crear la lista');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          console.log(jqXHR.responseText);
          
        },
        dataType : "json"
    });
  

}
