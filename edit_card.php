<?php

// Get the record data
$card_id = filter_input(INPUT_POST, 'card_ID');
$set_id = filter_input(INPUT_POST,'set_ID');
$setCode = filter_input(INPUT_POST,'setCode');
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
if ($card_id == NULL || $card_id == FALSE || empty($name) ||
$attribute == NULL || $type == NULL || $cardType == NULL ||
$setNum == NULL || $price == NULL || $price == FALSE) {
$error = "Invalid card data. Check all fields and try again.";
include('error.php');
} else {

/**************************** Image upload ****************************/

$imgFile = $_FILES['image']['name'];
$tmp_dir = $_FILES['image']['tmp_name'];
$imgSize = $_FILES['image']['size'];
$original_image = filter_input(INPUT_POST, 'original_image');

if ($imgFile) {
$upload_dir = 'images/'; // upload directory	
$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$image = rand(1000, 1000000) . "." . $imgExt;
if (in_array($imgExt, $valid_extensions)) {
if ($imgSize < 5000000) {
// if (filter_input(INPUT_POST, 'original_image') !== "") {
// unlink($upload_dir . $original_image);                    
// }
move_uploaded_file($tmp_dir, $upload_dir . $image);
} else {
$errMSG = "Sorry, your file is too large it should be less then 5MB";
}
} else {
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
} else {
// if no image selected the old image remain as it is.
$image = $original_image; // old image from database
}

/************************** End Image upload **************************/

// If valid, update the record in the database
require_once('database.php');

$query = 'UPDATE cards
SET name = :name,
attribute = :attribute,
type = :type,
cardType = :cardType,
level = :level,
atk = :atk,
def = :def,
setNumber = :setNumber,
price = :price,
cardImage = :image
WHERE card_ID = :card_id';
$statement = $db->prepare($query);
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
$statement->bindValue(':card_id', $card_id);
$statement->execute();
$statement->closeCursor();


// Display the Product List page
include('index.php');
}
?>