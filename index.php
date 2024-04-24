<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sometype+Mono&family=Urbanist:ital,wght@1,300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        input[type=range] {
            width: 100%;
            margin: 10px 0;
        }

        body {
            height: 100%;
            margin: 0;
        }

        footer {
            height: 100px;
            margin-bottom: 0;
            width: 100%;
        }

        .main-content {
            display: flex;
            width: 100%;
        }

        #filtros {
            height: 100vh;
            width: 100%;
            /* Ancho fijo del aside */
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .content-page {
            flex: 1;
            /* Hace que el área de contenido ocupe el espacio restante */
        }
    </style>

</head>

<body>
    <?php include("components/header.php") ?>
    <div class="main-content">
        <aside id="filtros">
            <h2>Filtros de búsqueda: </h2>
            <form action="filtrado.php" method="POST" onsubmit="return validarFiltros()">
                <label for="precio_minimo">Precio Mínimo:<span id="precioMinLabel">0€</span></label>
                <input type="range" id="precio_minimo" name="precio_minimo" min="0" max="1000" value="0" step="1" oninput="actualizarRango('precio_minimo', 'precioMinLabel')">

                <label for="precio_maximo">Precio Máximo:<span id="precioMaxLabel">5000€</span></label>
                <input type="range" id="precio_maximo" name="precio_maximo" min="0" max="5000" value="5000" step="1" oninput="actualizarRango('precio_maximo', 'precioMaxLabel')">

                <label for="categoria">Selecciona una categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="" selected>Categoría...</option>
                    <option value="smartphones">Smartphones</option>
                    <option value="ordenadores">Ordenadores</option>
                    <option value="accesorios">Accesorios</option>
                    <option value="impresoras">Impresoras</option>
                    <option value="tablets">Tablets</option>
                </select>
                <br>
                <input class="submit" type="submit" value="Filtrar">
            </form>
        </aside>
        <div class="content-page">
            <div class="title-section">Productos destacados</div>
            <div class="products-list" id="space-list">

            </div>
        </div>
    </div>
    <script src="js/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: 'servicios/productos/get_all_products.php',
                type: 'POST',
                data: {},
                success: function(data) {
                    console.log(data);
                    html = '';
                    for (let i = 0; i < data.datos.length; i++) {
                        html += '<div class="product-box">' +
                            '<a href="producto.php?p=' + data.datos[i].codpro + '" >' +
                            '<div class="product">' +
                            '<img src="images/products/' + data.datos[i].Img_prod + '" alt="">' +
                            '<div class="detail-title">' + data.datos[i].nompro + '</div>' +
                            '<div class="detail-description">' + data.datos[i].despro + '</div>' +
                            '<div class="detail-price">' + formato_precio(data.datos[i].prepro) + '</div>' +
                            '</div>' +
                            '</a>' +
                            '</div>';
                    }
                    document.getElementById('space-list').innerHTML = html;
                },
                error: function(err) {
                    console.error("Error fetching data:", err.responseText);
                }
            });
        });

        function formato_precio(valor) {
            let svalor = valor.toString()
            let array = svalor.split(".")
            return array[0] + ".<span>" + array[1] + "€</span>";
        }
    </script>
    <?php include("components/footer.php"); ?>
</body>

</html>