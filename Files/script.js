function carregaSubTipo(valor){
 var campo = document.getElementById("subtipo");
 campo.disabled = false;
 campo.options.length = 0;
 if(valor == "Infraestrutura"){
  FillOpt(1, "subtipo", "Instalação e configuração de softwares", "Instalação e configuração de softwares", false);
  FillOpt(2, "subtipo", "Serviços de Impressão", "Serviços de Impressão", false);
  FillOpt(3, "subtipo", "Manutenção de equipamentos", "Manutenção de equipamentos", false);
  FillOpt(4, "subtipo", "Solicitação de equipamento", "Solicitação de equipamento", false);
  FillOpt(5, "subtipo", "Acesso a serviço", "Acesso a serviço", false);
  FillOpt(6, "subtipo", "Retirada de acesso a serviço", "Retirada de acesso a serviço", false);
  FillOpt(7, "subtipo", "Integração de colaborador", "Integração de colaborador", false);
  FillOpt(8, "subtipo", "Desligamento de colaborador", "Desligamento de colaborador", false);
  return;
 }
 else if(valor == "Telecom"){
  FillOpt(1, "subtipo", "Conexão com a Rede / Internet", "Conexão com a Rede / Internet", false);
  FillOpt(2, "subtipo", "Telefonia", "Telefonia", false);
  return;
 }
 else if(valor == "Desenvolvimento / Aplicações"){
  FillOpt(1, "subtipo", "Customer Care", "Customer Care", false);
  FillOpt(2, "subtipo", "PLE", "PLE", false);
  FillOpt(3, "subtipo", "Endeavour", "Endeavour", false);
  FillOpt(4, "subtipo", "PRP", "PRP", false);
  FillOpt(5, "subtipo", "SAP", "SAP", false);
  FillOpt(6, "subtipo", "Cardlytics", "Cardlytics", false);
  FillOpt(7, "subtipo", "Radar Prismah", "Radar Prismah", false);
  FillOpt(8, "subtipo", "Intranet DO", "Intranet DO", false);
 }
 else
  campo.disabled = true;
}

function validaFormIncidente(form){
 if(form.usuario.value == null){
  document.getElementById('erro').innerHTML = "É necessário selecionar seu nome na lista!";
  return false;
 }
 else if(trim(form.assunto.value).length < 10){
  document.getElementById('erro').innerHTML = "É necessário preencher uma descrição breve do seu problema!";
  return false;
 }
 else if(trim(form.descricao.value).length < 10){
  document.getElementById('erro').innerHTML = "É necessário preencher uma descrição detalhada do seu problema!";
  return false;
 }
 return true;
}

function FillOpt(indice, idSelect, valor, texto, selected){
 var select = document.getElementById(idSelect).options;
 select[indice] = new Option(texto, valor, false, selected);
}