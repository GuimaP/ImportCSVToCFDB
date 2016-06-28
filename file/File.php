<?php
  /**
  * Class responsible for validate files
  */
  class CSVCF7_File {
    private $file;
    private $extentions;

    /**
    * @desc Receive as parameter the $_FILES object
    * @param $file The $_FILES object
    * @param $extentions Extensios allowed
    */
    //
    public function __construct(Array $file ,Array $extentions = array()){
      $this->path = $path;
      $this->extentions = $extentions;
    }

    public function validate(){
      if(count($this->extentions) === 0){
        return true;
      }else {
        //Build a regex for validate the extension file, using the type property
        $type = $this->file['type'];


        $allowedExtentions = join("|",$this->extentions);
        $regex = "/{$allowedExtentions}/";
        $matches = array();
        preg_match($regex,$type,$matches);



        return count($matches) > 0;
      }
    }

    public function getExtentions(){
      return $this->extentions;
    }

  }
