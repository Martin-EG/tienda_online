const lista_carrito = document.querySelector("#lista-carrito tbody"),
      items         = document.getElementById("items");

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
  var elems = document.querySelectorAll('.tooltipped');
  var instances = M.Tooltip.init(elems);
  var elems = document.querySelectorAll('.dropdown-trigger');
  var instances = M.Dropdown.init(elems, {closeOnClick: false, hover: true});
  var elems = document.querySelectorAll('.carousel');
  var instances = M.Carousel.init(elems);
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems, {onOpenStart: openImage});

  items.addEventListener("click", addItemToCart);

  });


  function addItemToCart(e){
    e.preventDefault();
    let target = e.target;

    if(target.classList.contains("add_cart"))
    {
      let parent = target.parentElement.parentElement.parentElement,
          name   = parent.querySelector(".card-title").textContent,
          image  = parent.querySelector(".card-image img").src,
          price  = parent.querySelector(".card-price strong").textContent,
          id     = parent.getAttribute("data-id"),
          qty    = 1;

      let currentRow = document.querySelector(`#row${id} .qty`);
      console.log(currentRow);
      if(currentRow)
      {
        document.querySelector(`#row${id} .qty`).textContent = qty + Number(document.querySelector(`#row${id} .qty`).textContent);
      } 
      else
      {
        let row = `
            <tr id="row${id}">
              <td ><img src="${image}">"</td>
              <td>${name}</td>
              <td>$ ${price} MXN</td>
              <td class="qty">${qty}</td>
            </tr>
        `;
  
        lista_carrito.innerHTML += row;
      }
      
    }
  }

  function openImage(e){
    let target = e.target;

    console.log(target)
  }