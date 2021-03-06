<?php
require('database.php');
$query = 'SELECT *
          FROM sets
          ORDER BY set_ID';
$statement = $db->prepare($query);
$statement->execute();
$sets = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Add Card</h1>
        <form action="add_Card.php" method="post" enctype="multipart/form-data"
              id="add_card_form">

            <label>Set:</label>
            <select name="set_id">
            <?php foreach ($sets as $set) : ?>
                <option value="<?php echo $set['set_ID']; ?>">
                    <?php echo $set['name']; ?>
                    <?php echo $set['price']; ?>
                    <?php echo $set['release']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Name:</label>
            <input type="input" name="name">
            <br>

            <label>Price:</label>
            <input type="input" name="price">
            <br>        
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add card">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>