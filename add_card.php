<?php

// Get the product data
$setCode = filter_input(INPUT_POST, 'setCode');
$name = filter_input(INPUT_POST, 'name');
$attribute = filter_input(INPUT_POST, 'attribute');
$type = filter_input(INPUT_POST, 'type');
$cardType = filter_input(INPUT_POST, 'cardType');
$level = filter_input(INPUT_POST, 'level');
$atk = filter_input(INPUT_POST, 'atk');
$def = filter_input(INPUT_POST, 'def');
$setNum = filter_input(INPUT_POST, 'setNumber');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate inputs
if ($setCode == null ||
    $name == null || $price == null || $price == false ||
    $attribute == null || $type == null || $cardType == null) {
    $error = "Invalid card data. Check all fields and try again.";
    include('error.php');
    exit();
} else {

    /**************************** Image upload ****************************/

    error_reporting(~E_NOTICE); 

// avoid notice

    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    echo $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

    if (empty($imgFile)) {
        $image = "";
    } else {
        $upload_dir = 'images/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $image = rand(1000, 1000000) . "." . $imgExt;
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
            if ($imgSize < 5000000) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $image)) {
                    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                } else {
                    $error =  "Sorry, there was an error uploading your file.";
                    include('error.php');
                    exit();
                }
            } else {
                $error = "Sorry, your file is too large.";
                include('error.php');
                exit();
            }
        } else {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            include('error.php');
            exit();
        }
    }

    /************************** End Image upload **************************/
    
    require_once('database.php');

    // Add the product to the database 
    $query = "INSERT INTO cards
                 (setCode,name, attribute, type, cardType, level, 
                 atk, def, setNumber, price, cardImage)
              VALUES
                 (:setCode,:name,:attribute,:type,:cardType,:level,
                 :atk, :def, :setNumber, :price, :image)";
    $statement = $db->prepare($query);
    $statement->bindValue(':setCode', $setCode);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':attribute', $attribute);
    $statement->bindValue(':type', $type);
    $statement->bindValue(':cardType', $cardType);
    $statement->bindValue(':level', $level);
    $statement->bindValue(':atk', $atk);
    $statement->bindValue(':def', $def);
    $statement->bindValue(':setNumber', $setNum);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':image', $image);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}