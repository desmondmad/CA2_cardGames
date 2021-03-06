<?php
    require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM sets
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
    <h1>Sets List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>set ID</th>
            <th>Price</th>
            <th>Release Date</th>
            <th>Set Image</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($sets as $set) : ?>
        <tr>
            <td><?php echo $set['name']; ?></td>
            <td>
                <form action="delete_set.php" method="post"
                      id="delete_set_form">
                    <input type="hidden" name="set_id"
                           value="<?php echo $set['set_ID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>

    <h2>Add Set</h2>
    <form action="add_set.php" method="post"
          id="add_set_form">
        <label>Set ID:</label>
        <input type="input" name="set_ID">
        <br>
        <label>Name:</label>
        <input type="input" name="name">
        <br>
        <label>Price:</label>
        <input type="input" name="price">  
        <br>  
        <label>Release Date:</label>
        <input type="input" name="releaseDate">   
        <br> 
        <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
        <br>
            
        <input id="add_set_button" type="submit" value="Add">
    </form>
    <br>
    <p><a href="index.php">Homepage</a></p>

    <?php
include('includes/footer.php');
?>