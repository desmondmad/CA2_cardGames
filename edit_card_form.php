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
              <br>

            <label>Set ID:</label>
            <input type="set_id" name="set_id"
                   value="<?php echo $cards['set_ID']; ?>">
            <br>

            <label>SetCode:</label>
            <input type="setCode" name="setCode"
                   value="<?php echo $cards['setCode']; ?>">
            <br> 
            
            <label>Name:</label>
            <input type="input" name="name">
            <br>

            <label>Attribute:</label>
            <input type="input" name="attribute">
            <br>

            <label>Type:</label>
            <input type="input" name="type">
            <br>

            <label>Card Type:</label>
            <input type="input" name="cardType">
            <br>

            <label>Level:</label>
            <input type="input" name="level">
            <br>

            <label>ATK:</label>
            <input type="input" name="atk">
            <br>

            <label>DEF:</label>
            <input type="input" name="def">
            <br>

            <label>Set Number:</label>
            <input type="input" name="setNumber">
            <br> 

            <label>Price:</label>
            <input type="input" name="price">
            <br>  

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>            
            
            <p><img src="image/<?php echo $cards['image']; ?>" height="150" /></p>
            
            <label>&nbsp;</label>
            <input type="submit" value="Save Changes">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>