<?php

class UpdateRec extends InsertRec{

function public updateMe(){
  echo '<form method="post">';
  echo '<p>Name: <input type="text" name="fname" /></p>';
  echo '<p>Email: <input type="text" name="email" /></p>';
  echo '<p>Address: <input type="text" name="address" /></p>';
  echo '<p>City: <input type="text" name="city" /></p>';
  echo '<p>Zipcode: <input type="text" name="zip" /></p>';
  echo '<input type="submit" value="Save Record"  />';
  echo '</form>';



}


}




?>