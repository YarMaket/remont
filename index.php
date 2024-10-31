<?php  require('header.php'); ?>
<div>
    
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>
			<?php  
				$sql2="SELECT * FROM `users`";
					$result2 = mysqli_query($link, $sql2) or die ("Query failed2!");
					 $cnt = mysqli_num_rows($result2);
				$sql2="SELECT * FROM `users` WHERE date(`date_reg`)=date_add(curdate(),INTERVAL - 0 DAY)";
					$result2 = mysqli_query($link, $sql2) or die ("Query failed2!");
					 $cnt2 = mysqli_num_rows($result2);	 
			?>	
            <div>Количество сотрудников</div>
            <div><?php  echo $cnt?></div>
            <span class="notification"><?php  echo $cnt2?></span>
        </a>
    </div>


    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="" class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>
			<?php  
				$sql2="SELECT sum(`count_all`) as sum FROM `spareparts` WHERE 1";
					$result2 = mysqli_query($link, $sql2) or die ("Query failed2!");
					 $cnt = mysqli_fetch_assoc($result2);
					 
			?>	
            <div>Запчасти на складе</div>
            <div><?php  echo $cnt['sum']?></div>
            <span class="notification yellow"></span>
        </a>
    </div>

   
</div>




<div class="row">

	
	    <div class="box col-md-8">
        <div class="box-inner">
           
            
        </div>
		
		<div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list"></i> Запчасти, которые нужно заказать</h2>

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
                <ul class="dashboard-list">
				    
					 <?php 
						$sql2="SELECT *
                        FROM `spareparts`
                        WHERE `count_all` <= 2
                        Order by `name_sp` ASC";
						$result2 = mysqli_query($link, $sql2) or die ("Query failed2!");
						$cnt2 = mysqli_num_rows($result2);	
					 
                        while ($rows=mysqli_fetch_assoc($result2)) {
                            echo '<li><i class="glyphicon glyphicon-chevron-down"></i>  '.$rows['name_sp'].'. Артикул: '.$rows['number'].'.Текущее количество: 
                            <span class="blue">'.$rows['count_all'].'</span>. </li>';
                            
                        }
                    
                    ?>

                    
                    
                </ul>
            </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->
<?php  require('footer.php'); ?>
