<?php

// Form control
$form_sent = false;
$form_error = false;

$error_message = "";


$csvcf7 = new CSVCF7_ContactForm();
$forms = $csvcf7->getForms();

$mailler = new CSVCF7_Mail();




if (isset($_REQUEST['save_options']) && $_REQUEST['save_options'] == 'Y') {

    $arquivo = $_FILES['_planilha_file'];

    $file = new File($arquivo,['csv']);

    if(!$file->validate()){

      $form_error = true;
      $error_message = "Somente arquivos CSV, por favor, verifique seu Arquivo";

    }else {
      //Se não houver um formulario selecionado, dispara um erro
      if( !isset($_POST['_form_name']) ){
        $form_error = true;
        $error_message = "Você não selecionou nenhum Formulario Contact form";

      }else {
        //From Form ID, get the object
        $form = $csvcf7->getForm($_POST['_form_name']);



        //Read CSV file
        $xml = new CSVCF7_CSV($arquivo);

        //Execute the format
        $xml->execute();

        //Insert into Database
        $db = new CSVCF7_DB();
        foreach ($xml->getContent() as $item) {

          /*Bloco para disparo de e-mail*/
          //Pega os dados de disparo do contact form
          $mail = get_post_meta($form['id'],'_mail',true);




          foreach ($item as $key => $value) {
            $mail['body'] = $csvcf7->replaceData($mail['body'],$key,$value);
          }





          //Pega o email FROM e assunto  do formulario
          $mail_from = $mail['recipient'];
          $mail_subject = $csvcf7->replaceSubject($mail['subject'],$item);
          $template = $mail['body'];



          $mailler->to($item['mail'])->from($mail_from)->subject($mail_subject)->setTemplate($template)->send($item);

          /*Bloco para disparo de e-mail*/

          //Insert into Database Plugin
          $db->insert($item,$xml->getHeader() ,$form['title']);
          # code...
        }
      }
    }




    //Get String and send to XML File



    $form_sent = true;
}






include "template/admin_html.php";
