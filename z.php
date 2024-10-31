<?php  require('header.php'); ?>
   

  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Список заявок от клиентов</h2>

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

function status($n){
switch ($n) {
	case 1: return "На рассмотрении"; break;
	case 2: return "В работе"; break;
	case 3: return "Заявка отменена"; break;
	case 4: return "Готов"; break;
}

}

 
     $sql="SELECT zayvka.id_r as id_or, idorg,number, `date_z`,`status`, (select fio from users where id = id_s) as fio,comment  
	 FROM zayvka
Order by `date_z` DESC";
	//echo $sql;
	$result=mysqli_query($link, $sql) or die ("Query failed!");
     if (mysqli_num_rows($result))  {

    

	echo '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive dataTable">';
	echo "<tr><th style='width:5%'>№</th><th style='width:10%'>Номер заказа</th><th>Заказчик</th><th>Комментарий</th><th>Дата</th><th>Сотрудник</th><th>Статус</th></tr>";
    
	$i=1;
	$sum=0;
    while ($myrow = mysqli_fetch_assoc($result)) {
	$sql_2 = "SELECT `FIO` FROM `client` WHERE `id_cl`=".$myrow['idorg'];
	//echo $sql_2;
	$result_2 = mysqli_query($link,$sql_2) or die ("Query failed 2!-->".$sql_2);
	$users = mysqli_fetch_assoc($result_2);
	
	
	$date=date("d.m.Y H:i:s",strtotime($myrow['date_z']));
	
	 echo "<tr>";
	
     echo "<td style='width:15%'>".$i."</td><td>".$myrow['number']."</td><td>".$users['FIO']."</td><td>".$myrow['comment']."</td><td>".$date."</td><td>".$myrow['fio']."</td><td>".status($myrow['status'])."</td>
	 ";
	
	  echo "</tr>";
	 
	
	 $i++;
    }
	echo "</table>";
	

	
	
   }
   else
	echo "Список заказов пуст!";
 
 
?>


  
                </div>
                
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


 
<?php  require('footer.php'); ?>