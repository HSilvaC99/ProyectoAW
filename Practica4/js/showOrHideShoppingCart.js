function showCart() {
    document.getElementById("cart-dropdown").classList.add("show");
}

function hideCart() {
    document.getElementById("cart-dropdown").classList.remove("show");
}

document.getElementById('btn-carrito').onmouseover = showCart;
document.getElementById('btn-carrito').onmouseleave = hideCart;
