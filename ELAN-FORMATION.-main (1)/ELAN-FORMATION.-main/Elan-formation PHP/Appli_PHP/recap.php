<body>
    <?php 
    
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo "<p>Aucun produit en session...</p>";
    } else {
        echo "<table>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantite</th>",
                        "<th>Total</th>",
                    "</tr>",
                "</thead>",
                "<tbody>";
                
        $totalGeneral = 0;
        foreach ($_SESSION['products'] as $index => $product) {
            echo "<tr>",
                    "<td>" . ($index + 1) . "</td>",
                    "<td>" . $product['name'] . "</td>",
                    "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;$</td>",
                    "<td>" . $product['qtt'] . "</td>",
                    "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;$</td>",
                "</tr>";
                
            $totalGeneral += $product['total'];
        }
        
        echo "<tr>",
                "<td colspan=4>Total général : </td>",
                "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;$</strong></td>",
            "</tr>",
            "</tbody>",
        "</table>";
    }
    var_dump($_SESSION);
    
    ?>
</body>
