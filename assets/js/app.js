const lista_carrito = document.querySelector("#lista-carrito tbody"),
    items = document.getElementById("items"),
    emptyCartBtn = document.querySelector('#vaciar-carrito'),
    cart = document.querySelector("#lista-carrito");
let articulosCarrito = [];

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems);
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems);
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, { closeOnClick: false, hover: true });
    var elems = document.querySelectorAll('.carousel');
    var instances = M.Carousel.init(elems);
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, { onOpenStart: openImage });

    items.addEventListener("click", addItemToCart);
    cart.addEventListener("click", deleteFromCart);
    emptyCartBtn.addEventListener("click", emptyCart);

    articulosCarrito = JSON.parse(localStorage.getItem('items')) || [];
    insertHTML();
});


function addItemToCart(e) {
    e.preventDefault();
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

        if (articulosCarrito.some(item => item.id === itemInfo.id)) {
            const items = articulosCarrito.map(item => {
                if (item.id === itemInfo.id) {
                    let quantity = parseInt(item.qty);
                    quantity++;
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

function sincStorage() {
    localStorage.setItem('items', JSON.stringify(articulosCarrito));
}

function openImage(e) {
    let target = e.target;

    console.log(target)
}


/*
let currentRow = document.querySelector(`#row${id} .qty`);
        console.log(currentRow);
        if (currentRow) {
            document.querySelector(`#row${id} .qty`).textContent = qty + Number(document.querySelector(`#row${id} .qty`).textContent);
        } else {
            let row = `
          <tr id="row${id}">
            <td ><img src="${image}">"</td>
            <td>${name}</td>
            <td>$ ${price} MXN</td>
            <td class="qty">${qty}</td>
            <td class="delete_item"><i class="large material-icons delete_item">shopping_cart</i></td>
          </tr>
      `;


            lista_carrito.innerHTML += row;
        }



*/