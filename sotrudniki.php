<?php  require('header.php'); ?>
   

  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Сотрудники</h2>

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
	$sql="DELETE FROM `users` WHERE `id` = ".$_POST['delete'];
	$result=mysqli_query( $link,$sql) or die ("Query failed!");
	
	
	
	echo "Запись удалена!";
  }
 ?>
 <button type='button' class="btn btn-primary" onclick="location.href='add_sotr.php#center'"style='margin:10px auto;'>Добавить</button><br><br>
<?php 
	$sql="SELECT * FROM `users`
	where role!=3
Order by `fio` ASC";	
		//echo $sql;
		$result = mysqli_query($link, $sql) or die ("Query failed!");
		 if (mysqli_num_rows($result)>0){
		 $i=1;
		 
		  echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
			echo "<tr><th>№</th><th>ФИО</th><th>Телефон</th><th>e-mail</th><th>Логин</th><th>Пароль</th><th>Дата регистрации</th><th>Должность</th><th>Роль</th><th colspan='2'>Действие</th></tr>";
			while ($rows=mysqli_fetch_assoc($result)) {
			
			 $dolj="";
			 $sql2="SELECT * FROM `sotr_dolj`,`doljnost`
Where `idd`=id_dolj and ids=".$rows['id']."
Order by `name_dolj` ASC";
			 $result2 = mysqli_query($link, $sql2) or die ("Query failed2!");
				if (mysqli_num_rows($result2)>0){
					while ($rows2=mysqli_fetch_assoc($result2))
						$dolj.=$rows2['name_dolj']."<br>";
				}
				$role = 'Сотрудник';
					if ($rows['role']==1)
						$role = "Администратор";
					if ($rows['role']==2)
						$role = "Сотрудник";	
				echo "<tr><td>".$i."</td><td>".$rows['fio']."</td><td>".$rows['phone']."</td><td>".$rows['email']."</td><td>".$rows['login']."</td><td>".$rows['pass']."</td><td>".date("d.m.Y",strtotime($rows['date_reg']))."</td><td>".$dolj."</td><td>".$role."</td>";
				
				?>
	 <td>
	 <form method='post' action=''><button type='button' class="btn btn-primary" onclick="location.href='update_sotr.php?id=<?php echo $rows['id'] ?>#center'"style='margin:10px auto;'>Изменить</button></form></td>
	 <?php 
	 echo "<td><form method='post' action=''><input type='hidden' name='delete' value='".$rows['id']."'><button type='submit' class='btn btn-primary' style='margin:10px auto;'>Удалить</button></form></td></tr>";
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