<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    if ($name && $price && $quantity) {
        $message = "Proizvod '$name' dodat (demo, bez baze).";
    } else {
        $message = "Popunite sva polja.";
    }
}
?>
<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj proizvod</title>
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

        form {
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            width: 250px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
        }

        button {
            margin-top: 15px;
            padding: 5px 10px;
        }

        p {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="proizvodis">Products</a>
    <a href="porudzbines">Dodaj proizvod</a>
</nav>

<h1>Dodaj proizvod</h1>
<?php if ($message) echo "<p>$message</p>"; ?>
<form method="post">
    <label>Ime:</label>
    <input type="text" name="name"><br>
    <label>Cena:</label>
    <input type="text" name="price"><br>
    <label>Količina:</label>
    <input type="text" name="quantity"><br>
    <button type="submit">Dodaj</button>
</form>
</body>
</html>

