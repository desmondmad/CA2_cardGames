<?php
// Get ID
$set_id = filter_input(INPUT_POST, 'set_id', FILTER_VALIDATE_INT);

// Validate inputs
if ($set_id == null || $set_id == false) {
    $error = "Invalid set ID.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'DELETE FROM sets 
              WHERE set_ID = :set_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':set_id', $set_id);
    $statement->execute();
    $statement->closeCursor();

    // Display the Set List page
    include('sets_list.php');
}
?>
