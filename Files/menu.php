<div class="pure-menu pure-menu-open pure-menu-horizontal">
 <ul>
  <li <?php echo !$_GET['opt']? "class='pure-menu-selected'":"" ?>><a href="index.php">Nova solicitação</a></li>
  <li <?php echo $_GET['opt']=="changereq"? "class='pure-menu-selected'":"" ?>><a href="index.php?opt=changereq">Novo change request</a></li>
 </ul>
</div>