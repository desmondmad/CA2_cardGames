<?php
/**
 * Start the session.
 */
session_start();

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

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
            <select name="attribute">
                <option value="LIGHT">LIGHT</option>
                <option value="DARK">DARK</option>
                <option value="WIND">WIND</option>
                <option value="WATER">WATER</option>
                <option value="FIRE">FIRE</option>
                <option value="EARTH">EARTH</option>
                <option value="DIVINE">DIVINE</option>
                <option value="SPELL">SPELL</option>
                <option value="TRAP">TRAP</option>
            </select>
            <br>

            <label>Type:</label>
            <select name="type">
                <option value="Dragon">Dragon</option>
                <option value="Spellcaster">Spellcaster</option>
                <option value="Warrior">Warrior</option>
                <option value="Machine">Machine</option>
                <option value="Beast">Beast</option>
                <option value="Beast-Warrior">Beast-Warrior</option>
                <option value="Winged-Beast">Winged-Beast</option>
                <option value="Wyrm">Wyrm</option>
                <option value="Psychic">Psychic</option>
                <option value="Thunder">Thunder</option>
                <option value="Pyro">Pyro</option>
                <option value="Aqua">Aqua</option>
                <option value="Fairy">Fairy</option>
                <option value="Cyberse">Cyberse</option>
                <option value="Rock">Rock</option>
                <option value="Reptile">Reptile</option>
                <option value="Dinosaur">Dinosaur</option>
                <option value="Zombie">Zombie</option>
                <option value="Fish">Fish</option>
                <option value="Sea-Serpent">Sea-Serpent</option>
                <option value="Fiend">Fiend</option>
                <option value="Divine-Beast">Divine-Beast</option>
                <option value="Normal">Normal</option>
                <option value="Equip">Equip</option>
                <option value="Continuous">Continuous</option>
                <option value="Quick-Play">Quick-Play</option>
                <option value="Counter">Counter</option>
                <option value="Ritual">Ritual</option>
            </select>
            <br>

            <label>Card Type:</label>
            <select name="cardType">
                <option value="Normal">Normal</option>
                <option value="Normal/Pendulum">Normal/Pendulum</option>
                <option value="Effect">Effect</option>
                <option value="Effect/Pendulum">Effect/Pendulum</option>
                <option value="Ritual">Ritual</option>
                <option value="Fusion">Fusion</option>
                <option value="Fusion/Pendulum">Fusion/Pendulum</option>
                <option value="Synchro">Synchro</option>
                <option value="Synchro/Pendulum">Synchro/Pendulum</option>
                <option value="Xyz">Xyz</option>
                <option value="Xyz/Pendulum">Xyz/Pendulum"</option>
                <option value="Link">Link</option>
                <option value="Spell">Spell</option>
                <option value="Trap">Trap</option>
            </select>
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
    <?php
include('includes/footer.php');
?>