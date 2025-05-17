document.addEventListener('DOMContentLoaded', function() {
    const addToCartButton = document.querySelector('.product-info form button');
    addToCartButton.addEventListener('click', function(event) {
        event.preventDefault();
        alert('Item added to cart!');
    });
});