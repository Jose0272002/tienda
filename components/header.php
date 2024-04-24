<header>
    <div class="logo-place"><a href="index.php"><img src="images/logo.png" alt="logo"></a></div>
    <div class="search-place">
        <input type="text" id="idbusqueda" placeholder="Busqueda rápida" value="<?php if (isset($_GET['text'])) {
                                                                                    echo $_GET['text'];
                                                                                } ?>">
        <button class="btn-main btn-search" onclick="buscar_producto()"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
    <div class="options-place">
       
        <div class="item-option" title="Pedidos">
            <a href="Pedidos.php"> <i class="fa fa-list-alt" aria-hidden="true"></i></a>
        </div>
        <div class="item-option" title="Inicio">
            <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
        </div>
        <div class="item-option" title="Carrito">
            <a href="carrito.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        </div>
        <?php
        if (isset($_SESSION["codusu"])) {

            echo '<div class="item-option" onclick="mostrar_opciones()"><i class="fa fa-user" aria-hidden="true"></i><p>'
                . $_SESSION['nomusu'] . '</p></div>';
        } else {
        ?>
            <div class="item-option" title="Iniciar sesión">
                <a href="login.php"><i class="fa fa-user" aria-hidden="true"></i></a>
            </div>
            <div class="item-option" title="Registro">
                <a href="registro.php"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </div>

        <?php
        }
        ?>

    </div>
    <div class="menu-movil" onclick="mostrar_opciones()">
        <div class="item-option"><i class="fa fa-bars" aria-hidden="true"></i></div>
    </div>
</header>
<script>
    function mostrar_opciones() {
        if (document.getElementById("ctrl-menu").style.display == "block") {
            document.getElementById("ctrl-menu").style.display = "none";
        } else {
            document.getElementById("ctrl-menu").style.display = "block";
        }
    }
</script>
<?php
if (isset($_SESSION["codusu"])) {
?>
    <div class="menu-opciones" id="ctrl-menu">
        <ul>
            <li>
                <a href="historial.php">
                    <div class="menu-opcion">Historial de compras</div>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <div class="menu-opcion">Salir</div>
                </a>
            </li>
        </ul>
    </div><?php
        } else {
            ?> <div class="menu-opciones" id="ctrl-menu">
        <ul>
            <li>
                <a href="registro.php">
                    <div class="menu-opcion">Registro</div>
                </a>
            </li>
            <li>
                <a href="login.php">
                    <div class="menu-opcion">Iniciar sesión</div>
                </a>
            </li>
            <li>
                <a href="carrito.php">
                    <div class="menu-opcion">Carrito</div>
                </a>
            </li>
            <li>
                <a href="historial.php">
                    <div class="menu-opcion">Historial de compra</div>
                </a>
            </li>
        </ul>
    </div>
<?php
        } ?>