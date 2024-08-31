<!DOCTYPE html>
<html>
<head>
    <title>PHP File</title>  
</head>
<body>
    <?php
     require_once 'htmlFunction.php';
     echo getHeader();
    ?>
   
    <p>To Add a new Product click om the following link <a href="./add.php"> Add Product</a></p>
    <p>Or use actions below to edit or delet a Products recode .</p>
      

    <form action="products.php" method="post">
        <fieldset>
            <legend><h2>Advanced Product Search</h2></legend>
            <input type="text" id="SearchProductName" name="SearchProductName" placeholder="Search Product Name">
            <input type="radio" name="RadFilter" value="Name"> Name
            <input type="radio" name="RadFilter" value="Price"> Price
            <input type="radio" name="RadFilterforCategory" value="Category"> Category
            
            
            <br><br>
            <select name="myComboBox">
            <option value="name">Select Category</option>
            
            <?php
             require_once 'htmlFunction.php';
             echo getCategoryArray();
            
            ?> 
            </select>
        
            <input type="submit" name="filter" value="Filter">
            <br>
            <br>


            <?php
            require_once 'dbconfig.in.php';
            require_once 'product.php';
            $query = "SELECT * FROM product";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pdo = db_connect();
                global $query;

                
                if (isset($_POST["filter"])) {
                    // Check if the variables are set and assign their values
                    $filterValue = isset($_POST["RadFilter"]) ? $_POST["RadFilter"] : "";
                    $searchValue = isset($_POST["SearchProductName"]) ? $_POST["SearchProductName"] : "";
                    $FilterforCategory = isset($_POST["RadFilterforCategory"]) ? $_POST["RadFilterforCategory"] : "";
                }
                

                    if ((!empty($filterValue) && !empty($searchValue)) && !empty($FilterforCategory) ){
                        if ($filterValue === "Name") {
                            $query .= " WHERE productName LIKE '%$searchValue%'";
                            $category = $_POST["myComboBox"];
                            $query .= " AND  category = '$category'";
                        } elseif ($filterValue === "Price") {
                            $query .= " WHERE price >= $searchValue";
                            $category = $_POST["myComboBox"];
                            $query .= " AND category = '$category'";
                        }
                    }
                    else if ((!empty($filterValue) && !empty($searchValue)) ||!empty($FilterforCategory) ){
                        if ($filterValue === "Name") {
                            $query .= " WHERE productName LIKE '%$searchValue%'";
                        } elseif ($filterValue === "Price") {
                            $query .= " WHERE price >= $searchValue";
                        } elseif ($FilterforCategory === "Category") {
                            $category = $_POST["myComboBox"];
                            $query .= " WHERE category = '$category'";
                        }
                    }
                
                }
            
                $query .= " ORDER BY productName";
                $result = $pdo->query($query);
            ?>
                <table border=\"0\">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Category</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Product Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = $result->fetch(PDO::FETCH_ASSOC)) {
                            $product = new Product($item);
                            echo $product->displayInTable();
                        } ?>
                    </tbody>
                </table>
            <?php
                $pdo = null;

            ?>
        </fieldset>
    </form>
    <?php
        require_once 'htmlFunction.php';
        echo getFooter();
    ?>
</body>
</html>

