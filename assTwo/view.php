
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>PHP File</title>  
</head>
<body>
<?php
    require_once 'htmlFunction.php';
    echo getHeader();

    require_once 'dbconfig.in.php';
    require_once 'product.php';


    
    if(isset($_GET['id'])) {
        $productId = $_GET['id'];
        $pdo = db_connect();

        $stmt = $pdo->prepare("SELECT * FROM product WHERE productId = :productId");
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();

        
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($product)){
            echo "<p>Error: No product ID provided</p>";
        }else {
            $obj = new Product($product);
            echo $obj->displayProdcutPage();
            $pdo = null;
        }
    } else {
       
        echo "<p>Error: No product ID provided</p>";
    }

    require_once 'htmlFunction.php';
    echo getFooter();


?>
   
</body>
</html>






