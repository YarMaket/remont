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
<h1>Изменение запчасти</h1>

<?php 
		

	
	if ($_POST['update']==1)
		{
		$id=$_GET['id'];
		$name=$_POST['name'];
	
		
		
			$SQL = "UPDATE `spareparts` SET `name_sp`='".$name."',`number`='".$_POST['number']."',`type_loco`='".$_POST['dirs']."',`count_all`='".$_POST['count']."' WHERE `id_sp` = ".$id;
			
			
		
		//echo $SQL;
		$result = mysqli_query($link,$SQL) or die ("Query failed");
		$text = "Запчасть '".$_POST['name']."' изменена!";
		 
		}
?>
<div style = "margin:10px 8px auto;">
<div class="error"><?php  echo  $text; ?></div>
<form enctype="multipart/form-data" action="" method="post">
<input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="300000" />
<input class="form-control" type="hidden" name="update" value="1" />
<?php  
$result=mysqli_query($link,"select * from spareparts, loco
where id_l = type_loco and id_sp = ".$_GET['id']);
	$product = mysqli_fetch_assoc($result);
	

?>

<fieldset>
		  <legend>Информация о запчасте</legend>
		    <div class="form-group">
			<label>Название<span class="red">*</span></label><input class="form-control" type="text" name="name" <?php  echo  'value="'.$product['name_sp'].'"'?> required>
			</div>
			
			<div class="form-group">
			<label>Артикул<span class="red">*</span></label><input class="form-control" type="text" name="number" <?php   echo 'value="'.$product['number'].'"'?> required>
			</div>
			 
			<div class="form-group">
			<label>Тип локомотива<span class="red">*</span></label>
			<?php 
			$sql="SELECT * FROM loco order by name_l ASC";
		//echo $sql;
			$result = mysqli_query($link,$sql) or die ("Query failed");
			$num=0;
			echo "<select class='form-control'  name='dirs'>";
				if (mysqli_num_rows($result)==0)
					echo "Локомотивы не найдены!";
				else 
					 while ($dirs=mysqli_fetch_assoc($result))	{
						if ($dirs['id_l'] == $product['type_loco'])
							echo '<option value="'.$dirs['id_l'].'" selected>'.$dirs['name_l'].'</option>';
						else	
							echo '<option value="'.$dirs['id_l'].'">'.$dirs['name_l'].'</option>';
					 }	
			echo "</select>";
			?>
			</div>
			
			<div class="form-group">
			<label>Количество на складе<span class="red">*</span></label><input class="form-control" type="text" name="count" <?php   echo 'value="'.$product['count_all'].'"'?> required>
			</div>
			
			
			
			
			
		</fieldset>


	<div class="center">
		<button class="btn btn-primary" type="submit" id="send">Отправить</button>
		<button class="btn btn-primary" type="reset">Сброс</button>
	</div>	
		
</form>

</div>

  
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>
		

  