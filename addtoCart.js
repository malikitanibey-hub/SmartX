// addtoCart.js

let openShopping = document.querySelector(".shopping");
let closeShopping = document.querySelector(".closeShopping");
let body = document.querySelector("body");
let cart = [];
let cartQuantity = document.querySelector(".quantity");
let cartList = document.querySelector(".listCard");
let totalElement = document.querySelector(".total");

// Load cart from localStorage
document.addEventListener("DOMContentLoaded", () => {
    loadCart();
    updateCart();
});

// Open/Close cart
if (openShopping) openShopping.addEventListener("click", () => body.classList.add("active"));
if (closeShopping) closeShopping.addEventListener("click", () => body.classList.remove("active"));

// Add to cart buttons (only for actual products with data-product-id)
document.querySelectorAll(".product-cont").forEach((productBox, index) => {
    const button = productBox.querySelector(".product-cont-btn");
    const id = productBox.getAttribute("data-product-id");

    if (button && id) {
        button.addEventListener("click", () => addToCart(index));
    }
});

// Add product to cart
function addToCart(index) {
    const productContainer = document.querySelectorAll(".product-cont")[index];
    if (!productContainer) return;

    const productId = productContainer.getAttribute("data-product-id");
    const productName = productContainer.querySelector("h3")?.innerText || "Unnamed";
    const priceText = productContainer.querySelector("h6")?.innerText || "";
    const productPrice = parseFloat(priceText.replace(/[^0-9.]/g, ""));

    if (!productId || isNaN(productPrice) || productPrice <= 0) return;

    const existing = cart.find(item => item.id === productId);
    if (existing) {
        existing.quantity++;
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, quantity: 1 });
    }

    saveCart();
    updateCart();
    toast(`${productName} added to cart`, "success");
}

// Remove product from cart
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCart();
    toast("Item removed from cart", "warn");
}

// Update cart display
function updateCart() {
    if (!cartList) return;
    cartList.innerHTML = "";
    let total = 0;

    cart.forEach(product => {
        total += product.price * product.quantity;
        const li = document.createElement("li");
        li.innerHTML = `${product.name} - $${product.price.toFixed(2)} x ${product.quantity} 
            <button class="removeButton" data-product-id="${product.id}">Remove</button>`;
        cartList.appendChild(li);
    });

    totalElement.innerText = `Total: $${total.toFixed(2)}`;
    cartQuantity.innerText = cart.reduce((acc, p) => acc + p.quantity, 0);

    document.querySelectorAll(".removeButton").forEach(button => {
        button.addEventListener("click", (event) => {
            const productId = event.target.getAttribute("data-product-id");
            removeFromCart(productId);
        });
    });
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Load cart from localStorage
function loadCart() {
    const saved = localStorage.getItem("cart");
    if (saved) {
        try {
            const parsed = JSON.parse(saved);
            cart = parsed.filter(item => item.id && !isNaN(item.price) && item.price > 0 && item.quantity > 0);
        } catch {
            cart = [];
            localStorage.removeItem("cart");
        }
    }
}

// BUY button
const buyButton = document.querySelector(".buyButton");
if (buyButton) buyButton.addEventListener("click", handleBuy);

function handleBuy() {
    if (!cart || cart.length === 0) {
        toast("Your cart is empty!", "error");
        return;
    }

    const total = cart.reduce((acc, p) => acc + p.price * p.quantity, 0);
    toast(`Processing purchase... Total: $${total.toFixed(2)}`, "info", 2000);

    fetch("saveCart.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        credentials: "same-origin",
        body: JSON.stringify({ cart, total }),
    })
    .then(async res => {
        const text = await res.text();
        try { return JSON.parse(text); } 
        catch { throw new Error("Invalid server response: " + text); }
    })
    .then(data => {
        if (data.success) {
            toast("Purchase saved successfully!", "success");
            cart = [];
            saveCart();
            updateCart();
        } else {
            toast("Failed to save purchase: " + (data.message || ""), "error");
            console.error("Server response:", data);
        }
    })
    .catch(err => {
        console.error("Fetch error:", err);
        toast("Network/server error!", "error");
    });
}

// Toast function
function toast(message, type = "info", duration = 2500) {
    const t = document.getElementById("toast");
    if (!t) return;

    t.textContent = message;
    t.className = "show " + type;

    if (t._timer) clearTimeout(t._timer);

    t._timer = setTimeout(() => {
        t.classList.remove("show");
        setTimeout(() => t.className = "", 300);
    }, duration);
}
