<?php

require('core.php');
$contacts;
$types;
try{
 $con = conectarSF();
 $contacts = getContacts($con, null, null);
}
catch(Exception $e){
 print_r($e);
}
//echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
/*echo "<select><option />";
foreach($contacts as $c){
 echo "<option value='".$c->Id."'>".$c->fields->FirstName." ".$c->fields->LastName."</option>";
}
echo "</select>";*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
  <title>Abertura de <?php echo $_GET['opt'] == "changereq"? "Change Request" : "Incidente"; ?> - Prismah</title>
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <style type="text/css">
   .header{
   	vertical-align: 0px;
   	background-color: #EEEEEE;
   }
   .sucesso{
   	background-color: #005500;
   	color: #FFFFFF;
   	font-weight: bold;
    border:2px solid;
    border-radius:25px;
    width: 500px;
    height: 50px;
    vertical-align: center;
    box-shadow: 5px 5px 2.5px #888888;
   }
   .erro{
   	background-color: #660000;
   	color: #FFFFFF;
   	font-weight: bold;
   	border:2px solid;
    border-radius:25px;
    width: 500px;
    height: 50px;
    vertical-align: center;
    box-shadow: 5px 5px 2.5px #888888;
   }
  </style>
  <script type="text/javascript" src="script.js"></script>
 </head>
 <body>
  <div class="header">
   <img src="http://www.prismah.com.br/img/logotipo.png" />
  </div>
  <?php
   include("menu.php");
  ?>
  <br/>
  <div class="bg-success" style="display: <?php echo $_GET[sucesso]? '' : 'none'; ?>"><br />&nbsp;&nbsp;<?php echo $_GET['msg']; ?></div>
  <div class="bg-danger" style="display: <?php echo $_GET[sucesso] != null && $_GET['sucesso'] == 0? '' : 'none'; ?>"><br />&nbsp;&nbsp;<?php echo $_GET['msg']; ?></div>
  <div class="content">
  <?php
   if($_GET['opt'] == "changereq")
   	include("changereq.php");
   else
   	include("incidente.php");
  ?>
  </div>
 </body>
</html>