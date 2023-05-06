function actualizarTabla(productID) {
  const input = document.getElementById(`amount-${productID}`);

  // Obtener la cantidad de productos del input
  const cantidad = parseInt(input.value);

     // Verificar si la cantidad es menor a 0
    
    if (isNaN(cantidad) || cantidad < 0) {
      const popover = new bootstrap.Popover(input, {
        content: "Valor no es valido. Debe ser mayor o igual que 0",
        placement: "bottom",
      });
      popover.show();
      restoreAmount(productID);
      setTimeout(() => {
        popover.dispose();
      }, 2000);
      
      return;
    }
  
   
    if (cantidad === 0) {
      showConfirmDialog(() => {}, productID);
      restoreAmount(productID);
      return;
    }
    
    
    // Calcular el nuevo precio para el producto
    const PxU = parseFloat(document.getElementById(`price-unity-${productID}`).textContent);
    const nuevoPrecio = cantidad * PxU;

    // Actualizar el texto dentro del <td> que contiene el precio
    document.getElementById(`price-${productID}`).textContent = nuevoPrecio.toFixed(2) + " €";

    // Calcular el subtotal de la tabla sumando los precios de todos los productos
    let subtotal = 0;
    
    $.ajax({
      url: "updateCart.php",
      data: {"product_id": productID, "amount":cantidad},
      type: 'GET',
      success: function(response) {
        document.getElementById('subtotal').textContent = response['subtotal'].toFixed(2) + " €";
        showSubtotalProduct(response['amount']);
        updateAmount(productID,response['amount'],cantidad,response['subtotal']);
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        console.log(jqXHR.responseText);
      },
      dataType : "json"

    });
    
    
  }

  function showSubtotalProduct(amount) {
    const amountOneVal = document.getElementById('amountOneVal');
    const amountVal = document.getElementById('amountVal');
  
    if (amountOneVal && amountVal) {
      if (amount == 1) {
        amountOneVal.style.display = 'inline';
        amountVal.style.display = 'none';
        const cantidadProductoSpan = document.getElementById('amountProduct');
        cantidadProductoSpan.textContent = parseInt(amount); 
      } else {
        amountOneVal.style.display = 'none';
        amountVal.style.display = 'inline';
        const cantidadProductosSpan = document.getElementById('amountProducts');
        cantidadProductosSpan.textContent = parseInt(amount); 
      }
    }
  }
  


  function showConfirmDialog(callback, productID) {
    
    const boton = document.getElementById(`button-${productID}`);
    
    boton.click();
    
  }
  
  function restoreAmount(productID){
    const precioTotal = parseFloat(document.getElementById(`price-${productID}`).textContent);
        const precioUnitario = parseFloat(document.getElementById(`price-unity-${productID}`).textContent);
        const c = parseInt(precioTotal / precioUnitario);
        
        document.getElementById(`amount-${productID}`).value = parseInt(c);
  }


  function closeModal(productID){
    const confirmDialog = document.getElementById(`confirm-dialog-${productID}`);
    restoreAmount(productID);
  }


  function deleteProduct(productID){
    $.ajax({
      url: "deleteProductFromCart.php",
      data: {"product_id": productID},
      type: 'GET',
      success: function(response) {
        //Elimina el div de la cesta
        const prod =document.getElementById(`prod-${productID}`); 
        const parent = prod.parentNode;
        parent.removeChild(prod);
        //Actualiza la bd y los elementos pertinentes
        document.getElementById('subtotal').textContent = response['subtotal'].toFixed(2);

        if (response['amount'] === 0) {
          // Elimina todos los elementos de la cesta excepto el elemento con id "cesta-empty"
          const cestaItems = document.querySelectorAll('.cesta-item');
          
          cestaItems.forEach(function(item) {
            if (item.id !== 'cesta-empty') {
              item.remove();
            }
          });
          document.getElementById('amountOneVal').style.display = 'none';
          document.getElementById('buy-now').style.display = 'none';
          document.getElementById('cesta').style.display = 'none';
          document.getElementById('px').style.display = 'none';
          document.getElementById('subtotal').style.display = 'none';
          document.getElementById('filas').style.display = 'none';
          document.getElementById('main').style.display = 'none';
          document.querySelector('hr').style.display = 'none';
          document.getElementById('containter').style.display = 'block';
          document.getElementById('cesta-empty').style.display = 'block';
          updateAmount(productID,response['amount'],0,0);
        } else {
          showSubtotalProduct(response['amount']);
          updateAmount(productID,response['amount'],0,response['subtotal']);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        console.log(jqXHR.responseText);
      },
      dataType : "json"

    });
  }


  function updateAmount(productID,amount,cantidad,subtotal){
    const a = document.getElementById('amount-cart');
    console.log(a.textContent);
    document.getElementById('amount-cart').textContent = parseInt(amount);
    document.getElementById(`amountProduct-${productID}`).textContent = cantidad;
    document.getElementById('valSubtotal').textContent = subtotal.toFixed(2) + " €";
    if (cantidad == 0){
      document.getElementById(`cantidad-${productID}`).style.display = 'none';
      document.getElementById(`name-${productID}`).style.display = 'none';
      document.getElementById(`divider-${productID}`).style.display = 'none';
    }
    if (amount==0){
      document.getElementById('subtotal-up').style.display = 'none';
      document.getElementById('amount-cart').style.display = 'none';
      document.getElementById('carrito-empty').style.display = 'block';

    }
  }