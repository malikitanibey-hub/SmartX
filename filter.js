//----------------- Filter -----------------
const filterSelect = document.getElementById("filterSelect");
const productContainer = document.querySelector(".gallary");

// Collect all products
let products = Array.from(document.querySelectorAll(".cont"));

// Listen for filter changes
filterSelect.addEventListener("change", () => {
    const value = filterSelect.value;

    let sortedProducts = [...products]; // copy

    if (value === "LowToHigh") {
        sortedProducts.sort((a, b) => {
            const priceA = parseFloat(a.querySelector("h6").innerText);
            const priceB = parseFloat(b.querySelector("h6").innerText);
            return priceA - priceB;
        });
    } else if (value === "HighToLow") {
        sortedProducts.sort((a, b) => {
            const priceA = parseFloat(a.querySelector("h6").innerText);
            const priceB = parseFloat(b.querySelector("h6").innerText);
            return priceB - priceA;
        });
    } else if (value === "AtoZ") {
        sortedProducts.sort((a, b) => {
            const nameA = a.querySelector("h3").innerText.toLowerCase();
            const nameB = b.querySelector("h3").innerText.toLowerCase();
            return nameA.localeCompare(nameB);
        });
    } else if (value === "ZtoA") {
        sortedProducts.sort((a, b) => {
            const nameA = a.querySelector("h3").innerText.toLowerCase();
            const nameB = b.querySelector("h3").innerText.toLowerCase();
            return nameB.localeCompare(nameA);
        });
    }

    // Remove existing products
    productContainer.innerHTML = "";

    // Add sorted products
    sortedProducts.forEach(p => productContainer.appendChild(p));
});