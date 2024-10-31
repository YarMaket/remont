<?php @session_start();
//echo strpos($_SERVER['REQUEST_URI'], 'admin/login.php')."--";

if($_SESSION['name']=="" && strpos($_SERVER['REQUEST_URI'], 'login.php')===false)
{
?>	
<script>

window.open("login.php","_self");

</script>
<?php }

?>
			
<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="ru">
<head>
   
    <meta charset="utf-8">
    <title>Ремонт железнодорожных составов</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cybrog.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
	
	 

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="width: auto;" href="index.php"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span>ТО</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $_SESSION['name']?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="divider"></li>
                    <li><a href="logout.php">Выход</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Смена темы</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Классическая</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Темная</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> Объединенная</a></li>
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="/"><i class="glyphicon glyphicon-globe"></i> </a></li>
                
                
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Главное меню</li>
                        <li><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span> Главная страница</span></a>
                        </li>
						<?php
						if ($_SESSION['role']==1)
							{
								?>
						<li><span> Справочники</span></a>
                        </li>
						
								<li class="accordion">
									<a href="sotrudniki.php"><i class="glyphicon glyphicon-user"></i><span> Сотрудники</span></a>
									<ul class="nav nav-pills nav-stacked">
										<li><a href="add_sotr.php">Добавить</a></li>
										<li><a href="sotrudniki.php">Просмотр</a></li>
									</ul>
								</li>
								
								
						<li class="accordion">
                            <a href="dolg.php"><i class="glyphicon glyphicon-lock"></i><span> Должности</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="adddolg.php">Добавить</a></li>
                                <li><a href="dolg.php">Просмотр</a></li>
                            </ul>
                        </li>
						
						
						
						<li class="accordion">
                            <a href="ed.php"><i class="glyphicon glyphicon-lock"></i><span> Локомотивы</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="add.php">Добавить</a></li>
                                <li><a href="show.php">Просмотр</a></li>
                            </ul>
                        </li>
						
						

						
								
                        <li class="accordion">
                            <a href="lists.php"><i class="glyphicon glyphicon-lock"></i><span> Каталог запчастей</span></a>
                            <ul class="nav nav-pills nav-stacked">
								
								<li><a href="add_goods.php">Добавить</a></li>
								<li><a href="lists.php">Список запчастей</a></li>

                            </ul>
                        </li>
						
						
						
                        <li><span> Действия</span></a>
                        </li>
						 <li class="accordion">
                            <a href="lists.php"><i class="glyphicon glyphicon-lock"></i><span>Техническое обслуживание и ремонт</span></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="add_repair.php">Добавить данные</a></li>
								<li><a href="repair_lists.php">Список</a></li>

                            </ul>
                        </li>
						
						
						
						
						
                        
						

                     
							<?php
							
							
							}
						?>
						 <?php 
						if ($_SESSION['role']==2)
							{
								?>
								
								<!-- <li><span> Справочники</span></a> 
								  <li class="accordion">
                            <a href="lists.php"><i class="glyphicon glyphicon-lock"></i><span> Каталог запчастей</span></a>
                            <ul class="nav nav-pills nav-stacked">
								
								 <li><a href="add_goods.php">Добавить</a></li>
								<li><a href="lists.php">Список запчастей</a></li>

                            </ul>
                        </li>  -->
									<li><span> Действия</span></a>
                        </li>
						 <li class="accordion">
                            <a href="lists.php"><i class="glyphicon glyphicon-lock"></i><span>Техническое обслуживание и ремонт</span></a>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="add_repair.php">Добавить данные</a></li>
								<!-- <li><a href="repair_lists.php">Список</a></li> -->

                            </ul>
                        </li>
						
								<?php
							
							
							}
						?>
                       

                        <li><a href="login.php"><i class="glyphicon glyphicon-lock"></i><span> Выйти</span></a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->
 <?php 
        }

        ?>
        

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
       
