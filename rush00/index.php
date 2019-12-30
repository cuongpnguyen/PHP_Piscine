<?php
	session_start();
	if (!isset($_SESSION['basket']))
		$_SESSION['basket'] = array();
	if (isset($_GET['add']))
		array_push(($_SESSION['basket']), $_GET['add']);
	if (isset($_GET['remove']))
		unset($_SESSION['basket'][array_search($_GET['remove'], $_SESSION['basket'])]);
	if (isset($_POST['checkout']) && $_POST['checkout'] === 'ok')
	{
		if (!isset($_SESSION['loggued_on_user']) || $_SESSION['loggued_on_user'] === '')
			header('location:auth/login.php');
		else if (!empty($_SESSION['basket']))
		{
			$order['client'] = $_SESSION['loggued_on_user'];
			$order['order'] = $_SESSION['basket'];
			$order['time'] = time();
			if (file_exists('auth/private/orders'))
				$save_arr = unserialize(file_get_contents('auth/private/orders'));
			$save_arr[] = $order;
			file_put_contents('auth/private/orders', serialize($save_arr));
			echo "Order Placed";
			$_SESSION['basket'] = array();
		}
    }
    $filename = 'auth/private/products';
    $contents = file_get_contents($filename);
    $multi_dim = unserialize($contents);
   // print_r($multi_dim);
    $basket = '';

    $basket = '<div class="dropdown">
    <button class="dropbtn">Basket</button>
    <div class="dropdown-content">';
  $total_price;
  //print_r($_SESSION['basket']);
    if (!empty($_SESSION['basket']))
    {
        $count = array_count_values($_SESSION['basket']);
        foreach ($count as $elem => $num) {
          $item_price;
            $basket .= "<br><a>$elem x $num</a> <br>PRICE : ";
            $prc = 0;
            foreach($multi_dim as $arr)
            {
                if ($arr['name'] == $elem)
                    $prc = $arr['price'];
            }
            $item_price = $num * $prc;
     //       $item_price = $num * $multi_dim[$elem]['price'];
            $total_price += $item_price;
            $basket .= "<a> $item_price</a><br>";
        }
    }
  
   // echo $total_price;
  $basket .= ' </div>   </div><br><br> TOTAL PRICE :';
  
  $basket .= $total_price;


  function admin_check($login)
{
    $filename = '../htdocs/private/admin';
    $contents = file_get_contents($filename);
    $accounts = unserialize($contents);
    foreach($accounts as $key => $value)
    {
        if ($key == $login && $value == 'admin')
        {
            return True;
        }
    }
    return False;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">
            </div>
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Coffee</a></li>
                    <li><a href="products.php">Shop</a></li>
                    <li><a href="#">Cart</a></li>
                    <?php
                    if($_SESSION['loggued_on_user']) : ?>
                    <li><a href="#"><?php echo $_SESSION['loggued_on_user']  ?></a></li>
                    <li><a href="auth/logout.php">SIGN OUT</a></li>
                    <?php else : ?>
                    <li><a href="login.php"></a></li>
                    <li><a href="auth/login.php">LOGIN/SIGN UP</a></li>
                    <?php endif; ?>
                    <?php  if($_SESSION['loggued_on_user'] == 'admin') : ?>
                    <li><a href="auth/admin.php">ADMIN PANEL</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div id="content_area">
              <?php 
              echo $content; 
              ?> 
            </div>
            <div id="sidebar">
            <?php
            echo $basket;
            ?>
            </div>
            <footer>
                <p>The Beverage Company</p>
            </footer>
        </div>
    </body>
</html>
