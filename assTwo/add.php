<?php

require_once 'dbconfig.in.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addProduct"])) {


    $productName =  isset($_POST["productName"]) ? $_POST["productName"] : "";
    $category = isset( $_POST["category"] )? $_POST["category"] : "";
    $description =isset( $_POST["description"]) ? $_POST["description"] : "";
    $price = isset($_POST["price"])  ? $_POST["price"] : 0 ;
    $rating = isset($_POST["rating"]) ? $_POST["rating"] : 0 ;
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 0  ;


    if ($pdo) {
        
        $stmt = $pdo->prepare("INSERT INTO product (productName, category, description, price, rating, quantity) VALUES (:productName, :category, :description, :price, :rating, :quantity)");
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':quantity', $quantity);

        if ($stmt->execute()) {
           
            $last_id = $pdo->lastInsertId();

            
            if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == 0) {
                
                $imageFileType = strtolower(pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION));
                if ($imageFileType == 'jpeg') {
                    
                    $imageFileName = $last_id . '.jpeg';
                    $targetPath = 'images/' . $imageFileName;

                    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetPath)) {
                        $stmt = $pdo->prepare("UPDATE product SET productImageName = :productImageName WHERE productID = :productID");
                        $stmt->bindParam(':productImageName', $imageFileName);
                        $stmt->bindParam(':productID', $last_id);

                        if ($stmt->execute()) {
                            echo "<script>alert('Product added successfully');</script>";
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
        } else {
            echo "<script>alert('Failed to add product');</script>";
        }
    } 
    
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>

    <?php
     require_once 'htmlFunction.php';
     echo getHeader();
    
    ?>
    <form method="POST" action="add.php" enctype="multipart/form-data">
        <fieldset>
            <legend><h2>Add Product</h2></legend>
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required><br><br>
                
                <label for="category"  >Category:</label>

                <select name="category" required>
                    <option value="">Select Category</option>
                    <?php
                     require_once 'htmlFunction.php';
                     echo getCategoryArray();
                    
                    ?>
                </select>

                <br>
                <br>
                
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4"  style="width: 90%; height: 200px;" required ></textarea><br><br>
                
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" min="0.01" step="0.01"  required><br><br>
                
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating" min="0" max="5" step="0.1" required><br><br>
                <!-- quantity -->
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="0"  step="0.1" required><br><br>

                <label for="productImage">Product Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/jpeg" required><br><br>
                
                <input type="submit" name="addProduct" value="Add Product">
            </fieldset>
    </form>
    <?php
        require_once 'htmlFunction.php';
      echo getFooter();
    ?>
 
</body>
</html>
