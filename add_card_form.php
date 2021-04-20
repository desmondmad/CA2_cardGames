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
    <?php
include('includes/footer.php');
?>