<?php  require('header.php'); ?>
   <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> </h2>

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
  if ($_POST['delete']!="")
  
  {
	$sql="DELETE FROM `spareparts` WHERE `id_sp`=".$_POST['delete'];
	$result=mysqli_query($link, $sql) or die ("Query failed!");
	
	echo "Информация удалена!";
  }
 
 
  
    $sql="select * from spareparts, loco
	where id_l = type_loco
order by `name_sp` ASC";
	//echo $sql;
	$result=mysqli_query($link, $sql) or die ("Query failed!");
     if (mysqli_num_rows($result))  {
    echo "<h1>Список Запчастей</h1>";
	
    
	echo "";
	echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
	echo "<tr><th style='width:10%'>№</th><th>Название товара</th><th>Артикул</th><th>Тип локомотива</th><th>Количество на складе</th><th colspan='2'>Действия</th></tr>";
    
	$i=1;
	
    while ($myrow = mysqli_fetch_assoc($result)) {
	
		
	 echo "<tr>";
	
     echo "<td style='width:10%'>".$i."</td><td>".$myrow['name_sp']."</td><td>".$myrow['number']."</td><td>".$myrow['name_l']."</td><td>".$myrow['count_all']."</td><td>
	 <form method='post' action=''><input class='form-control' type='hidden' name='update' value='".$myrow['id_sp']."'>
	 ";
	 ?>
	 <button class="btn btn-primary" type='button' onclick="location.href='update_spareparts.php?id=<?php  echo  $myrow['id_sp'] ?>'"style='margin:10px auto;'>Изменить</button></form>	</td>
	 <?php 
	 echo "<td><form method='post' action=''><input class='form-control' type='hidden' name='delete' value='".$myrow['id_sp']."'><button class='btn btn-primary' type='submit' style='margin:10px auto;'>Удалить</button></form>	</td>";
	  echo "</tr>";
	 $i++;
	 
    }
	echo "</table>";
	
	
	
	
   }
   else
	echo "Список запчастей пуст!";
?>


  
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>
		