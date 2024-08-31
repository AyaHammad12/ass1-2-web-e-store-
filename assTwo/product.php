<?php
class Product {
    
    private $productID;
    private $productName;
    private $category;
    private $description;
    private $price;
    private $rating;
    private $productImageName;
    private $quantity;
    
        
        public function __construct($obj) {
            $this->productID = $obj['productID'];
            $this->productName = $obj['productName'];
            $this->category = $obj['category'];
            $this->description =$obj['description'];
            $this->price = $obj['price'];
            $this->rating = $obj['rating'];
            $this->productImageName = $obj['productImageName'];
            $this->quantity = $obj['quantity'];
        }
        // public function __construct($productID, $productName, $category, $description, $price, $rating, $productImageName) {
        //     $this->productID = $productID;
        //     $this->productName = $productName;
        //     $this->category = $category;
        //     $this->description = $description;
        //     $this->price = $price;
        //     $this->rating = $rating;
        //     $this->productImageName = $productImageName;
        // }
    
        
        public function getProductID() {
            return $this->productID;
        }
    
        public function setProductID($productID) {
            $this->productID = $productID;
        }
    
        public function getProductName() {
            return $this->productName;
        }
    
        public function setProductName($productName) {
            $this->productName = $productName;
        }
    
        public function getCategory() {
            return $this->category;
        }
    
        public function setCategory($category) {
            $this->category = $category;
        }
    
       
        public function getDescription() {
           
            $description_statements = explode('.', $this->description);          
            $strDescription = '';

            foreach ($description_statements as $statement) {
                $statement = trim($statement);
                if (!empty($statement)) {
                    if (substr($statement, -1) !== '.') {
                        $statement .= '.';
                    }
                    
                    $strDescription .= "<li>" . htmlspecialchars($statement) . "</li>";
                }
            }
         
         $strDescription = "<ul>" . $strDescription . "</ul>";

         return $strDescription;
     } 
    
        public function setDescription($description) {
            $this->description = $description;
        }
    
        public function getPrice() {
            return $this->price;
        }
    
        public function setPrice($price) {
            $this->price = $price;
        }
    
        public function getRating() {
            return $this->rating;
        }
    
        public function setRating($rating) {
            $this->rating = $rating;
        }
    
        public function getProductImageName() {
            return $this->productImageName;
        }
    
        public function setProductImageName($productImageName) {
            $this->productImageName = $productImageName;
        }

    
        
    
    

   
    public function displayInTable() {
        $output = "<tr>";
         
        $imagePath = "images/" . $this->productImageName; 
        $output .= "<td><img src=\"./images/{$this->productImageName}\" alt=\"Product Image\" style=\"max-width: 100px;\"></td>";
        
        $output .= "<td><a href='view.php?id={$this->productID}'>{$this->productID}</a></td>";
        $output .= "<td>{$this->productName}</td>";
        $output .= "<td>{$this->category}</td>";
       
        $output .= "<td>{$this->price}</td>";
        $output .= "<td>{$this->quantity}</td>";
       //"C:\xampp\htdocs\htmlFolder\public_html\assTwo\images\pencil.png"
       //"C:\xampp\htdocs\htmlFolder\public_html\assTwo\images\trash.png"
        $output .= "<td><a href='edit.php?id={$this->productID}'><img src=\"./images/pencil.png\" alt=\"pencil image\" style=\"max-width: 20px;\"></a>
        <a href='delete.php?id={$this->productID}'><img src=\"./images/trash.png\" alt=\"trash image\" style=\"max-width: 20px;\"></a></td>";
        $output .= "</tr>";
        return $output;
    }
    public function displayProdcutPage(){
        $outputPage='';
 
        $imagePath = "images/"  . $this->productImageName; 
        $outputPage .= "<img src=\"./images/{$this->productImageName}\"  alt=\"Product Image\" style=\"max-width: 370px;\">";

        $outputPage .= "<h2><strong>Product ID:</strong> " . $this->productID . ", " . $this->productName . "</h2>";

        $outputPage .= "<ul>";
        $outputPage .= "<li><strong>Price:</strong> " .$this->price. "</li>";
        $outputPage .= "<li><strong>Category:</strong> " .$this->category . "</li>";
        $outputPage .= "<li><strong>Rating:</strong> " .$this->rating . "</li>";
        $outputPage .= "</ul>";
        $outputPage .= "<h2>Description:</h2>";
        $outputPage .= "<p>" . $this->getDescription() . "</p>";
         

        
        return $outputPage ;
     
                

    }
  
    

  
}
