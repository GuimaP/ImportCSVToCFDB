<?php
  class CSVCF7_DB {
    private $columns;
    private $table = "wp_cf7dbplugin_submits";

    private $db;

    private $credentials = array(
      "username" => DB_USER,
      "password" => DB_PASSWORD,
      "database" => DB_NAME,
      "host"     => DB_HOST

    );
    /**
    * @desc Receive as parameter the fields of the form
    */
    public function __construct(){
        $this->createQuery();
    }

    private function createQuery(){
      $this->db = new wpdb(
        $this->credentials['username'],
        $this->credentials['password'],
        $this->credentials['database'],
        $this->credentials['host']
      );




    }

    public function insert($item,Array $headers,$formName){

        // for($index = 0; $index < count($items);  $index++){
          $date = new DateTime();
          $id = microtime(true) + $date->getTimestamp();

          // $item = $items[$index];
          //Pego o item atual e verifico cada index
          foreach ($item as $column => $value) {
            $fieldOrder = 0;

            //Verifico qual ordem esta a column atual dentro do array de headers
            for($i = 0; $i < count($headers); $i++){

              //Se o valor da column for igual a coluna do registro verificado
              //Eu pego o index e guardo como field_order
              if($headers[$i] == $column){
                $fieldOrder = $i;
                break;
              }
            }

            // echo "$column => $value || field Order => $fieldOrder <br/>";

            //Insiro no banco o registro
            $this->db->insert(
            	$this->table,
            	array(
                'form_name'   => $formName,
            		'field_name'  => $column,
            		'field_value' => $value,
                'field_order' => $fieldOrder,
                'submit_time' => $id
            	),
            	array(
            		'%s',
            		'%s',
            		'%s',
            		'%d',
            		'%f'
            	)
            );


          }

          usleep(100);

        }

    // }




  }
