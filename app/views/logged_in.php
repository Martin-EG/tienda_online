<?php

require_once("views/includes/header.php");
require_once("views/includes/sidebar.php");
require_once("views/includes/topbar.php");



switch($page)
{
    case "user_profile":
        include("pages/account/user_profile.php");
    break;

    case "user_list":
        include("pages/users/user_list.php");
    break;

    case "user_form":
        include("pages/account/user_form.php");
    break;

    case "user_view":
        include("pages/users/user_view.php");
    break;

    case "user_add":
        include("pages/users/user_add.php");
    break;

    case "user_update":
        include("pages/users/user_update.php");
    break;

    case "user_delete":
        include("pages/users/user_delete.php");
    break;

    case "product_list":
        include("pages/products/product_list.php");
    break;

    case "product_add":
        include("pages/products/product_add.php");
    break;

    case "product_update":
        include("pages/products/product_update.php");
    break;

    case "product_delete":
        include("pages/products/product_delete.php");
    break;

    case "cat_list":
        include("pages/cat/cat_list.php");
    break;

    case "cat_add":
        include("pages/cat/cat_add.php");
    break;

    case "cat_update":
        include("pages/cat/cat_update.php");
    break;

    case "cat_delete":
        include("pages/cat/cat_delete.php");
    break;

    case "product_list":
        include("pages/products/product_list.php");
    break;

    case "product_add":
        include("pages/products/product_add.php");
    break;

    case "product_view":
        include("pages/products/product_view.php");
    break;

    case "product_update":
        include("pages/products/product_update.php");
    break;

    case "product_delete":
        include("pages/products/product_delete.php");
    break;

    case "inventory_list":
        include("pages/inventory/inventory_list.php");
    break;

    case "inventory_purchase":
        include("pages/inventory/inventory_purchase.php");
    break;

    case "inventory_loss":
        include("pages/inventory/inventory_loss.php");
    break;

    default:
        include("pages/default.php");
    break;

    

}






require_once("views/includes/footer.php"); ?>


