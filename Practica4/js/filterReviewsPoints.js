
// Obtener el elemento del dropdown
const filterDropdown = document.getElementById("filter-dropdown");

// Obtener todas las reseñas
const reviews = document.querySelectorAll(".card[data-review]");

// Agregar un event listener al dropdown
filterDropdown.addEventListener("change", function() {
    const selectedValue = this.value; // Obtener el valor seleccionado

    // Mostrar u ocultar las reseñas según la puntuación seleccionada
    reviews.forEach(function(review) {
        const reviewRating = review.getAttribute("data-review");
        if (selectedValue === "all" || reviewRating === selectedValue) {
            review.style.display = "block";
        } else {
            review.style.display = "none";
        }
    });
});
