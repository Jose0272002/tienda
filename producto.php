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
</head>

<body>
    <?php include("components/header.php"); ?>
    <div class="main-content">
        <div class="content-page">
            <section>
                <div class="part1">
                    <img id="idimg" src="" alt="">
                </div>
                <div class="part2">
                    <h2 id="idtitle"></h2>
                    <span class="total" id="total"></span><span class="total">€</span>
                    <h3 id="iddesc"></h3>
                    <div id="idcat">Categoría:' + data.datos[i].catpro + </div>
                    <button onclick="iniciar_compra()">Añadir al carrito</button>
                    <?php include("servicios/compra/pasarela.php"); ?>
                </div>
            </section>
            
            <div class="title-section">Productos destacados</div>
            <div class="products-list" id="space-list">

            </div>
        </div>
    </div>
    <script src="js/main-scripts.js"></script>
    <script>
        var p = '<?php echo $_GET["p"] ?>'
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: 'servicios/productos/get_recomendados.php',
                type: 'POST',
                data: {},
                success: function(data) {
                    console.log(data);
                    html = '';
                    for (let i = 0; i < data.datos.length; i++) {
                        if (data.datos[i].codpro == p) {
                            document.getElementById("idimg").src = 'images/products/' + data.datos[i].Img_prod;
                            document.getElementById("idtitle").innerHTML = data.datos[i].nompro
                            document.getElementById("total").innerHTML = data.datos[i].prepro
                            document.getElementById("iddesc").innerHTML = data.datos[i].despro
                            document.getElementById("idcat").innerHTML = "Categoría:"+ data.datos[i].catpro
                        }
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

        function iniciar_compra() {
            $.ajax({
                url: 'servicios/compra/validar_inicio_compra.php',
                type: 'POST',
                data: {
                    codpro: p
                },
                success: function(data) {
                    console.log(data);
                    if (data.state) {
                        alert(data.details)
                    } else {
                        alert(data.details);
                        if (data.open_login) {
                            open_login();
                        }
                    }

                },
                error: function(err) {
                    console.error("Error fetching data:", err.responseText);
                }
            });
        }

        function open_login() {
            window.location.href = "login.php"
        }
    </script>
</body>
<?php include("components/footer.php"); ?>

</html>