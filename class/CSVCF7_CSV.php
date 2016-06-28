<?php
  /**
  * @desc A Container to manager XML
  * @author Guilherme Pereira.
  */
  class CSVCF7_CSV {
    private $xmlPath = "";

    private $headers = array();
    private $data = array();

    /**
    * @desc Receive a string xml to convert
    */
    public function __construct($xmlPath){
        $this->xmlPath = $xmlPath;
    }

    public function execute(){
      $file = fopen($this->xmlPath['tmp_name'],"r");
      $row = 0;
      while(! feof($file))
      {

        // echo '<pre>';
        // print_r(fgetcsv($file));
        // echo '</pre>';
        if($row === 0){

          $this->setHeader(fgetcsv($file));
        }else {

          $this->setContent(fgetcsv($file));
        }


        $row++;
      }

      fclose($file);

      $this->formatData();


    }

    private function formatData(){
      $size = count($this->headers);

      $listItens = array();
      foreach ($this->data as $row) {
        $item = array();
        //Define o nome da coluna como chave para o registro
        for($i = 0; $i < $size; $i++){
            $column = $this->headers[$i];

            //Verifica se existe algum valor no indice especificado
            $value  = isset($row[$i]) ?  $row[$i] : " ";

            $item[$column] = $value;

        }

        $listItens[] = $item;
      }

      $this->data = $listItens;

    }

    private function setHeader($data){
      $this->headers = $data;
    }

    private function setContent($data){
      if($data){ //Somente se for registro
        $this->data[] = $data;
      }
    }

    public function getHeader(){
      return $this->headers;
    }

    public function getContent(){
      return $this->data;
    }
  }
