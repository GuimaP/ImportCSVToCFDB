<?php

  class CSVCF7_Mail {
    private $to;
    private $from;
    private $subject;
    private $template;

    public function to($to){
      $this->to = $to;
      return $this;
    }

    public function from($from){
      $this->from = $from;
      return $this;
    }

    public function subject($subject){
      $this->subject = $subject;
      return $this;
    }

    public function setTemplate($template){
      $this->template = $template;
      return $this;
    }

    //
    /**
    * @desc Monta o template utilizando os dados passados
    * @warning Only use for Janpro
    */
    public function buildTemplate($data){
      ob_start();

      extract($data);
      include dirname(__DIR__)."/template/template_abf.phtml";


      $content = ob_get_contents();
      ob_end_clean();

      return $content;

    }

    public function send(){

        $from = "From: ".get_bloginfo('name') ." <".$this->from.">";
        $headers[] = $from;
        echo $this->to. " -- " . $this->subject. " -- " . $this->template. " -- <br/>" ;
        wp_mail( $this->to, $this->subject, $this->template,$headers );
    }
  }
