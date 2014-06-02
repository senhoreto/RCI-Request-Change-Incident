<?php
$types = getTypePicklist($con, 'changereq');
?>
<form enctype="multipart/form-data" method="post" name="changeform" id="changeform" class="form-horizontal" action="actions.php?tipo=changereq">
 <legend><h2>Bem-vindo ao suporte da Prismah</h2></legend>
 <fieldset>
  <!--<div class="pure-g">-->
   <div class="form-group">
    <label class="col-sm-2 control-label" for="usuario">Nome do solicitante</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="usuario" required="true" id="usuario" placeholder="Solicitante">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="empresa">Empresa solicitante</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="empresa" required="true" id="empresa" placeholder="Empresa">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="email">Email do solicitante</label>
    <div class="col-sm-10">
    <input type="email" size="25" name="email" required="true" id="email" placeholder="Email">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="telefone">Telefone de contato</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="telefone" id="telefone" required="true" placeholder="Telefone">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="classificacao">Classificação da mudança</label>
    <div class="col-sm-10">
    <select name="classificacao" id="classificacao" size="1" required="true">
     <option></option>
     <option value="Programada">Programada</option>
     <option value="Emergencial">Emergencial</option>
    </select>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="dataPrev">Data prevista da Execução</label>
    <div class="col-sm-10">
    <input type="date" size="25" name="dataPrev" id="dataPrev" required="true" placeholder="DD/MM/YYYY">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="tempo">Tempo de Execução</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="tempo" id="tempo" required="true" placeholder="Tempo">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="tipoAlteracao">Tipo de alteração</label>
    <div class="col-sm-10">
    <select name="tipoAlteracao" id="tipoAlteracao" size="1" required="true">
     <option></option>
     <option value="Alteração devido a Falha na aplicação">Alteração devido a falha na aplicação</option>
     <option value="Alteração devido a melhoria na aplicação">Alteração devido a melhoria na aplicação</option>
    </select>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="tipo">Tipo de Mudança</label>
    <div class="col-sm-10">
    <select name="tipo" id="tipo" size="1" required="true" placeholder="Tipo">
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
    <label class="col-sm-2 control-label" for="aplicacao">Aplicação Envolvida</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="aplicacao" id="aplicacao" placeholder="Aplicação">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="description">Descrição Detalhada</label>
    <div class="col-sm-10">
    <textarea name="description" id="description" required="true" cols="27" rows="5"></textarea>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="planoMudanca">Plano de Mudança</label>
    <div class="col-sm-10">
    <textarea name="planoMudanca" id="planoMudanca" required="true" cols="27" rows="5"></textarea>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="recursos">Recursos necessários</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="recursos" id="recursos" placeholder="Recursos">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="prereq">Pré-Requisitos da Mudança</label>
    <div class="col-sm-10">
    <input type="text" size="25" name="prereq" id="prereq" placeholder="Pré-requisitos">
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="validacoes">Validações</label>
    <div class="col-sm-10">
    <textarea name="validacoes" id="validacoes" required="true" cols="27" rows="5"></textarea>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="planoRetorno">Plano de retorno</label>
    <div class="col-sm-10">
    <textarea name="planoRetorno" id="planoRetorno" required="true" cols="27" rows="5"></textarea>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="riscos">Riscos Envolvidos</label>
    <div class="col-sm-10">
    <textarea name="riscos" id="riscos" cols="27" rows="5"></textarea>
    </div>
   </div>
   <div class="form-group">
    <label class="col-sm-2 control-label" for="anexo">Anexo</label>
    <div class="col-sm-10">
    <input type="file" name="anexo" id="anexo" size="25" />
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