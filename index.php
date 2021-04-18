<?php
require_once('database.php');

// Get set ID
if (!isset($set_id)) {
$set_id = filter_input(INPUT_GET, 'set_id',FILTER_VALIDATE_INT);
if ($set_id == NULL || $set_id == FALSE) {
        $set_id =  1;
    }
}

// Get name for current set
$querySet = "SELECT * FROM sets
WHERE set_ID = :set_id";
$statement1 = $db->prepare($querySet);
$statement1->bindValue(':set_id', $set_id);
$statement1->execute();
$sets = $statement1->fetch();
$statement1->closeCursor();

// Get all sets
$queryAllSets = 'SELECT * FROM sets
ORDER BY set_ID';
$statement2 = $db->prepare($queryAllSets);
$statement2->execute();
$sets = $statement2->fetchAll();
$statement2->closeCursor();

// Get cards for selected set
$queryCards = "SELECT * FROM cards 
WHERE set_ID = :set_id
ORDER BY card_ID";
$statement3 = $db->prepare($queryCards);
$statement3->bindValue(':set_id', $set_id);
$statement3->execute();
$cards = $statement3->fetchAll();
$statement3->closeCursor();
?>

<div class="container">
<?php
include('includes/header.php');
?>
<main>
    
<h1 class="index_h1">Welcome to Draw Phase, the only place in Ireland that sells cards</h1>

<aside>
<!-- display a list of Sets -->
<h2>Sets</h2>
<nav>
<ul>
<?php foreach ($sets as $set) : ?>
<li><a href=".?set_id=<?php echo $set['set_ID']; ?>">
<?php echo $set['name']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of cards -->

<h2><?php echo $set['name']; ?></h2>
<table>
<tr>
<th>Image</th>
<th>setCode</th>
<th>Name</th>
<th>Attribute</th>
<th>Type</th>
<th>Card Type</th>
<th>Level</th>
<th>ATK</th>
<th>DEF</th>
<th>Set No.</th>
<th>Price</th>
<th>Delete</th>
<th>Edit</th>
</tr>
<?php foreach ($cards as $card) : ?>
<tr>
<td><img src="images/<?php echo $card['cardImage']; ?>" width="100px" height="100px" /></td>
<td><?php echo $card['setCode']; ?></td>
<td><?php echo $card['name']; ?></td>
<td><?php echo $card['attribute']; ?></td>
<td><?php echo $card['type']; ?></td>
<td><?php echo $card['cardType']; ?></td>
<td><?php echo $card['level']; ?></td>
<td><?php echo $card['atk']; ?></td>
<td><?php echo $card['def']; ?></td>
<td><?php echo $card['setNumber']; ?></td>
<td class="right"><?php echo $card['price']; ?></td>
<td><form action="delete_card.php" method="post"
id="delete_card_form">
<input type="hidden" name="card_id"
value="<?php echo $card['card_ID']; ?>">
<input type="hidden" name="set_id"
value="<?php echo $card['set_ID']; ?>">
<input type="submit" value="Delete">
</form></td>
<td><form action="edit_card_form.php" method="post"
id="delete_card_form">
<input type="hidden" name="card_id"
value="<?php echo $card['card_ID']; ?>">
<input type="hidden" name="set_id"
value="<?php echo $card['set_ID']; ?>">
<input type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
</table>
<p><a href="add_card_form.php">Add Card</a></p>
<p><a href="sets_list.php">Manage Sets</a></p>
</section>
<?php
include('includes/footer.php');
?>