<?php
require('database.php');

$card_id = filter_input(INPUT_POST, 'card_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM cards
          WHERE card_ID = :card_id';
$statement = $db->prepare($query);
$statement->bindValue(':card_id', $card_id);
$statement->execute();
$cards = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1>
        <form action="edit_card.php" method="post" enctype="multipart/form-data"
              id="add_card_form">
            <input type="hidden" name="original_image" value="<?php echo $cards['image']; ?>" />
            <input type="hidden" name="card_id"
                   value="<?php echo $cards['cardID']; ?>">

            <label>Set ID:</label>
            <input type="set_id" name="set_id"
                   value="<?php echo $cards['set_ID']; ?>">
            <br>

            <label>Name:</label>
            <input type="input" name="name"
                   value="<?php echo $cards['name']; ?>">
            <br>

            <label>List Price:</label>
            <input type="input" name="price"
                   value="<?php echo $cards['price']; ?>">
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>            
            <?php if ($cards['image'] != "") { ?>
            <p><img src="image/<?php echo $cards['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>