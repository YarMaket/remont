<?php  require('header.php'); ?>
   

  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Добавление должности</h2>

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
					 
		$sql3="INSERT INTO `doljnost`(`name_dolj`) VALUES ('".$_POST['name']."')";
		//echo $sql3;	
		$result3 = mysqli_query ($link,$sql3) or die ("Query failed3!");
		$id_auto=mysqli_insert_id($link);
		
		
		echo "<p>Информация о должности добавлена!</p>";
		
		
		}
?>

<form method="post" action="">
 
  <input type="hidden" name="save" value="1">
  <div class="form-group">
    <label for="name">Название должности</label>
    <textarea name="name" class="form-control" required></textarea>
  </div>
   
  </fieldset>
  <button type="submit" class="btn btn-primary">Добавить</button>
</form>
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>