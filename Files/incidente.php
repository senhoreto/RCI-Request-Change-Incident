<?php
$types = getTypePicklist($con, 'inc');
?>
<form enctype="multipart/form-data" method="post" name="incidenteform" id="incidenteform" class="form-horizontal" role="form" action="actions.php?tipo=incidente">
   <legend><h2>Bem-vindo ao suporte da Prismah</h2></legend>
   <fieldset>
    <div class="form-group">
     <label for="usuario" class="col-sm-2 control-label">Nome do solicitante</label>
     <div class="col-sm-10">
     <select name="usuario" id="usuario" size="1" placeholder="Usuario" required="true">
      <option/>
      <?php
      foreach($contacts as $c){
       echo "<option value='".$c->Id."|".$c->AccountId."'>".$c->fields->FirstName." ".$c->fields->LastName."</option>";
      }
      ?>
     </select>
     </div>
    </div>
    <div class="form-group">
     <label for="tipo" class="col-sm-2 control-label">Categoria da solicitação</label>
     <div class="col-sm-10">
     <select name="tipo" id="tipo" size="1" placeholder="Tipo" onchange="carregaSubTipo(this.value);">
      <option/>
      <?php
      foreach($types as $t){
       echo "<option value='$t'>$t</option>";
      }
      ?>
     </select>
     </div>
    </div>
    <div class="form-group">
     <label for="subtipo" class="col-sm-2 control-label">Sub-categoria da solicitação</label>
     <div class="col-sm-10">
     <select name="subtipo" id="subtipo" size="1" placeholder="Sub-tipo" disabled="true">
     </select>
     </div>
    </div>
    <div class="form-group">
     <label for="resumo" class="col-sm-2 control-label">Resumo da solicitação</label>
     <div class="col-sm-10">
     <input type="text" maxlength="80" id="assunto" name="assunto" size="25" required="true"/>
     </div>
    </div>
    <div class="form-group">
     <label for="descricao" class="col-sm-2 control-label">Descrição detalhada</label>
     <div class="col-sm-10">
     <textarea id="descricao" name="descricao" required="true" rows="5" cols="27"></textarea>
     </div>
    </div>
    <div class="form-group">
     <label class="col-sm-2 control-label">Anexo</label>
     <div class="col-sm-10">
     <input type="file" id="anexo" name="anexo"/>
     </div>
    </div>
    <div class="form-group">
     <div class="col-sm-2 control-label"></div>
     <div class="col-sm-10">
      <input type="submit" class="pure-button pure-button-active" value="Enviar" />
     </div>
    </div>
   </fieldset>
  </form>