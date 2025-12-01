let openShopping = document.querySelector(".shopping");
let closeShopping = document.querySelector(".closeShopping");
let body = document.querySelector("body");
let cart = [];
let cartQuantity = document.querySelector(".quantity");
let cartList = document.querySelector(".listCard");
let totalElement = document.querySelector(".total");

if (
  localStorage.getItem("cart") &&
  !Array.isArray(JSON.parse(localStorage.getItem("cart")))
) {
  localStorage.removeItem("cart");
}

document.addEventListener("DOMContentLoaded", () => {
  loadCart();
  updateCart();
});

openShopping.addEventListener("click", () => {
  body.classList.add("active");
});
closeShopping.addEventListener("click", () => {
  body.classList.remove("active");
});

document.querySelectorAll(".product-cont-btn").forEach((button, index) => {
  button.addEventListener("click", () => {
    addToCart(index);
  });
});

function addToCart(index) {
  const productContainer = document.querySelectorAll(".cont")[index];
  const productId = productContainer.getAttribute("data-product-id");
  const productName = productContainer.querySelector("h3").innerText;
  const productPrice = parseFloat(
    productContainer.querySelector("h6").innerText.replace("$", "")
  );

  let existingProduct = cart.find((item) => item.id === productId);

  if (existingProduct) {
    existingProduct.quantity++;
  } else {
    cart.push({
      id: productId,
      name: productName,
      price: productPrice,
      quantity: 1,
    });
  }

  console.log(cart);
  saveCart();
  updateCart();
}
function removeFromCart(productId) {
  cart = cart.filter((item) => item.id !== productId);
  saveCart();
  updateCart();
}

function updateCart() {
  cartList.innerHTML = "";
  let total = 0;

  cart.forEach((product) => {
    total += product.price * product.quantity;

    let li = document.createElement("li");
    li.innerHTML = `${product.name} - $${product.price} x ${product.quantity} 
            <button class="removeButton" data-product-id="${product.id}">Remove</button>`;
    cartList.appendChild(li);
  });

  totalElement.innerText = `Total: $${total.toFixed(2)}`;
  cartQuantity.innerText = cart.reduce(
    (acc, product) => acc + product.quantity,
    0
  );

  document.querySelectorAll(".removeButton").forEach((button) => {
    button.addEventListener("click", (event) => {
      const productId = event.target.getAttribute("data-product-id");
      removeFromCart(productId);
    });
  });

  console.log("Updated cart:", cart);
}

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

function loadCart() {
  const savedCart = localStorage.getItem("cart");
  if (savedCart) {
    cart = JSON.parse(savedCart);
  }
}

// BUY button click
let buyButton = document.querySelector(".buyButton");
buyButton.addEventListener("click", handleBuy);

function handleBuy() {
  if (cart.length === 0) {
    alert("Your cart is empty! Add items before buying.");
    return;
  }

  let total = cart.reduce(
    (acc, product) => acc + product.price * product.quantity,
    0
  );

  if (confirm(`Your total is $${total.toFixed(2)}. Proceed to checkout?`)) {
    cart = [];
    saveCart();
    updateCart();
    alert("Thank you for your purchase");
  }
}



