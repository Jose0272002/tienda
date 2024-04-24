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
    <?php include("components/header.php") ?>
    <div class="main-content">
        <div class="content-page">
            <div class="title-section">Resultados para <strong>"<?php echo $_GET['text'] ?>"</strong></div>
            <div class="products-list" id="space-list">

            </div>
        </div>
    </div>
    <script src="js/main-scripts.js"></script>
    <script type="text/javascript">
        var text = "<?php echo $_GET['text']; ?>"
        $(document).ready(function() {
            $.ajax({
                url: 'servicios/productos/get_all_results.php',
                type: 'POST',
                data: {
                    text: text
                },
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
                    if (html) {
                        document.getElementById('space-list').innerHTML = html;
                    } else {
                        document.getElementById('space-list').innerHTML = "No hay resultados";
                    }

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
</body>

</html>