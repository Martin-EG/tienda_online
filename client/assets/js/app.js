const lista_carrito = document.querySelector("#lista-carrito tbody"),
    items = document.getElementById("items"),
    emptyCartBtn = document.querySelector('#vaciar-carrito'),
    cart = document.querySelector("#lista-carrito"),
    addToCartBtn = document.querySelector(".add_item"),
    buyNowBtn = document.querySelector(".buy_now"),
    cartListTbody = document.getElementById("cart-list");
let articulosCarrito = [];

document.addEventListener('DOMContentLoaded', function() {
    $('.carousel').carousel();
    $('.sidenav').sidenav();
    $('.tooltipped').tooltip();
    $('.collapsible').collapsible();


    if (items)
        items.addEventListener("click", addItemToCart);
    if (cart)
        cart.addEventListener("click", deleteFromCart);
    if (emptyCartBtn)
        emptyCartBtn.addEventListener("click", emptyCartLS);
    if (addToCartBtn)
        addToCartBtn.addEventListener("click", addItemsToCart);
    if (buyNowBtn)
    buyNowBtn.addEventListener("click", goToShoppingCart);

    articulosCarrito = JSON.parse(localStorage.getItem('items')) || [];
    insertHTML();

    if(cartListTbody)
        createCartList();
});

function goToShoppingCart(){
    addItemsToCart();
    window.location.href = "shopping_cart.php";
}

function addItemToCart(e) {
    let target = e.target;

    if (target.classList.contains("add_cart")) {
        let parent = target.parentElement.parentElement.parentElement;
        const itemInfo = {
            name: parent.querySelector(".card-title").textContent,
            image: parent.querySelector(".card-image img").src,
            price: parent.querySelector(".card-price strong").textContent,
            id: parent.getAttribute("data-id"),
            qty: 1,
        }

        verifyItem(itemInfo);
    }
}

function addItemsToCart() { //Same function that above but this is for the page of product
    const itemInfo = {
        name: document.querySelector(".product-title").textContent,
        image: document.querySelector("#first-image img").src,
        price: document.querySelector(".price").getAttribute("data-price"),
        id: addToCartBtn.getAttribute("data-id"),
        qty: document.getElementById("quantity").value === "" ? 1 : parseInt(document.getElementById("quantity").value),
    }

    verifyItem(itemInfo);
}

function verifyItem(itemInfo) {
    if (articulosCarrito.some(item => item.id === itemInfo.id)) {
        const items = articulosCarrito.map(item => {
            if (item.id === itemInfo.id) {
                let quantity = parseInt(item.qty);
                quantity += itemInfo.qty;
                item.qty = quantity;
                return item;
            } else {
                return item;
            }
        });
        articulosCarrito = [...items];
    } else {
        articulosCarrito = [...articulosCarrito, itemInfo];
    }

    insertHTML();
}

function insertHTML() {
    emptyCart();

    articulosCarrito.forEach(item => {
        const row = document.createElement("tr");

        row.innerHTML = `
          <td>  
                <img src="${item.image}" width=100>
          </td>
          <td>${item.name}</td>
          <td>${item.price}</td>
          <td class="qty">${item.qty} </td>
          <td>
                <a href="#" class="delete-item" data-id="${item.id}"><i class="large material-icons delete-item">delete</i></a>
          </td>
        `;
        lista_carrito.appendChild(row);
    });

    sincStorage();
}

function createCartList(){
    let total = 0;

    articulosCarrito.forEach(item => {
        const row = document.createElement("tr");
        row.setAttribute("id", "row_product"+item.id);

        let url = `_config/ajax-functions.php?f=searchQty&i=${item.id}`,
            xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {
                let product = JSON.parse(this.responseText);
                let disponible = product.product_qty;

                let totalCost = item.price * item.qty;
                row.innerHTML = `
                    <td>  
                        <img src="${item.image}" width=100>
                    </td>
                    <td>
                        <a href="product.php?i=${item.id}" class="title">${item.name}</a>
                        <p class="price" id="current_price">$<span>${item.price}</span> USD<p>
                        <input type="number" min="1" max="${disponible}" value="${item.qty}" onchange="updatePrice(this)"  data-id="${item.id}">
                    </td>
                    <td>
                        <p class="price" id="total_price">$<span>${totalCost}</span> USD<p>
                    </td>
                `;
                cartListTbody.appendChild(row);
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    });
}

function deleteFromCart(e) {
    e.preventDefault();
    let target = e.target;

    if (target.classList.contains("delete-item")) {
        const current_item = target.parentElement.parentElement,
            item_id = current_item.querySelector("a").getAttribute("data-id");
        current_item.remove();
        articulosCarrito = articulosCarrito.filter(item => item.id !== item_id);
        insertHTML();
    }
}

function emptyCart() {
    while (lista_carrito.firstChild) {
        lista_carrito.removeChild(lista_carrito.firstChild);
    }
}

function emptyCartLS() {
    emptyCart();
    localStorage.removeItem("items");
}

function sincStorage() {
    localStorage.setItem('items', JSON.stringify(articulosCarrito));
}

function verificarCantidad(target){
    let cantidad = Number(target.value);
    let cantidadMax = Number(target.getAttribute("max"));

    if(cantidad < 0) {
        swal({
            title: "Error!",
            text: "Cantidad no puede ser menor a 0",
            icon: "error",
        });
        target.value = 1;
        return false;
    }
    else if(cantidad > cantidadMax) {
        swal({
            title: "Error!",
            text: "Cantidad no puede ser mayor a lo disponible",
            icon: "error",
        });
        target.value = cantidadMax;
        return false;
    }
    return true;
}

function updatePrice(target){
    let flag_qty = verificarCantidad(target);
    let id = target.getAttribute("data-id");
    let cantidad = Number(target.value);
    let price = Number(document.querySelector("#row_product"+ id +" #current_price span").textContent);


    if(flag_qty)
    {
        document.querySelector("#row_product"+ id +" #total_price span").textContent = cantidad * price;
    }
}