const reviewContainer = document.querySelector(".reviews-container");
const sortDropdown = document.getElementById('sort-dropdown');

sortDropdown.addEventListener('change', function() {
    const selectedValue = this.value;

    if (selectedValue === 'recent') {
        const sortedReviews = Array.from(reviewContainer.children)
            .sort((a, b) => new Date(b.querySelector('.row:last-child').textContent) - new Date(a.querySelector('.row:last-child').textContent));

        sortedReviews.forEach(review => reviewContainer.appendChild(review));
    } else if (selectedValue === 'oldest') {
        const sortedReviews = Array.from(reviewContainer.children)
            .sort((a, b) => new Date(a.querySelector('.row:last-child').textContent) - new Date(b.querySelector('.row:last-child').textContent));

        sortedReviews.forEach(review => reviewContainer.appendChild(review));
    }
});