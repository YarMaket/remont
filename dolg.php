<?php  require('header.php'); ?>
   

  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Все должности</h2>

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
	$sql="DELETE FROM `doljnost` WHERE `id_dolj`=".$_POST['delete'];
	$result=mysqli_query( $link,$sql) or die ("Query failed!");
	
	
	
	echo "Запись удалена!";
  }
 ?>
 <button type='button' class="btn btn-primary" onclick="location.href='adddolg.php#center'"style='margin:10px auto;'><i class="glyphicon glyphicon-edit glyphicon-white"></i> Добавить должность</button><br><br>
<?php 
	$sql="SELECT * FROM `doljnost`
Order by `name_dolj` ASC";	
		//echo $sql;
		$result = mysqli_query($link, $sql) or die ("Query failed!");
		 if (mysqli_num_rows($result)>0){
		 $i=1;
		  echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
			echo "<tr><th>№</th><th>Название</th><th colspan='2'>Действие</th></tr>";
			while ($rows=mysqli_fetch_assoc($result)) {
				
				echo "<tr><td>".$i."</td><td>".$rows['name_dolj']."</td>";
				
				?>
	 <td>
	 <form method='post' action=''><button type='button' class="btn btn-primary btn-info" onclick="location.href='updatedolg.php?id=<?php echo $rows['id_dolj'] ?>#center'"style='margin:10px auto;'>Изменить</button></form></td>
	 <?php 
	 echo "<td><form method='post' action=''><input type='hidden' name='delete' value='".$rows['id_dolj']."'><button type='submit' class='btn btn-primary btn-danger' style='margin:10px auto;'>Удалить</button></form></td></tr>";
			$i++;
			} 
		echo "</table>";
		}
		 else
			echo "Записей нет!";

	
?>

                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>

  