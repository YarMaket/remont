<?php  require('header.php'); ?>
   
<script>

    var s = "";
	function check(){
	        
			var pr = document.getElementById('product').value;
			var v = Number(document.getElementById('ves').value);
			var cnt = Number(document.getElementById('product').getAttribute('data-count'));
			if (pr.length>0) {
			if (cnt>=v) {
				str="";
					
				
				//str=pr+' - '+v+'<br>';
				s+=pr+'='+v+';';
				document.getElementById('ingredients').innerHTML=s;
				document.getElementById('in_hidden').value=s;	
				document.getElementById('product').value="";
				document.getElementById('ves').value="";
				
			}
			else {
				alert('Количество на складе '+cnt+'!');
			}
			}	
		 }	
	</script>	
<script type="text/javascript">
  function getXmlHttp() {
    var xmlhttp;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false;
      }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }
  function change(id) {
    var xmlhttp = getXmlHttp(); // Создаём объект XMLHTTP
    xmlhttp.open('POST', 'spareparts.php', true); // Открываем асинхронное соединение
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Отправляем кодировку
    xmlhttp.send("id=" + encodeURIComponent(id)); // Отправляем POST-запрос
    xmlhttp.onreadystatechange = function() { // Ждём ответа от сервера
      if (xmlhttp.readyState == 4) { // Ответ пришёл
        if(xmlhttp.status == 200) { // Сервер вернул код 200 (что хорошо)
          var sup = JSON.parse(xmlhttp.responseText); // Преобразуем JSON-строку в массив
		 
          var text = ""; // Начинаем создавать элементы в select
          for (var i in sup) {
            /* Перебираем все элемены и создаём набор options */
			words = sup[i].split('@');
            text += "<li class='products_elemets' cnt='"+words[1]+"'>" + words[0] + "</li>";
          }
          document.getElementById('pr_list').innerHTML = text; 
        }
      }
    };
  }
</script>	


  <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Добавить ТО</h2>

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
	if ($_POST['save']!="")
  
  {
	$sql="INSERT INTO `repair`(`sotrudnik`, `typeloco`, `number_loco`, `comments`, `date_repair`,`type`) VALUES( '".$_SESSION['user']."','".$_POST['dirs']."','".$_POST['number']."','".$_POST['comment']."','".$_POST['date']."','".$_POST['type']."')";
	$result=mysqli_query( $link,$sql) or die ("Query failed!");
	$id_auto=mysqli_insert_id($link);

	if (isset($_POST['in_hidden'])){
		$products = explode(";", $_POST['in_hidden']);
		for ($i=0;$i<count($products)-1;$i++) {

			if ($products[$i]!="") {
			  $pr = explode("=",$products[$i]);
			  $pr2 = explode(". Артикул: ",$pr[0]);
			  $sql2="select id_sp from spareparts, loco
			  where id_l = type_loco
			  and `type_loco`=".$_POST['dirs']."
			  and `number` ='".$pr2[1]."'
			  and name_sp = '".$pr2[0]."'
			  order by `name_sp` ASC";
				//echo $sql2;
			  $result2 = mysqli_query ($link,$sql2) or die ("Query failed!");
			  if (mysqli_num_rows($result2)>0){
				  $rows=mysqli_fetch_assoc($result2);
				  $id=$rows['id_sp'];
			  }
			  
			  
			  $sql4="INSERT INTO `repair_spareparts`(`idr`, `idspa`, `count`) VALUES (".$id_auto.",".$id.",".$pr[1].")";
	  
			  $result4 = mysqli_query ($link,$sql4) or die ("Query failed4!");

			  $sql5="UPDATE `spareparts` SET `count_all`=`count_all`-".$pr[1]." WHERE `id_sp` = ".$id;
			  $result5 = mysqli_query ($link,$sql5) or die ("Query failed5!");
			  }
			  else
				  continue;
		  
		  }
		
	}
	
	echo "Информация добавлена!";
  }
 ?>
 
<?php  

	

?>
<div style = "margin:10px 8px auto;">
<div class="error"><?php  echo  $text; ?></div>
<form enctype="multipart/form-data" action="" method="post" id="myform">
<input class="form-control" type="hidden" name="save" value="1" />
<fieldset>
		  <legend>Информация</legend>
		    
		  <div class="form-group">
			<label>Выберите тип локомотива<span class="red">* </span></label>
			<?php 
			
			
			$sql="SELECT * FROM loco order by name_l ASC";
		//echo $sql;
			$result = mysqli_query($link,$sql) or die ("Query failed");
			$num=0;
			echo "<select class='form-control'  name='dirs' onchange='change(this.value)' required>";
				if (mysqli_num_rows($result)==0)
					echo "Локомотивы не найдены!";
				else {					 
					echo "<option disabled selected>Выберите тип локомотива</option>";
					while ($dirs=mysqli_fetch_assoc($result))	
						echo '<option value="'.$dirs['id_l'].'">'.$dirs['name_l'].'</option>';
				}	
				echo "</select>";
			    
			?>
			</div>
			<div class="form-group">
				<label for="ves">Тип обслуживания:</label>
					<select class='form-control'  name="type" required>
						<option value="Капитальный ремонт">Капитальный ремонт</option>
						<option value="Средний ремонт">Средний ремонт</option>
						<option value="Техническое обслуживание">Техническое обслуживание</option>
						<option value="Текущий ремонт">Текущий ремонт</option>
						<option value="Ремонт без затрат запчастей">Ремонт без затрат запчастей</option>
					</select>
			
			</div>
			<div class="form-group">
			<label>Номер локомотива(4 цифры)<span class="red">*</span></label><input class="form-control" type="number" name="number" min = "1000" max = "9999" <?php  if (isset($_POST['number'])) echo 'value="'.$_POST['number'].'"'?> required>
			</div>
			
			<div class="form-group">
			<label>Комментарий(до 100 символов)</label><br>
			<textarea name="comment" cols="60" maxlength = "100"><?php	if (isset($_POST['count'])) echo $_POST['count'];?></textarea>
			</div>			
			
			<div class="form-group">
			<label>Дата ремонта<span class="red">*</span></label><input class="form-control" type="date" name="date" min="2024-04-01"<?php  if (isset($_POST['date'])) echo 'value="'.$_POST['date'].'"'?> required>
			</div>
	
			
		</fieldset>

		<fieldset>
			<legend>Запчасти</legend>
			<div id="ingredients"></div>
			<div class="form-group">
				<label for="product">Название:</label>
				<input type="hidden" class="form-control" name="in_hidden" id="in_hidden" value="">
				<input type="text" class="form-control" name="product[]" data-list=".products_list" id="product" placeholder="114828" autocomplete="off" data-count="">
				<?php 
					$query = mysqli_query($link, "select * from spareparts, loco
					where id_l = type_loco
				order by `name_sp` ASC");
					echo "<ul class='products_list' id='pr_list'>";
					
							echo "</ul>";
				?>
			</div>
			<div class="form-group">
		<label for="ves">Количество:</label>
		<input type="number" class="form-control count" name="ves[]" id="ves" min="1" max="10">
	
	</div>
				<div id="elem">
				</div>
				<button type="button" class="btn btn-success" onclick="check()">Добавить</button>
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


</script>
<script type="text/javascript" src="js/jquery.hideseek.min.js"></script>		
<script>
	var i=1;
	function add(){
		document.getElementById('elem').insertAdjacentHTML('beforeend','<hr><div class="form-group"><label for="product">Название:</label><input type="text" class="form-control" name="product[]" id="product'+i+'" placeholder="114828"></div>');
		document.getElementById('elem').insertAdjacentHTML('beforeend', '<div class="form-group"><label for="ves">Количество:</label><input type="text" class="form-control count" name="ves[]" id="ves'+i+'"" placeholder="1"></div>');
		i++;
	}

</script>
<script>
	$('#product').hideseek({
		  highlight: true,
		  hidden_mode: true,
		  nodata: 'Ничего не найдено'
		});
		
	 $("#pr_list").on('click','li',function() {
	    $("#product").val($(this).text());
	   //$('.products_list').hide();
	   $('.products_elemets').hide();
	   $('#product').attr('data-count',$(this).attr('cnt'));
});	

</script>
 
<?php  require('footer.php'); ?>