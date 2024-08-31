<h1>Edit Product</h1>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <?php
        require_once 'htmlFunction.php';
        echo getHeader();

        require_once 'dbconfig.in.php';
        $productID = "";
        $productName = "";
        $category = "";
        $rating = "";

        if(isset($_GET['id'])) {

            $productID = $_GET['id'];
            $pdo = db_connect();

            $stmt = $pdo->prepare("SELECT * FROM product WHERE productId = :productId");
            $stmt->bindParam(':productId', $productID, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($product) {
                $productName = $product['productName'];
                $category = $product['category'];
                $rating = $product['rating'];
            } else {
                echo "<p>Error: Product not found</p>";
            }
            
        } else {
            echo "<p>Error: No product ID provided</p>";
        }

        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editProduct"])) {

            $productID = $_POST["productID"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            $quantity = $_POST["quantity"];

            $pdo = db_connect();

            if ($pdo) {
                global  $productID;
                global  $pdo;
              
                if (!empty($description)){
                    global  $productID;
                    $str = "UPDATE product SET description = :description WHERE productID = :productID";
                    $stmt = $pdo->prepare($str);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
                    if(!$stmt->execute()){
                        echo"full abdate description"; 
                    }else{
                        echo "<script>alert('Product update description successfully');</script>";
                    }

                } 
                if (!empty($price)){
                    global  $productID;
                    $str = "UPDATE product SET price = :price WHERE productID = :productID";
                    $stmt = $pdo->prepare($str);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
                    if(!$stmt->execute()){
                        echo"full abdate price"; 
                    }else{
                        echo "<script>alert('Product update price successfully');</script>";
                    }
                   
                }
                if (!empty($quantity)){
                    global  $productID;
                    $str = "UPDATE product SET quantity = :quantity WHERE productID = :productID";
                    $stmt = $pdo->prepare($str);
                    $stmt->bindParam(':quantity', $quantity);
                    $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);
                    if(!$stmt->execute()){
                        echo"full abdate quantity "; 
                    }else{
                        echo "<script>alert('Product update quantity successfully');</script>";
                    }
                    
                }
 

                if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == 0) {
                    // Check file type
                    $imageFileType = strtolower(pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION));
                    if ($imageFileType == 'jpeg') {
                        
                        global $productID;
                        $imageFileName = $productID . '.jpeg';
                        $targetDir = 'images/';
    
                        $targetPath = $targetDir . $imageFileName; 
                        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
                            global $productID;
                            
                            $stmt = $pdo->prepare("UPDATE product SET productImageName = :productImageName WHERE productID = :productID");
                            $stmt->bindParam(':productImageName', $imageFileName);
                            $stmt->bindParam(':productID', $productID);
    
                            if ($stmt->execute()) {
                                echo "<script>alert('Product update successfully');</script>";
                            } else {
                                echo "<script>alert('Failed to update product image');</script>";
                            }
                        } else {
                            echo "<script>alert('Failed to upload product image');</script>";
                        }
                    } else {
                        echo "<script>alert('Only JPEG files are allowed');</script>";
                    }
                } 
                $pdo=null;
            } else {
                        echo "<script>alert('Failed to add product');</script>";
            }
                
        } 
        

        
       
    ?>

      

    <form method="POST" action="edit.php" enctype="multipart/form-data">
    <fieldset>
        <legend><h2>Product Record:</h2></legend>

        <label for="productID">Product ID:</label>
        <input type="text" id="productID" name="productID" value="<?php echo $productID; ?>" readonly><br><br>

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" value="<?php echo $productName; ?>" readonly><br><br>
            
        <label for="category">Category:</label>
        <select name="category" disabled>
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
        </select><br><br>
            
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0.01" step="0.01" value="<?php echo $price; ?>" ><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="0" step="1" value="<?php echo $quantity; ?>"><br><br>

        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" value="<?php echo $rating; ?>" readonly><br><br>
            
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"  style="width: 90%; height: 200px;"  ></textarea><br><br>

        <label for="productImage">Product Image:</label>
        <input type="file" id="productImage" name="productImage" accept="image/jpeg"><br><br>
            
        <input type="submit" name="editProduct" value="Edit Product">
    </fieldset>
</form>

    <?php
        echo getFooter();
    ?>
</body>
</html>
