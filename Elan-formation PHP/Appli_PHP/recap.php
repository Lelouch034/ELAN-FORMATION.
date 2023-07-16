<?php
session_start();

$nombreProduits = isset($_SESSION['products']) ? count($_SESSION['products']) : 0;

if (isset($_POST['supprimer'])) {
    unset($_SESSION['products']);
    header("Location: recap.php");
    exit();
}

if (isset($_POST['modifier_quantite'])) {
    $index = $_POST['modifier_quantite']; // Index du produit à modifier
    $quantite = $_POST['quantite'][$index]; // Nouvelle quantité du produit
    if (isset($_SESSION['products'][$index])) {
        $_SESSION['products'][$index]['qtt'] = $quantite; // Mettre à jour la quantité du produit dans la session
        $_SESSION['products'][$index]['total'] = $_SESSION['products'][$index]['price'] * $quantite; // Mettre à jour le total du produit
    }
    header("Location: recap.php");
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
    <title>Récapitulation des produits</title>
</head>
<body>
    <p style="text-align: center;">Nombre de produits en session : <?php echo $nombreProduits; ?></p>

    <?php
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...</p>";
    } else {
        echo "<form method='post' action=''>"; // Formulaire pour supprimer les produits
        echo "<input type='submit' name='supprimer' value='Supprimer tous les produits'>"; // Bouton de suppression
        echo "</form>";

        echo "<table>",
            "<thead>",
                "<tr>",
                    "<th>#</th>",
                    "<th>Nom</th>",
                    "<th>Prix</th>",
                    "<th>Quantité</th>",
                    "<th>Total</th>",
                    "<th>Action</th>",
                "</tr>",
            "</thead>",

            "<tbody>";

        $totalGeneral = 0;
        foreach ($_SESSION['products'] as $index => $product) {
            echo "<tr>",
                    "<td>" . ($index + 1) . "</td>",
                    "<td>" . $product['name'] . "</td>",
                    "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;$</td>",
                    "<td>",
                        "<form method='post' action=''>",
                            "<input type='hidden' name='modifier_quantite' value='$index'>", // Valeur du bouton de modification de quantité
                            "<button type='submit' name='quantite[$index]' value='" . ($product['qtt'] + 1) . "'>&plus;</button>", // Bouton "+" pour augmenter la quantité
                            "<input type='text' name='quantite_affichee' value='" . $product['qtt'] . "' readonly>", // Affichage de la quantité
                            "<button type='submit' name='quantite[$index]' value='" . ($product['qtt'] - 1) . "'>&minus;</button>", // Bouton "-" pour réduire la quantité
                        "</form>",
                    "</td>",
                    "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;$</td>",
                    "<td>",
                        "<form method='post' action=''>",
                            "<input type='hidden' name='supprimer' value='$index'>", // Valeur du bouton de suppression
                            "<input type='submit' value='Supprimer'>", // Bouton de suppression
                        "</form>",
                    "</td>",
                "</tr>";

            $totalGeneral += $product['total'];
        }

        echo "<tr>",
                "<td colspan='4'>Total général :</td>",
                "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;$</strong></td>",
                "<td></td>", // Colonne vide pour l'action
            "</tr>",
            "</tbody>",
        "</table>";
    }
    ?>

    <p>
        <a href="index.php" class="button">Menu</a>
    </p>
</body>
</html>
