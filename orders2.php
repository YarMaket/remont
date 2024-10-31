<?php  require('header.php');

function status($n){
switch ($n) {
	case 1: return "Новый заказ"; break;
	case 2: return "Заказ выполнен"; break;
	case 3: return "Заказ отменен"; break;
	case 4: return "Заказ отменен пользователем"; break;
	case 5: return "Заказ отправлен"; break;
	case 6: return "Заказ доставлен"; break;
}

}

if ($_POST['update']!="")
  
  {
	$sql="UPDATE `orders` SET `status`=".$_POST['status']." WHERE `id_order`=".$_POST['update'];
	$result=mysqli_query($link, $sql) or die ("Query failed!");
	//echo $_POST['status'];
	echo "Статус заказа обновлен!";
  }

 ?>

   <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Заказы</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="control-group">
<?php 
  
    /*$sql="select * from goods, warehouse,supplier, users
where warehouse.id_good = goods.id_good and id_supp = id_s and id = user
order by date_added DESC, name_good ASC";*/
    $sql="select * from orders,users,client
where 
id = user
and  cl = id_cl
and user = ".$_SESSION['user'].
"  
order by `date` DESC";
	//echo $sql;
	$result=mysqli_query($link, $sql) or die ("Query failed!");
     if (mysqli_num_rows($result))  {
    
	
    
	echo "";
	echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
	echo "<tr><th style='width:10%'>№</th><th>Номер заказа</th><th>Дата</th><th>Сотрудник</th><th>Клиент</th><th>Действия</th></tr>";
    
	$i=1;
	$sum=0;
	$cat="";
    while ($myrow = mysqli_fetch_assoc($result)) {
	
	 echo "<tr>";
	
     echo "<td style='width:10%'>".$i."</td><td>".$myrow['number']."</td><td>".date("d.m.Y",strtotime($myrow['date']))."</td><td>".$myrow['fio']."</td><td>".$myrow['FIO']."</td><td>
	 <form method='post' action=''>
	 ";
	 echo "<select name='status' class='form-control'  style='width: 150px;'>";
	 for ($ii=1; $ii<7;$ii++)
		{
		 if ($myrow['status']==$ii)
			echo "<option value=".$ii." selected>".status($ii)."</option>";
		 else
			echo "<option value=".$ii.">".status($ii)."</option>";
			
		}
	 echo "</select>";	
	 echo "<input type='hidden' name='update' value='".$myrow['id_order']."'><button type='submit' style='margin:10px auto;'>Изменить</button></form>	</td>";
	 
	  echo "</tr>";
	  echo "<tr><td colspan='6'>";
	  
		$sql2="select * from items_in_order, goods,warehouse  
		where warehouse.id_good = goods.id_good and item=goods.id_good and warehouse.id_good =item and id_order='".$myrow['id_order']."' 
		GROUP BY item
		Order by name_good ASC";
	//echo $sql;
	$result2=mysqli_query($link, $sql2) or die ("Query failed!-->".$sql2);
     if (mysqli_num_rows($result2))  {
		echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
		echo "<tr><th style='width:10%'>№</th><th>Название товара</th><th>Количество</th><th>Цена</th><th>Стоимость</th></tr>";
    
	$j=1;
	$sum=0;
    while ($myrow2 = mysqli_fetch_assoc($result2)) {
		
				echo "<tr id='product_".$myrow2['id_good']."'>";
				 $sum+=$myrow2['price']*$myrow2['count'];
				 echo "<td style='width:10%'>".$j."</td><td>".$myrow2['name_good']."</td><td>".$myrow2['count']."</td><td>".$myrow2['price']."</td><td><span class='tot_".$myrow2['id_good']."'>".$myrow2['price']*$myrow2['count']."</span></td>";
				  echo "</tr>";	
		
			 $j++;
			}
		echo "</table>";
	}
	  
	  echo "</td></tr>";
	  echo "<tr><td colspan='5'>";
	  
	  
	  echo "</td></tr>";
	 $i++;
    }
	echo "</table>";
	
	
	
	
   }
   else
	echo "Нет заказов!";
?>


  
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>
		