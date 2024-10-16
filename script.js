let cart = [];

document.getElementById('add-to-cart').addEventListener('click', () => {
    let product = {
        name: 'Product Name',
        price: 19.99,
        quantity: 1
    };
    cart.push(product);
    updateCart();
});

function updateCart() {
    let cartList = document.getElementById('cart-list');
    cartList.innerHTML = '';
    cart.forEach((product) => {
        let listItem = document.createElement('li');
        listItem.textContent = `${product.name} x ${product.quantity} - $${product.price * product.quantity}`;
        cartList.appendChild(listItem);
    });
    document.getElementById('cart-modal').modal('show');
}

document.getElementById('checkout-btn').addEventListener('click', () => {
    // Implement checkout functionality here
    alert('Checkout functionality not implemented yet!');
});