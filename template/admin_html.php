<style>
  .file {
    text-align: center;
  }


</style>

<script>
  var isDisabled = true;
  jQuery(document).ready(function(){

  });

</script>
<div class='wrap'>



  <hr/>


  <!-- Formulario para importar a planilha -->
  <form enctype="multipart/form-data" class="admin-wrap admin-main" name="adm-main-form" method="post" action="">
    <input type="hidden" name="save_options" value="Y" >

    <h1><?php _e('Importação de Planilha para o Contact Form ', 'unius'); ?></h1>

    <?php if ($form_sent & $form_error === false): ?>
        <div class="is-dismissible updated">
          <p class="form-feedback"><?php _e('Alterações salvas com sucesso!', 'template'); ?></p>
        </div>
    <?php endif; ?>

    <?php if($form_error) : ?>
        <div class="is-dismissible error">
          <p class=""><?php echo $error_message; ?></p>
        </div>
    <?php endif;?>


    <?php if(count($forms) === 0) : ?>

      <div class="is-dismissible error">
        <p class="">Você não tem nenhum formulario</p>
      </div>

    <?php else : ?>

      <p class="file">
        <label for="_form_name"><strong><?php _e('Selecione o Formulario', 'unius'); ?></strong></label><br>
        <select name='_form_name'>
          <?php foreach($forms as $form) : ?>
            <option value="<?php echo $form['id'];?> "><?php echo $form['title']; ?></option>
          <?php endforeach;?>
        </select>
      </p>

    <?php endif; ?>


    <p class="file">
        <label for="_planilha_file"><strong><?php _e('Importe sua planilha em CSV', 'unius'); ?></strong></label><br>
        <input type="file" name="_planilha_file" id='_planilha_file'>
    </p>



    <hr>
    <!-- <p class="submit"><button class='button' type="submit"><?php _e('Salvar', '42i'); ?></button></p> -->
    <?php submit_button(); ?>
</form><!-- Formulario para importar a planilha -->
<!-- .admin-wrap -->
</div>
