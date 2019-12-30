<?php
    session_start();
$filename = 'auth/private/products';
  $contents = file_get_contents($filename);
  $multi_dim = unserialize($contents);

  if (isset($_GET['sortcategoryasc']))
  {
      $product = array_column($multi_dim, 'name');
      $category = array_column($multi_dim, 'category');
      array_multisort($category, SORT_ASC, $multi_dim);
  }
  if (isset($_GET['sortcategorydesc']))
  {
      $product = array_column($multi_dim, 'name');
      $category = array_column($multi_dim, 'category');
      array_multisort($category, SORT_DESC, $multi_dim);
  }
  if (isset($_GET['sortproductdesc']))
  {
      $product = array_column($multi_dim, 'name');
      $category = array_column($multi_dim, 'category');
      array_multisort($product, SORT_DESC, $multi_dim);
  }
  if (isset($_GET['sortproductasc']))
  {
      $product = array_column($multi_dim, 'name');
      $category = array_column($multi_dim, 'category');
      array_multisort($product, SORT_ASC, $multi_dim);
  }
$str = '
<h4> SORT PRODUCT </h4>
<form method="GET" action=""><button type="submit" name="sortproductasc" value="ok" class="registerbtn">SORT BY PRODUCT ASCENDING</button></form>
<form method="GET" action=""><button type="submit" name="sortproductdesc" value="ok" class="registerbtn">SORT BY PRODUCT DESCENDING</button></form>
<h4> SORT CATEGORY </h4>
<form method="GET" action=""><button type="submit" name="sortcategoryasc" value="ok" class="registerbtn">SORT BY CATEGORY ASCENDING</button></form>
<form method="GET" action=""><button type="submit" name="sortcategorydesc" value="ok" class="registerbtn">SORT BY CATEGORY DESCENDING</button></form>';
  foreach ($multi_dim as $arr)
  {
      $str .= "<h2> PRODUCT: ";
      $str .= $arr['name'];
      $str .= "</h2>";
      $str .= "<h4> Category: ";
      $str .= $arr['category'];
      $str .= "</h4>";
      $str .= '<form method="GET" action=""><button type="submit" name="add" value="';
      $str .= $arr['name'];
      $str .= '" class="registerbtn">';
      $str .= 'add ';
      $str .= $arr['name'];
      $str .= '</button></form>';
      $str .= '<form method="GET" action=""><button type="submit" name="remove" value="';
      $str .= $arr['name'];
      $str .= '"class="registerbtn">';
      $str .= 'remove ';
      $str .= $arr['name'];
      $str .= '</button></form>';
  }
  $str .= '
  <h2>MISC </h2>
  <form method="POST" action=""><button type="submit" name="checkout" value="ok" class="registerbtn">checkout</button></form>
  <form method="POST" action="auth/logout.php"><input type="submit" name="submit" value="logout"></form>
  <form method="POST" action="auth/delete.php"><input type="submit" name="submit" value="detele user"></form>';

  $content = $str;


  $basket = '';

include 'index.php';
?>
