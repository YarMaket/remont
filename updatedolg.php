<?php  require('header.php'); ?>
   

  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Изменение должности</h2>

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
if ($_POST['save'])
		{
					 
		$sql3="UPDATE `doljnost` SET `name_dolj`='".$_POST['name']."' WHERE `id_dolj`=".$_POST['save'];
		//echo $sql3;	
		$result3 = mysqli_query ($link,$sql3) or die ("Query failed3!");
		$id_auto=mysqli_insert_id($link);
		
		
		echo "<p>Информация о должности обновлена!</p>";
		
		
		}
		
		$sql="SELECT * FROM `doljnost`
Order by `name_dolj` ASC";	
		//echo $sql;
		$result = mysqli_query($link, $sql) or die ("Query failed!");
		 if (mysqli_num_rows($result)>0){
		 
			$rows=mysqli_fetch_assoc($result);
		  }	
?>

<form method="post" action="">
 
  <input type="hidden" name="save" value="<?php  echo $rows['id_dolj']?>">
  <div class="form-group">
    <label for="name">Название должности</label>
    <textarea name="name" class="form-control" required><?php  echo $rows['name_dolj']?></textarea>
  </div>
   
  </fieldset>
  <button type="submit" class="btn btn-primary">Обновить</button>
</form>
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>