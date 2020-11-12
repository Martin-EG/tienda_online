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
<div class="container right-align" id="buy">
</div>
<div id="paypal-button-container" class="center"></div>
<script
    src="https://www.paypal.com/sdk/js?client-id=AQSg1F0pX0GYmNOGnpLqBsQJzAmYlg6zL1qs-Z0s3ydTJ39apNARaQv4vjsPTYOUPjtcPheoC7TehILh&currency=USD"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<?php
    include_once "includes/footer.php";
?>