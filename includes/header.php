<!-- the head section -->
<head>
<title>Draw Phase Card Shop</title>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>
</head>

<!-- the body section -->
<body>
<header><h1>Draw Phase Card Shop and Collections</h1>
<div class="topnav">
  <a href="index.php">Home</a>
  <?php 
if(isset($_SESSION['logged_in']) && $_SESSION['user_Type'] == 1){
     echo  "<a href=\"manage_collection.php\">Manage Collection</a>";
     echo "<a href=\"add_card_form.php\">Add Card</a>";
     echo   "<a href=\"sets_list.php\">Manage Sets</a>";
     echo  "<a href=\"logout.php\">Logout</a>";
}
  
if(isset($_SESSION['logged_in']) && $_SESSION['user_Type'] == 0){
     echo  "<a href=\"contact.php\">Contact</a>";
     echo  "<a href=\"logout.php\">Logout</a>";     
  }

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    echo  "<a href=\"register.php\">Register</a>";
     echo "<a href=\"login.php\">Login</a>";
}
?>
</div>
</header>