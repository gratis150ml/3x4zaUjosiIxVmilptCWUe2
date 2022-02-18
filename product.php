<?php
include "connect.php";
include "header.php";
global $conn;
$errors = array();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_GET['id'])) {
    $errors[] = "Missing id parameter.";
} else {
    if(empty($_GET['id'])) {
        $errors[] = "Id parameter is empty.";
    } else {
        $r = $conn->prepare("SELECT * FROM products WHERE id=:id");
        $values = array(':id'=>$_GET['id']);
        $r->execute($values);
        $c = $r->rowCount();
        if(!$c==1) {
            $errors[] = "Product doesn't exist.";
        }
    }
}
if(!empty($errors)){
    foreach ($errors as $error) {
        echo $error.'<br>';
    }
} else {
    $all = $r->fetchAll();
    echo '<div style="padding: 10px;">
        <img src="images/'.$all[0]['img'].'" width="300" height="300" alt="'.$all[0]['name'].'"><br>
        <span>
        Price: €'.$all[0]['price'].'
        </span>
    <br></div>';
    echo '<form style="padding:10px; color: white;"action="add_cart.php" method="get">
    <input style="width: 300px;background-color: #1b1e21;border: 1px solid grey;color: white;"class="form-control"type="number" name="quantity" value="1" min="1" max="'.$all[0]['quantity'].'" placeholder="Quantity" required>
    <input type="hidden" name="id" value="'.$all[0]['id'].'"><br>
    <input style="width: 300px;background-color: #1b1e21;border: 1px solid grey;color: white;"class="btn btn-primary"type="submit" value="Add To Cart">
</form>';
}
?>
