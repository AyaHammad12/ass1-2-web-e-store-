<?php

    function getFooter() {
        $lastUpdate = "April 5, 2024";
        $storeAddress = "123 Ramallah Street, Ramallah, Palestine";
        $customerSupportPhone = "+0598527811";
        $customerSupportEmail = "Koton_Style@gmail.com";
        $contactPage = "./../ass/ass1/contact.html";
        $companyName = "Koton Style";
        $year = date("Y");

        return "
            <footer>
                <hr>
                <ul>
                    <li>Last Update: {$lastUpdate}</li>
                    <li>Store Address: {$storeAddress}</li>
                    <li>Customer Support: Phone: {$customerSupportPhone} | Email: <a href=\"mailto:{$customerSupportEmail}\">{$customerSupportEmail}</a></li>
                    <li><a href=\"{$contactPage}\">Contact Us</a></li>
                    <li>&copy; {$year} {$companyName}. All rights reserved.</li>
                </ul>
            </footer>
        ";
    }



    function getHeader() {
        return "
            <header>
                <h1>Welcome to Koton Style :) <img src=\"./images/Screenshot.png\" alt=\"logo\" width=\"50\" height=\"60\"></h1>
                <hr>
                <nav>
                    <ul>
                        <li><a href=\"./../index.html\">Personal page</a></li>
                        <li><a href=\"./products.php\">Home ass2 </a></li>
                        <li><a href=\"./../ass/ass1/index.html\">Home</a></li>
                        
                        <li><a href=\"./../ass/ass1/product1.html\">Products</a></li>
                        <li><a href=\"./../ass/ass1/contact.html\">Contact Us</a></li>
                        <li><a href=\"./../ass/ass1/registration.html\">Register</a></li>
                    </ul>
                </nav>
                <hr>
            </header>
        ";
    }


    function getCategoryArray() {
        $categories = ["dress", "T-shirt", "jeans"];
        $str = "";

        foreach ($categories as $category) {
            $str .= "<option value=\"$category\">$category</option>";
        }

        return $str;
    }


?>
