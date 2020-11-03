const lista_carrito = document.querySelector("#lista-carrito tbody"),
    items = document.getElementById("items"),
    emptyCartBtn = document.querySelector('#vaciar-carrito'),
    cart = document.querySelector("#lista-carrito"),
    addToCartBtn = document.querySelector(".add_item"),
    buyNowBtn = document.querySelector(".buy_now");
let articulosCarrito = [];

document.addEventListener('DOMContentLoaded', function() {
    $('.carousel').carousel();
    $('.sidenav').sidenav();
    $('.tooltipped').tooltip();
    

    items.addEventListener("click", addItemToCart);
    cart.addEventListener("click", deleteFromCart);
    emptyCartBtn.addEventListener("click", emptyCartLS);
    addToCartBtn.addEventListener("click", addItemsToCart)

    articulosCarrito = JSON.parse(localStorage.getItem('items')) || [];
    insertHTML();
});


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

function emptyCartLS(){
  emptyCart();
  localStorage.removeItem("items");
}

function sincStorage() {
    localStorage.setItem('items', JSON.stringify(articulosCarrito));
}
