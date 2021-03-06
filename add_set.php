<?php
// Get the set data
$setCode =  filter_input(INPUT_POST, 'setCode');
$name = filter_input(INPUT_POST, 'setName');
$price = filter_input(INPUT_POST, 'price',FILTER_VALIDATE_FLOAT);
$releaseDate = filter_input(INPUT_POST, 'releaseDate');
$releaseDateF = date("Y-m-d",strtotime($releaseDate));

// Validate inputs
if (($name == null) || ($setCode == null) || ($price== null) || 
($price == false) || ($releaseDate == null)) {
    $error = "Invalid set data. Check all fields and try again.";
    include('error.php');
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



    require_once('database.php');

    // Add the set to the database
    $query = "INSERT INTO sets (setCode,name,price,releaseDate,setImage)
              VALUES (:setCode,:name,:price,:release,:image)";
    $statement = $db->prepare($query);
    $statement->bindValue(':setCode', $setCode);
    $statement->bindValue(':setCode', $setCode);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':release', $releaseDateF);
    $statement->bindValue(':image', $image);
    $statement->execute();
    $statement->closeCursor();

    // Display the Sets List page
    include('sets_list.php');
}
?>