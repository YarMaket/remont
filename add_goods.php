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
<h1>Добавление запчасти</h1>

<?php 
		

	
	if ($_POST['new_post']==1)
		{
		$name=$_POST['name'];
		$count=$_POST['count'];
	
		
		
		
		$SQL = "INSERT INTO `spareparts`(`name_sp`, `number`, `type_loco`, `count_all`) 
    		VALUES 
		( '".$name."','".$_POST['number']."','".$_POST['dirs']."','".$_POST['count']."')";
		//echo $SQL;
		$result = mysqli_query($link,$SQL) or die ("Query failed-->".$SQL);
		
		$id = mysqli_insert_id($link);
		
		
		
		$text = "Запчасть '".$_POST['name']."' добавлена!";
		 
		}
?>
<div style = "margin:10px 8px auto;">
<div class="error"><?php  echo  $text; ?></div>
<form enctype="multipart/form-data" action="" method="post">
<input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="300000" />
<input class="form-control" type="hidden" name="new_post" value="1" />
<fieldset>
		  <legend>Информация о запчасте</legend>
		    <div class="form-group">
			<label>Название<span class="red">*</span></label><input class="form-control" type="text" name="name" <?php  if (isset($_POST['name'])) echo 'value="'.$_POST['name'].'"'?> required>
			</div>
			
			<div class="form-group">
			<label>Артикул<span class="red">*</span></label><input class="form-control" type="text" name="number" <?php  if (isset($_POST['number'])) echo 'value="'.$_POST['number'].'"'?> required>
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
					 while ($dirs=mysqli_fetch_assoc($result))	
						echo '<option value="'.$dirs['id_l'].'">'.$dirs['name_l'].'</option>';
			echo "</select>";
			?>
			</div>
			
			<div class="form-group">
			<label>Количество на складе<span class="red">*</span></label><input class="form-control" type="text" name="count" <?php  if (isset($_POST['count'])) echo 'value="'.$_POST['count'].'"'?> required>
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
		
  