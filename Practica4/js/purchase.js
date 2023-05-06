function selectOneForPurchase(productID){
    $.ajax({
        url: "updateArrayCheckBox.php",
        data: {"product_id": productID, "option":1},
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



function selectPurchase(){
    $.ajax({
        url: "updateArrayCheckBox.php",
        data: {"option":2},
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

function deselectPurchase(){
    $.ajax({
        url: "updateArrayCheckBox.php",
        data: { "option":3},
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

function verifyPurchase(uID, subtotal,event) {
    event.preventDefault();
    // Obtener la cantidad de productos seleccionados
    const cantidad = document.getElementById('sesion').textContent;
    console.log(cantidad);
  
    if (uID == -1){
        window.location.href = `login.php?urlRedirection=%2FProyectoAW%2FPractica4%2Flogin.php`;
    }
    else{
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
        }else{
            window.location.href = `purchase.php?subtotal=${subtotal}`;
        }
    }
    // Continuar con la compra
    
}