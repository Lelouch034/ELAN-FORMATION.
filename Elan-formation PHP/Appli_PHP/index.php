<?php
session_start();

$nombreProduits = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;

if (isset($_POST['submit'])){
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

    if($name && $price && $qtt){

        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price*$qtt
        ];
        $_SESSION['products'] [] = $product;
    }
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200&family=VT323&display=swap" rel="stylesheet">
    <title>Ajout produit</title>
</head>
<body>
    
    <form action="traitement.php" method="post">
         <h1>Ajouter un produit</h1>
        <p>
            <label>
                Nom du produit : 
                <input type="text" name="name">
            </label>
        </p>
        <p>
            <label>
                Prix du produit : 
                <input type="number" name="price">
            </label>
        </p>
        <p>
            <label>
                Quantité désirée : 
                <input type="number" name="qtt" value="1">
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Ajouter le produit">
        </p>
        <p>
            <a href="recap.php" class="button">Panier</a>
        </p>
    </form>

    <p style="text-align: center;">Nombre de produits en session : <?php echo $nombreProduits; ?></p>

</body>
</html>
