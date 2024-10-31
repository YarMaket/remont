<?php  require('header.php'); ?>
   <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i>Список</h2>

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
 
 
 
  
    $sql="SELECT * FROM `repair`,users,loco 
    WHERE `typeloco`=id_l
    and `sotrudnik` = id
    ORDER BY `date_repair` DESC";
	//echo $sql;
	$result=mysqli_query($link, $sql) or die ("Query failed!");
     if (mysqli_num_rows($result))  {
    echo "<h1>Список ремонтов и ТО</h1>";
	
    
	echo "";
	echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
	echo "<tr><th style='width:10%'>№</th><th>Тип ремонта</th><th>Тип локомотива</th><th>Номер</th><th>Сотрудник</th><th>Дата</th><th>Комментарий</th><th colspan='2'>Запчасти</th></tr>";
    
	$i=1;
	
    while ($myrow = mysqli_fetch_assoc($result)) {
	  $lists="";
        $sql2 = "SELECT * FROM `spareparts`, repair_spareparts WHERE 
        `id_sp` = `idspa`
        and `idr` = ".$myrow['id_r'];
        $result2=mysqli_query($link, $sql2) or die ("Query2 failed!");
        if (mysqli_num_rows($result2))  {
            $lists =  '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable"><tr><th>Запчасть</th><th>Количество</th></tr>';
            while ($row = mysqli_fetch_assoc($result2)) {
                $lists.= "<tr>";
                $lists.= "<td>".$row['name_sp'].". Артикул: ".$row['number']."</td>";
                $lists.= "<td>".$row['count']."</td>";
                $lists.= "</tr>";  
            }   
            $lists.=  "</table>";

        }


	 echo "<tr>";
	
     echo "<td style='width:10%'>".$i."</td><td>".$myrow['type']."</td><td>".$myrow['name_l']."</td><td>".$myrow['number_loco']."</td><td>".$myrow['fio']."</td><td>".date("d.m.Y",strtotime($myrow['date_repair']))."</td><td>".$myrow['comments']."</td><td>".$lists."</td>";
	  echo "</tr>";
	 $i++;
	 
    }
	echo "</table>";
	
	
	
	
   }
   else
	echo "Список пуст!";
?>


  
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>
		