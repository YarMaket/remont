<?php 
  include('config.php');
  $sql2="select * from spareparts, loco
  where id_l = type_loco
  and count_all>0
  and `type_loco`=".$_POST["id"]."
  order by `name_sp` ASC";
  $result2 = mysqli_query($link, $sql2) or die ("Query failed");
  
  while ($info=mysqli_fetch_assoc($result2)) {
	$arr[]=$info['name_sp'].'. Артикул: '.$info['number'].'@'.$info['count_all'];
	
	
  }
  echo json_encode($arr);


?>