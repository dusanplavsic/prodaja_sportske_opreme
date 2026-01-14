<?php
$products = [
    ['name' => 'Product 1', 'description' => 'opis proizvoda', 'price' => '1000 RSD'],
    ['name' => 'Product 2', 'description' => 'opis proizvoda', 'price' => '1500 RSD'],
    ['name' => 'Product 3', 'description' => 'opis proizvoda', 'price' => '2000 RSD'],
];
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }

        nav {
            background: #e0e0e0;
            padding: 10px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
            color: #333;
        }

        h1 {
            margin-bottom: 20px;
        }

        /* Lista proizvoda */
        .product-ul {
            list-style-type: none;
            padding: 0;
        }

        .product-ul li {
            border: 1px solid #ccc;
            background: #fff;
            margin-bottom: 10px;
            padding: 10px;
        }

        button {
            margin-top: 10px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="proizvodis">Products</a>
    <a href="porudzbines">Dodaj proizvod</a>
</nav>

<h1>Proizvodi</h1>
<ul class="product-ul">
    <?php foreach ($products as $p): ?>
        <li>
            <strong><?= $p['name'] ?></strong><br>
            <?= $p['description'] ?><br>
            Cena: <?= $p['price'] ?>
        </li>
    <?php endforeach; ?>
</ul>

<a href="porudzbines"><button>Dodaj proizvod</button></a>
</body>
</html>
