<?php
    include_once "includes/header.php";
    include_once "includes/navbar.php";
?>

<div class="container">
    <h3>Shopping Cart</h3>
    <div class="row">
        <div class="col sm12" id="message">
            
        </div>
        <div class="col s12 m12 l12" id="cart-list-table">
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


<?php
    include_once "includes/footer.php";
?>