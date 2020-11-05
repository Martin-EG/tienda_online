

    <!-- Navbar -->
    <nav class="nav-extended bm-6">
        <div class="nav-wrapper xp-5 grey darken-3">
            <a href="index.php" class="brand-logo"><img src="assets/img/logo.png" alt="Logo"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right">
                <li class="xm-1 hide-on-med-and-down"><i class="material-icons">search</i></li>
                <li class="xm-3 hide-on-med-and-down"><input id="search" type="search"></li>
                <li class="xm-3 submenu">
                    <a><i class="large material-icons">shopping_cart</i></a>
                    <div id="carrito">
                        <table id="lista-carrito">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="bm-5"></tbody>
                        </table>
                        <a href="shopping_cart.php" id="buy_all" class="btn green darken-3 tm-5" style="display: block;">Comprar todo</a>
                        <a href="#" id="vaciar-carrito" class="btn blue-grey darken-1 tm-2" style="display: block;">Vaciar Carrito</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="nav-content xp-3 blue-grey darken-3">
            <ul class="tabs tabs-transparent show-on-medium-and-down hide-on-large-only">
                <input id="search" type="search" placeholder="Search an item">
            </ul>
            <ul class="tabs tabs-transparent hide-on-med-and-down">
                <li class="tab"><a href="index.php">Todo</a></li>
                <li class="tab"><a href="index.php?bqd=categories">Categorias</a></li>
                <li class="tab"><a href="index.php?bqd=new">Nuevos productos</a></li>
                <li class="tab"><a href="index.php?bqd=tendencies">Lo mas vendido</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav collapsible" id="mobile-demo">
        <a href="#" class="brand-logo"><img src="assets/img/logo.png" alt="Logo"></a><br>
        <li>
            <div class="collapsible-header">Categorias</div>
            <div class="collapsible-body">
            <?php 
                $query_categories = "SELECT * FROM categories WHERE cat_active = 1";
                $result_categories = $connection->query($query_categories);
                if($result_categories)
                {
                    if($result_categories->num_rows > 0)
                    {
                        echo "<ul>";
                        while($row_categories = $result_categories->fetch_assoc())
                        {
                            ?>
                                <li><a href="#!" data-id="<?php echo  $row_categories['cat_id']?>" style="color: black"><span><?php echo  $row_categories['cat_name']?></span></a></li>
                            <?php
                        }
                        echo "</ul>";
                    }
                }
            ?>
            </div>
        </li>
        <li><a href="#">Nuevos productos</a></li>
        <li><a href="#">Lo mas vendido</a></li>
    </ul>
    <!-- Navbar -->


