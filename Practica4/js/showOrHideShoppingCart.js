function showCart() {
    document.getElementById("cart-dropdown").classList.add("show");
}

function hideCart() {
    document.getElementById("cart-dropdown").classList.remove("show");
}

document.querySelector('.btn-outline-secondary').onmouseover = showCart;
document.querySelector('.btn-outline-secondary').onmouseleave = hideCart;
