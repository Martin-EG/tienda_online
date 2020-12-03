const lista_carrito = document.querySelector("#lista-carrito tbody"),
    items = document.getElementById("items"),
    emptyCartBtn = document.querySelector('#vaciar-carrito'),
    cart = document.querySelector("#lista-carrito"),
    addToCartBtn = document.querySelector(".add_item"),
    buyNowBtn = document.querySelector(".buy_now"),
    cartListTbody = document.getElementById("cart-list"),
    cartListTotal = document.querySelector("#total span"),
    categoriesDiv = document.getElementById("row-categories"),
    productsDiv = document.getElementById("row-products"),
    searchBar = document.getElementById("search"),
    searchMob = document.getElementById("searchMobile"),
    searchBtn = document.getElementById("search_button"),
    sidebar_cat = document.getElementById("sidebar-categories"),
    shopping_cart = document.getElementById("shopping-cart"),
    container_shopping = document.getElementById("container_shopping_cart"),
    container_form = document.getElementById("container_information_form");

let articulosCarrito = [],
    data = new FormData();

// $('.carousel').carousel();
$(function(){$('.carousel').carousel();});
$('.sidenav').sidenav();
$('.tooltipped').tooltip();
$('.collapsible').collapsible();

document.addEventListener('DOMContentLoaded', function() {
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
    if (categoriesDiv)
        categoriesDiv.addEventListener("click", showCategory);

    sidebar_cat.addEventListener("click", showCategory);

    searchBtn.addEventListener("search", () => { searchProducts(searchBar); });
    searchBar.addEventListener("search", () => { searchProducts(searchBar); });
    searchMob.addEventListener("search", () => { searchProducts(searchMob); });

    articulosCarrito = JSON.parse(localStorage.getItem('items')) || [];
    insertHTML();

    if (cartListTbody) {
        cartListTbody.addEventListener("click", deleteFromCart);
        createCartList();
    }
});

function showCategory(e) {
    e.preventDefault();
    let target = e.target,
        id_cat = target.getAttribute("data-id");
    if (target.classList.contains("category")) {
        let url = `_config/ajax-functions.php?f=searchCategory&i=${id_cat}`,
            xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                productsDiv.innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
}

function searchProducts(target) {
    let product = target.value,
        url = `_config/ajax-functions.php?f=searchProduct`,
        xmlhttp = new XMLHttpRequest(),
        data = new FormData();

    data.append("product", product)

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            productsDiv.innerHTML = this.responseText;
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.send(data);
}

function goToShoppingCart() {
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
          <td id="qty${item.id}">${item.qty} </td>
          <td>
                <a href="#" class="delete-item" data-id="${item.id}"><i class="large material-icons delete-item">delete</i></a>
          </td>
        `;
        lista_carrito.appendChild(row);
    });

    sincStorage();
}

function createCartList() {
    const spinner = document.getElementById("spinner")
    let messageDiv = document.getElementById("message"),
        cartListTable = document.getElementById("cart-list-table");


    if (articulosCarrito.length == 0) {

        spinner.classList.add("no-display");
        messageDiv.innerHTML = `
            <h4>No tienes articulos en el carrito de compras</h4>
        `;

        shopping_cart.classList.remove("no-display");
        cartListTable.classList.add("no-display");
        return;
    }

    articulosCarrito.forEach(item => {
        const row = document.createElement("tr");
        row.setAttribute("id", "row_product" + item.id);

        let url = `_config/ajax-functions.php?f=searchQty&i=${item.id}`,
            xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let product = JSON.parse(this.responseText);
                let { product_qty, product_name, product_price } = product;

                let totalCost = product_price * item.qty;
                row.innerHTML = `
                    <td class="image-cell">  
                        <img src="${item.image}" width=100>
                    </td>
                    <td class="desc-cell">
                        <a href="product.php?i=${item.id}" class="title" data-id="${item.id}">${product_name}</a>
                        <small class="price" id="current_price">$<span>${product_price}</span> USD</small> &nbsp;&nbsp;
                        <small class="sm-link delete-item">Eliminar producto</small>
                    </td>
                    <td class="quantity-cell">
                        <input type="number" min="1" max="${product_qty}" value="${item.qty}" onchange="updatePrice(this)"  data-id="${item.id}">
                        <small>(${product_qty} disponibles)</small>
                    </td>
                    <td class="price-cell">
                        <p class="price" id="total_price">Total:$<span>${totalCost}</span> USD<p>
                    </td>
                `;
                cartListTbody.appendChild(row);

                cartListTotal.textContent = totalCost + Number(cartListTotal.textContent);
            }
        };
        xmlhttp.open("GET", url, false);
        xmlhttp.send();
    });

    spinner.classList.add("no-display");
    shopping_cart.classList.remove("no-display");
    cartListTable.classList.remove("no-display");

    document.querySelector("#buy").innerHTML = `
        <a class="waves-effect waves-light btn-large blue accent-3" onclick="proceed_buy()"><i class="material-icons right">payment</i>Proceder a pagar</a>
    `;
}

function deleteFromCart(e) {
    let target = e.target;

    if (target.classList.contains("delete-item")) {
        const current_item = target.parentElement.parentElement,
            item_id = current_item.querySelector("a").getAttribute("data-id");

        current_item.remove();
        articulosCarrito = articulosCarrito.filter(item => item.id !== item_id);
        insertHTML();

        if (cartListTotal) {
            updateTotalPrice();
        }
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

function verificarCantidad(target) {
    let cantidad = Number(target.value);
    let cantidadMax = Number(target.getAttribute("max"));

    if (cantidad < 0) {
        swal({
            title: "Error!",
            text: "Cantidad no puede ser menor a 0",
            icon: "error",
        });
        target.value = 1;
        return 1;
    } else if (cantidad > cantidadMax) {
        swal({
            title: "Error!",
            text: "Cantidad no puede ser mayor a lo disponible",
            icon: "error",
        });
        target.value = cantidadMax;
        return cantidadMax;
    }
    return cantidad;
}

function updatePrice(target) {
    let id = target.getAttribute("data-id");
    let qty = Number(verificarCantidad(target));
    let current_price = document.querySelector("#row_product" + id + " #total_price span");
    let url = `_config/ajax-functions.php?f=searchQty&i=${id}`,
        xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let product = JSON.parse(this.responseText);
            let { product_price } = product;

            current_price.textContent = (qty * product_price).toFixed(2);
            qty = qty - Number(document.querySelector(`#qty${id}`).textContent);
            verifyItem({ id, qty });
            updateTotalPrice();
        }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();

}

function updateTotalPrice() {
    let cart_list = document.querySelectorAll("#cart-list tr");
    let total = 0;
    if (cart_list) {
        cart_list.forEach(row => {
            total += Number(row.querySelector("#total_price span").textContent);
        });
    }

    cartListTotal.textContent = total.toFixed(2);
}

function proceed_buy() {
    fade(container_shopping);
    setTimeout(() => {
        unfade(container_form);
    }, 500);
}

function validate_form() {
    let name = document.getElementById("first_name").value,
        last_name = document.getElementById("last_name").value,
        address = document.getElementById("address").value,
        phone = document.getElementById("phone").value,
        email = document.getElementById("email").value;

    if (name === "" || last_name === "" || address === "" || phone === "" || email === "") {
        swal({
            title: "Error!",
            text: "Debes llenar todos los campos",
            icon: "error",
        });
        return;
    } else {
        document.getElementById("form_button").classList.add("no-display");
        createPaypalButton();
        document.getElementById("paypal-button-container").classList.remove("no-display");
    }
}

function createPaypalButton() {
    let count = 1,
        total = 0;
    articulosCarrito.forEach(item => {
        let url = `_config/ajax-functions.php?f=searchQty&i=${item.id}`,
            xmlhttp = new XMLHttpRequest();


        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let product = JSON.parse(this.responseText);
                let { product_price } = product;

                data.append(`id_product${count}`, item.id);
                data.append(`qty_product${count}`, item.qty);
                total += product_price * item.qty;
                count++;
            }
        };
        xmlhttp.open("GET", url, false);
        xmlhttp.send();

        data.append("count", count)
    });

    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total,
                        currency_code: 'USD'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                const { id, purchase_units } = details;
                const { value, currency_code } = purchase_units[0].amount;

                saveSellData(id, value, currency_code);
                //emptyCartLS();
            });
        }
    }).render('#paypal-button-container');
}

function saveSellData(id, value, currency_code) {
    let name = document.getElementById("first_name").value,
        last_name = document.getElementById("last_name").value,
        address = document.getElementById("address").value,
        phone = document.getElementById("phone").value,
        email = document.getElementById("email").value,
        url = "_config/ajax-functions.php?f=saveOrder",
        xmlhttp = new XMLHttpRequest();

    data.append("id_paypal", id);
    data.append("total", value);
    data.append("currency_code", currency_code);
    data.append("name", name);
    data.append("last_name", last_name);
    data.append("address", address);
    data.append("phone", phone);
    data.append("email", email);

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText)
            if (this.responseText == "Save") {
                swal({
                    title: "Compra realizada",
                    text: "La compra se ha realizado con exito! Nos comunicaremos con usted lo antes posible",
                    icon: "success",
                });
            }
        }
    }
    xmlhttp.open("POST", url, true);
    xmlhttp.send(data);
}


function fade(element) {
    var op = 1; // initial opacity
    var timer = setInterval(function() {
        if (op <= 0.1) {
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 25);
}

function unfade(element) {
    var op = 0.1; // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function() {
        if (op >= 1) {
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 25);
}