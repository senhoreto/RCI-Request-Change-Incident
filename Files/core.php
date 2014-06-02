<?php
ini_set('soap.wsdl_cache_enabled', '0');

/*SANDBOX*/
define('SF_USER', 'interface@prismah.com.br.teste');
define('SF_PASS', 'Pr15mah@2014d38PEBSbhrFEmJB10kCGTvk2K');

/*PRODUÇÃO
define('SF_USER', 'interface@prismah.com.br.teste');
define('SF_PASS', 'Pr15mah@2014P2dk6tnC2a77lh6CHgMfqLVyR');
*/

define('SOAP_CLIENT_BASEDIR', 'soapclient');
require_once (SOAP_CLIENT_BASEDIR.'/SforcePartnerClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');

function conectarSF(){
 try {
  $mySforceConnection = new SforcePartnerClient();
  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/partner.sandbox.wsdl.xml');
  $mylogin = $mySforceConnection->login(SF_USER, SF_PASS);
  return $mySforceConnection;
 } catch (Exception $e) {
  print_r($e);
 }
 return $mylogin;
}

function getContacts($connection, $firstName, $lastName){
 $query = "SELECT Id, LastName, FirstName, AccountId FROM Contact WHERE Account.Name = 'Prismah' AND RecordType.DeveloperName = 'Funcionario'";
 $query .= $firstName != null? " AND FirstName LIKE '$firstName'" : "";
 $query .= $lastName != null? " AND LastName LIKE '$lastName'" : "";
 $query .= " ORDER BY FirstName";
 //print_r($query);
 try{
  $result = $connection->query($query);
  $contacts;
  if(!$result->records){
   print_r("Funcionário não encontrado!");
   return null;
  }
  //print_r($result->records);
  for($i = 0; $i < sizeOf($result->records); $i++){
   $contacts[$i] = new SObject($result->records[$i]);
  }
  return $contacts;
 }
 catch(Exception $e){
  print_r($e);
 }
}

function getTypePicklist($connection, $type){
 $object = $connection->describeSObject('Case');
 foreach($object->fields as $f){
  //print_r($f->name);
  //break;
  $retorno = [];
  if($f->name == 'Type'){
   foreach($f->picklistValues as $v){
   	if($type == 'inc'){
   	 if($v->value == "Infraestrutura" || $v->value == "Telecom" || $v->value == "Desenvolvimento / Aplicações" || $v->value == "Outro")
      $retorno[] = $v->value;
   	}
   	else {
     if($v->value == "Hardware" || $v->value == "Aplicação" || $v->value == "Rede" || $v->value == "Banco de dados" || $v->value == "Sistema Operacional" || $v->value == "Outro")
      $retorno[] = $v->value;
   	}
    //print_r($v);
   }
   return $retorno;
   //print_r($f->picklistValues);
   break;
  }
 }
}

function criarIncidente($dadosPost, $connection){
 $ids = explode("|", $_POST['usuario']);
 $createFields = array (
  'ContactId' => $ids[0],
  'Type' => $_POST['tipo'],
  'Sub_tipo__c' => $_POST['subtipo'],
  'Subject' => $_POST['assunto'],
  'Description' => $_POST['descricao'],
  'Anexo__c' => '',
  'AccountId' => $ids[1],
  'RecordTypeId' => ''
 );
 $sObject1 = new SObject();
 //$sObject1->fields = $createFields;
 $sObject1->type = 'Case';
 try{
  $query = "SELECT Id FROM RecordType WHERE SObjectType = 'Case' AND DeveloperName = 'Incidente_HelpDesk'";
  $recTypeRes = $connection->query($query);
  $recType = new SObject($recTypeRes->records[0]);
  $createFields['RecordTypeId'] = $recType->Id;

  //$ext = substr($_FILES['anexo']['name'], strlen($_FILES['anexo']['name'])-3, strlen($_FILES['anexo']['name']));
  if($_FILES['anexo']['name'] != null){
   $arq1 = $ids[0].$_FILES['anexo']['name'];
   $arq1_tmp = $_FILES['anexo']['tmp_name'];
   move_uploaded_file($arq1_tmp,"anexos/".$arq1);
  
   $fullFilePath = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."anexos/".$arq1;
   $fullFilePath = str_replace("actions.php?tipo=incidente", "", $fullFilePath);
   $createFields['Anexo__c'] = $fullFilePath;
  }
  $sObject1->fields = $createFields;
  $createResponse = $connection->create(array($sObject1));
 }
 catch(Exception $e){
  print_r($e);
  header("Location: index.php?sucesso=0&msg=Ocorreu um erro ao inserir o incidente!".$e); 
 }
 header("Location: index.php?sucesso=1&msg=Incidente inserido com sucesso!");
}


function criarChange($dadosPost, $connection){
 $createFields = array (
  'SuppliedName' => $_POST['usuario'],
  'SuppliedCompany' => $_POST['empresa'],
  'SuppliedPhone' => $_POST['telefone'],
  'SuppliedEmail' => $_POST['email'],
  'Classificacao_da_mudanca__c' => $_POST['classificacao'],
  'Data_da_Execucao__c' => $_POST['dataPrev'],
  'Subject' => $_POST['tipo'] . " - " . $_POST['aplicacao'],
  'Description' => $_POST['description'],
  'Tempo_de_execucao__c' => $_POST['tempo'],
  'Tipo_de_alteracao__c' => $_POST['tipoAlteracao'],
  'Type' => $_POST['tipo'],
  'Aplicacao__c' => $_POST['aplicacao'],
  'Plano_de_mudanca__c' => $_POST['planoMudanca'],
  'Recursos_necessarios__c' => $_POST['recursos'],
  'Prerequisitos_da_mudanca__c' => $_POST['prereq'],
  'Validacoes__c' => $_POST['validacoes'],
  'Plano_de_retorno__c' => $_POST['planoRetorno'],
  'Riscos_Envolvidos__c' => $_POST['riscos'],
  'RecordTypeId' => ''
 );
 $sObject1 = new SObject();
 //$sObject1->fields = $createFields;
 $sObject1->type = 'Case';
 try{
  $query = "SELECT Id FROM RecordType WHERE SObjectType = 'Case' AND DeveloperName = 'Change_Request'";
  $recTypeRes = $connection->query($query);
  $recType = new SObject($recTypeRes->records[0]);
  $createFields['RecordTypeId'] = $recType->Id;

  if($_FILES['anexo']['name'] != null){
   $arq1 = date('YmdHis').$_FILES['anexo']['name'];
   $arq1_tmp = $_FILES['anexo']['tmp_name'];
   move_uploaded_file($arq1_tmp,"anexos/".$arq1);
  
   $fullFilePath = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."anexos/".$arq1;
   $fullFilePath = str_replace("actions.php?tipo=changereq", "", $fullFilePath);
   $createFields['Anexo__c'] = $fullFilePath;
  }

  $sObject1->fields = $createFields;
  $createResponse = $connection->create(array($sObject1));
 }
 catch(Exception $e){
  print_r($e);
  header("Location: index.php?opt=changereq&sucesso=0&msg=Ocorreu um erro ao inserir o change request!".$e); 
 }
 header("Location: index.php?opt=changereq&sucesso=1&msg=Change Request inserido com sucesso!");
}

?>