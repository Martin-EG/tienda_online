<?php
    include_once "includes/header.php";
    include_once "includes/navbar.php";
?>

<div class="sk-circle" id="spinner">
  <div class="sk-circle1 sk-child"></div>
  <div class="sk-circle2 sk-child"></div>
  <div class="sk-circle3 sk-child"></div>
  <div class="sk-circle4 sk-child"></div>
  <div class="sk-circle5 sk-child"></div>
  <div class="sk-circle6 sk-child"></div>
  <div class="sk-circle7 sk-child"></div>
  <div class="sk-circle8 sk-child"></div>
  <div class="sk-circle9 sk-child"></div>
  <div class="sk-circle10 sk-child"></div>
  <div class="sk-circle11 sk-child"></div>
  <div class="sk-circle12 sk-child"></div>
</div>

<div id="container_shopping_cart">
    <div class="container no-display" id="shopping-cart">
        <h3>Shopping Cart</h3>
        <div class="row">
            <div class="col sm12" id="message">
                
            </div>
            <div class="col s12 m12 l12 no-display" id="cart-list-table">
                <table>
                    <tbody id="cart-list">
                    </tbody>
                    <tfoot>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="total" class="center-align">
                            Total: <p class="price">$<span>0</span> USD</p>
                        </td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="container right-align" id="buy">
    </div>
</div>
<div id="container_information_form" class="no-display" style="opacity: 0;">
    <div class="container">
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Apellido</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="address" type="text" class="validate">
                        <label for="address">Dirección</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="phone" type="text" class="validate">
                        <label for="phone">Numero telefónico</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate">
                        <label for="email">Correo Electronico</label>
                    </div>
                </div>
            </form>
            <div class="right-align" id="form_button">
                <a class="waves-effect waves-light btn-large blue accent-3" onclick="validate_form()"><i class="material-icons right">payment</i> Guardar datos</a>
            </div>
        </div>
    </div>
    <div id="paypal-button-container" class="center no-display"></div>
</div>
<script
    src="https://www.paypal.com/sdk/js?client-id=AZwBLvHBUymJCeAx0fLZzZvQGnJtCRp_8_BGeJ_lY7VKik18iCzvn20i-H_Hg-aa9c_m-Zc3N0PG4L1M&currency=USD"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<?php
    include_once "includes/footer.php";
?>