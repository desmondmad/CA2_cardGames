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
        <form action="add_Card.php" method="post" enctype="multipart/form-data" id="add_card_form">

            <label>Set:</label>
            <select name="set_ID">
            <?php foreach ($sets as $set) : ?>
                <option value="<?php echo $set['set_ID']; ?>">
                    <?php echo $set['name']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>SetCode:</label>
            <select name="setCode">
            <?php foreach ($sets as $set) : ?>
                <option value="<?php echo $set['setCode']; ?>">
                    <?php echo $set['setCode']; ?>
                </option>
            <?php endforeach; ?>
            </select>
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
            <input type="file" name="image"/>
            <br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Add card">
            <br>
        </form>
        <p><a href="index.php">View Homepage</a></p>
    <?php
include('includes/footer.php');
?>