<?php
require_once('database.php');

// Get IDs
$card_id = filter_input(INPUT_POST, 'card_id', FILTER_VALIDATE_INT);
$set_id = filter_input(INPUT_POST, 'set_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($card_id != false && $set_id != false) {
    $query = "DELETE FROM cards
              WHERE card_ID = :card_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':card_id', $card_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>