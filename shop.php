<?php
$conn = new mysqli("localhost", "root", "", "product");
$result = $conn->query("SELECT * FROM prod");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Showcase</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 30px;
        }

        .product {
            display: inline-block;
            height: 400px;
            width: 350px;
            margin: 20px;
            border: 3px solid lightgray;
            border-radius: 10px;
            text-align: center;
            padding: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

        }
        .product:hover{
             transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .product img {
            height: 250px;
        }

        button {
            background-color: rgb(0, 153, 255);
            /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 10px;
            margin: 10px;
        }

        strong {
            font-size: 30px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

            color: rgb(0, 230, 142);
        }

        h2 {
            text-align: center;
            font-size: 50px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin: 25px;
        }
    </style>
</head>

<body>
    <?php include 'Navbar.php';?>
    <h2>Products</h2>
    <p style="text-align: center; color:darkgrey; font-weight:100;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin: 25px;"> These are the products use by me on the daily basis during my workflow. Feel free to purchase any of the products through the link.</p>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image"><br>
                <strong><?php echo htmlspecialchars($row['pname']); ?></strong><br>
                ₹<?php echo $row['price']; ?><br>
                <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank"><button>Purchase link</button></a>
            </div>
        <?php endwhile; ?>

    </div>

</body>

</html>