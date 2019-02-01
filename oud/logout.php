<html>
    <button type="Logout">Logout</button>
<?php    
    session_destroy();
?>
</html>

//juiste uitlog methode
$_SESSION['naam']=null;