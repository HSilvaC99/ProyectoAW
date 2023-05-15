//Cuando se ha seleccionado un producto
function selectOneForPurchase(productID){
    var check = document.getElementById(`check-${productID}`).checked;
    var llega = 0;
    if (check){
        llega = 1;
    }else{
        llega = 0;
    }
    console.log(llega);
    $.ajax({
        url: "updateArrayCheckBox.php",
        data: {"product_id": productID, "option":1, "check": llega},
        type: 'GET',
        success: function(response) {
            
            document.getElementById('sesion').textContent = response["quantity"];
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          console.log(jqXHR.responseText);
        },
        dataType : "json"
  
      });
      
      
}


//Se han seleccionado todos los productos
function selectPurchase(){
    $.ajax({
        url: "updateArrayCheckBox.php",
        data: {"option":2, "check": 0},
        type: 'GET',
        success: function(response) {
            document.getElementById('sesion').textContent = response["quantity"];
          
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          console.log(jqXHR.responseText);
        },
        dataType : "json"
  
      });
      
}

//Se desseleccionan todos los productos
function deselectPurchase(){
    $.ajax({
        url: "updateArrayCheckBox.php",
        data: { "option":3, "check": 0},
        type: 'GET',
        success: function(response) {
            document.getElementById('sesion').textContent = 0;
          
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          console.log(jqXHR.responseText);
        },
        dataType : "json"
  
      });
      

}

//Verificamos si se ha seleccionado algun producto o si el usuario esta dado de alta
function verifyPurchase(uID, subtotal,event) {
    event.preventDefault();
    // Obtener la cantidad de productos seleccionados
    const cantidad = document.getElementById('sesion').textContent;
    console.log(cantidad);
    if (uID==-1 ){
        window.location.href = `purchase.php?subtotal=${subtotal}`;
        return;
    }

    // Verificar si la cantidad es menor o igual a 0
    if (isNaN(cantidad) || cantidad <= 0) {
        const button = document.getElementById('buy-now');
        const popover = new bootstrap.Popover(button, {
            content: "No hay elementos seleccionados",
            placement: "bottom",
        });
        popover.show();
        setTimeout(() => {
            popover.dispose();
        }, 2000);
        return ;
    }
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
      });
    window.location.href = `purchase.php?subtotal=${subtotal}`;
}