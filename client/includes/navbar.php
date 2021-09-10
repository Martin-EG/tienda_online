

    <!-- Navbar -->
    <nav class="nav-extended bm-6">
        <div class="nav-wrapper xp-5 grey darken-3">
            <a href="index.php" class="brand-logo"><img src="assets/img/logo.png" alt="Logo"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right">
                <li class="xm-1 hide-on-med-and-down"><i class="material-icons" id="search_button">search</i></li>
                <li class="xm-3 hide-on-med-and-down"><input id="search" class="search grey" type="search"></li>
                <li class="xm-3 bm-3 submenu">
                    <a href="#"><i class="large material-icons">shopping_cart</i></a>
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
                <input id="searchMobile" class="search grey" type="search" placeholder="Search an item"> <i class="material-icons">search</i>
            </ul>
            <ul class="tabs tabs-transparent hide-on-med-and-down">
                <li class="tab"><a href="index.php?bqd=new">Nuevos productos</a></li>
                <li class="tab"><a href="index.php?bqd=tendencies">Lo mas vendido</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav collapsible" id="mobile-demo">
        <li>
            <a href="#" class="brand-logo"><img src="assets/img/logo.png" alt="Logo"></a>
            <br><br>
        </li>    
        <li>
            <div class="collapsible-header">Categorias</div>
            <div class="collapsible-body">
                <ul id="sidebar-categories">
                    <li><a href="index.php" data-id="0" style="color: black" class="category"><span class="category" data-id="0">Todo</span></a></li>
            <?php 
                $query_categories = "SELECT * FROM categories WHERE cat_active = 1";
                $result_categories = $connection->query($query_categories);
                if($result_categories)
                {
                    if($result_categories->num_rows > 0)
                    {
                        while($row_categories = $result_categories->fetch_assoc())
                        {
                            ?>
                                <li>
                                    <a href="index.php?bqd=category&cat=<?php echo  $row_categories['cat_id']?>"  style="color: black">
                                        <?php echo  $row_categories['cat_name']?>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                }
            ?>
                </ul>
            </div>
        </li>
        <li><a href="index.php?bqd=new">Nuevos productos</a></li>
        <li><a href="index.php?bqd=tendencies">Lo mas vendido</a></li>
    </ul>
    <!-- Navbar -->


