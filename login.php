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
        :root {
            --main-header-color: linear-gradient(0deg, #ffffff, #207eb8);
            --main-red: #c60000;
        }

        form {
            max-width: 460px;
            width: calc(100% - 40px);
            padding: 20px;
            border: #fff;
            border-radius: 5px;
            margin: auto;
        }

        form h3 {
            margin: 5px 0;
        }

        form input {
            padding: 7px 10px;
            width: calc(100% - 22px);
            margin-bottom: 10px;
        }

        form button {
            padding: 10px 15px;
            width: 100%;
            background-color: #fff;
            color: #aaa;
        }

        form p {
            margin: 0;
            margin-bottom: 5px;
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
<?php include("components/header.php");?>
    <div class="main-content">
        <div class="content-page">
            <form action="servicios/login.php" method="post">
                <h3>Iniciar sesión</h3>
                <input type="email" name="emausu" placeholder="Correo">
                <input type="password" name="pasusu" placeholder="Contraseña">
                <?php
                if (isset($_GET['e'])) {
                    switch ($_GET['e']) {
                        case 1:
                            echo '<p>Error de conexión.</p>';
                            break;
                        case 2:
                            echo '<p>Email inválido.</p>';
                            break;
                        case 3:
                            echo '<p>Contraseña incorrecta.</p>';
                            break;
                        default:
                            break;
                    }
                }
                ?>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
<?php include("components/footer.php"); ?>
<script src="js/main-scripts.js"></script>
</body>

</html>