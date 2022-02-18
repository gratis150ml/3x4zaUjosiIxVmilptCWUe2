<?php
include "connect.php";
include "header.php";
global $conn;
$errors = array();
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_GET['id'])) {
    $errors[] = "Id missing";
} else {
    if(!is_numeric($_GET['id'])){
        $errors[] = "Id isn't a number";
    }
}
if(!isset($_GET['quantity'])) {
    $errors[] = "Quantity missing";
} else {
    if(!is_numeric($_GET['quantity'])){
        $errors[] = "Quantity isn't a number";
    }
}
if(!empty($errors)){
    foreach ($errors as $error) {
        echo $error.'<br>';
    }
} else {
    $r = $conn->prepare("SELECT * FROM products WHERE id=:id");
        $values = array(':id'=>$_GET['id']);
        $r->execute($values);
        $c = $r->rowCount();
        $all = $r->fetchAll();
        if(!$c==1) {
            echo "product doesn't exist.";
        } else {
            if((int)$all[0]['quantity']>=(int)$_GET['quantity']) {
                if(isset($_SESSION['cart'])) {
                    if(array_key_exists($_GET['id'], $_SESSION['cart'])){
                        $_SESSION['cart'][(int)$_GET['id']] += (int)$_GET['quantity'];
                        header('location: cart.php');
                        exit;
                    } else {
                        $_SESSION['cart'][(int)$_GET['id']] = (int)$_GET['quantity'];
                        header('location: cart.php');
                        exit;
                    }
                } else {
                    $_SESSION['cart'] = array((int)$_GET['id']=>(int)$_GET['quantity']);
                    header('location: cart.php');
                    exit;
                } 
            } else {
                echo "too large quantity";
            }
        }
}
?>
