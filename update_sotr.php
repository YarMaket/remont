<?php  require('header.php'); ?>
   

  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Изменение сотрудника</h2>

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
if ($_POST['save']==1)
		{
		
			
			$sql3="UPDATE `users` SET `fio`='".$_POST['label']."',`login`='".$_POST['login']."',`pass`='".$_POST['password']."',`email`='".$_POST['adress']."',`role`='".$_POST['role']."',`phone`='".$_POST['phone']."' WHERE `id` = ".$_GET['id'];
			
		//echo $sql3;	
		$result3 = mysqli_query ($link,$sql3) or die ("Query failed3!");
		$id=$_GET['id'];
		
		$sql2="DELETE FROM `sotr_dolj` WHERE `ids`=".$_GET['id'];
		$result2 = mysqli_query ($link,$sql2) or die ("Query failed2!");
		foreach ($_POST['dolj'] as $selectedOption)
			{
				$sql2="INSERT INTO `sotr_dolj`(`ids`, `idd`) VALUES ('".$id."','".$selectedOption."')";
				$result = mysqli_query ($link,$sql2) or die ("Query failed!");
			}
			
		echo "<p>Информация изменена!</p>";
		
		
		}
?>
<?php 
	$sql="SELECT * FROM `users` 
	where id=".$_GET['id']."";	
		//echo $sql;
		$result = mysqli_query($link, $sql) or die ("Query failed!->".$sql);
		$rows=mysqli_fetch_assoc($result);
?>
<form enctype="multipart/form-data" action="" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
 
  <input type="hidden" name="save" value="1">
  <div class="form-group">
    <label for="label">ФИО</label><br>
    <input type="text" name="label" class="form-control" value="<?php  echo $rows['fio'] ?>" required>
  </div>
  <div class="form-group">
    <label for="label">Телефон</label><br>
    <input type="text" name="phone" class="form-control" value="<?php  echo $rows['phone'] ?>"required>
  </div>
 <div class="form-group">
    <label for="label">e-mail</label><br>
    <input type="text" name="adress" class="form-control" value="<?php  echo $rows['email'] ?>">
  </div>
  
  <div class="form-group">
    <label for="label">Должности</label><br>
    <select multiple name="dolj[]" class="form-control" required>
	<?php 
	$sql2="SELECT * FROM `doljnost`
Order by `name_dolj` ASC";	
		//echo $sql;
		$result2 = mysqli_query($link, $sql2) or die ("Query failed2!");
		 if (mysqli_num_rows($result2)>0){
		 $i=1;
		  
			while ($rows2=mysqli_fetch_assoc($result2)) {
			  $sql3="SELECT * FROM `sotr_dolj`,`doljnost`
				Where `idd`=id_dolj and ids=".$_GET['id']." and idd=".$rows2['id_dolj']."
				Order by `name_dolj` ASC";
			  $result3 = mysqli_query($link, $sql3) or die ("Query failed3!");
				if (mysqli_num_rows($result3)>0)
					echo "<option selected value=".$rows2['id_dolj'].">".$rows2['name_dolj']."</option>";
				else
					echo "<option value=".$rows2['id_dolj'].">".$rows2['name_dolj']."</option>";
			}
		}			
				?>
	</select>			
	
  </div>
  
  <div class="form-group">
    <label for="label">Логин</label><br>
    <input type="text" name="login" class="form-control" value="<?php  echo $rows['login'] ?>">
  </div>
  <div class="form-group">
    <label for="label">Пароль</label><br>
    <input type="text" name="password" class="form-control" value="<?php  echo $rows['pass'] ?>">
  </div>
  
  <div class="form-group">
    <label for="status">Роль в системе</label>
	<select name="role" class="form-control">
			<option value="1">Администратор</option>
			<option value="2">Сотрудник</option>

   </select>
  </div>
  
   
  <button type="submit" class="btn btn-primary">Изменить</button>
</form>

  
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>
		





  