<?php
require_once 'htmlFunction.php';
echo getHeader();
echo "<h1>delet recorde : </h1>";
require_once 'dbconfig.in.php';


if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    
    if ($pdo) {
        
        $stmt = $pdo->prepare("DELETE FROM product WHERE productID = :productID");
        $stmt->bindParam(':productID', $productID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Product deleted successfully";
            echo "<script>alert('Product deleted successfully'); </script>";
        } else {
            echo " Failed to delete product";
            echo "<script>alert('Failed to delete product'); </script>";
        }
    } else {
        echo " Database connection failed";
        echo "<script>alert('Database connection failed'); </script>";
    }
} else {
    echo " Invalid product ID";
     echo "<script>alert('Invalid product ID'); </script>";
}
echo getFooter();
?>
