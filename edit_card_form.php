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
            <input type="hidden" name="card_ID"
                   value="<?php echo $cards['card_ID']; ?>">
              <br>
            
            <label>Name:</label>
            <input type="input" name="name" value="<?php echo $cards['name']; ?>">
            <br>

            <label>Attribute:</label>
            <input type="input" name="attribute" value="<?php echo $cards['attribute']; ?>">
            <br>

            <label>Type:</label>
            <input type="input" name="type" value="<?php echo $cards['type']; ?>">
            <br>

            <label>Card Type:</label>
            <input type="input" name="cardType" value="<?php echo $cards['cardType']; ?>">
            <br>

            <label>Level:</label>
            <input type="input" name="level" value="<?php echo $cards['level']; ?>">
            <br>

            <label>ATK:</label>
            <input type="input" name="atk" value="<?php echo $cards['atk']; ?>">
            <br>

            <label>DEF:</label>
            <input type="input" name="def" value="<?php echo $cards['def']; ?>">
            <br>

            <label>Set Number:</label>
            <input type="input" name="setNumber" value="<?php echo $cards['setNumber']; ?>">
            <br> 

            <label>Price:</label>
            <input type="input" name="price" value="<?php echo $cards['price']; ?>">
            <br>  

            <label>Image:</label>
            <input type="file" name="image"/>
            <br>  
            <?php if ($cards['cardImage'] != "") { ?>
            <p><img src="images/<?php echo $cards['cardImage']; ?>" height="150" /></p>
            <?php } ?>          

            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>