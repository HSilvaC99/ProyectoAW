function addProdCart(productID,productName ){
    const input = document.getElementById('amount-p');

    // Obtener la cantidad de productos del input
    const cantidad = parseInt(input.value);
    console.log(cantidad);
    console.log(productID);
    $.ajax({
        url: "addProductToCart.php",
        data: {"product_id": productID, "amount":cantidad},
        type: 'GET',
        success: function(response) {
          console.log(response);
          updateAmount(productID,response['amount'],response['amount-prod'],response['subtotal'],productName);
          
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
          console.log(jqXHR.responseText);
        },
        dataType : "json"
  
      });
}

function updateAmount(productID,amount,cantidad,subtotal,productName){
    const a = document.getElementById('amount-cart');
    const ul = document.getElementById('cart-dropdown');
    const li = document.createElement('li');
    li.innerHTML = `<span id="cantidad-${productID}">Cantidad: <span id="amountProduct-${productID}">${cantidad}</span></span><a id="name-${productID}" class="dropdown-item" href="product.php?productID=${productID}">${productName}</a>`;
    ul.appendChild(li);
    
    const span = document.createElement('span');
    span.id = "subtotal-up";
    span.innerHTML = `subtotal: <span id="valSubtotal">${Number.parseFloat(subtotal).toFixed(2)} €</span>`;
    ul.appendChild(span);
    
    const button = document.getElementById('carrito'); // seleccionar el botón existente
    const span2 = document.createElement('span'); // crear el nuevo elemento span
    span2.classList.add('position-absolute', 'top-0', 'start-100', 'translate-middle', 'badge', 'rounded-pill', 'bg-danger'); // añadir clases al elemento span
    span2.id = 'amount-cart'; // establecer el id del elemento span
    span2.textContent = `${amount}`; // establecer el contenido del elemento span con el valor de $cartCount

    button.appendChild(span2); // añadir el elemento span como hijo del botón


    document.getElementById('amount-cart').textContent = amount;
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

  