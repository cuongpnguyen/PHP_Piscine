<?php
session_start();
include('auth/auth.php');

create("admin", "password");
create("test", "test");
add_products("Tea", "beverage", 1.25);
add_products("Coffee", "beverage", 3.55);
add_products("Cola", "beverage", 2.25);
add_products("Secret Item", "beverage", 10.00);
?>