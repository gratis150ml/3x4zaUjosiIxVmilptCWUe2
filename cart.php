<?php
include "connect.php";
include "header.php";
global $conn;
$errors = array();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['cart'])) {
    echo '<h4 style="padding: 10px;">Cart</h4>';
    $vvv = 0;
    foreach ($_SESSION['cart'] as $k => $value) {
        $r = $conn->prepare("SELECT * FROM products WHERE id=:id");
        $values = array(':id'=>$k);
        $r->execute($values);
        $all = $r->fetchAll();
        if ($value>(int)$all[0]['quantity']) {
            $value = (int)$all[0]['quantity'];
        }
        $vvv += $value*(int)$all[0]['price'];
        echo '<div style="padding: 10px;">
            <img src="images/'.$all[0]['img'].'" width="300" height="300" alt="'.$all[0]['name'].'"><br>
            <span>
            Price: €'.(int)$all[0]['price'].'
            </span>
        <br><span>Quantity: '.$value.'</span><br><br><br></div>';
    }
    echo '<p style="padding: 10px;">Total: €'.$vvv.'</p><br>';
    echo '<form style="padding: 10px;"action="success.php" method="get">
    <input style="width: 300px;background-color: #1b1e21;border: 1px solid grey;color: white;"class="btn btn-primary"type="submit" value="Buy">
    
    </form>';
    echo '<div style="padding: 10px;"><a href="clean_cart.php">Clean Cart</a></div>';

}
?>
