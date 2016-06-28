<?php
  /**
  * Class responsible for validate files
  */
  class File {
    private $file;
    private $extentions = array();

    /**
    * @desc Receive as parameter the $_FILES object
    * @param $file The $_FILES object
    * @param $extentions Extensios allowed
    */
    //
    public function __construct(Array $file ,Array $extentions = array()){
      $this->file = $file;
      $this->extentions = $extentions;
    }

    public function validate(){
      if(count($this->extentions) === 0){
        return true;
      }else {
        //Build a regex for validate the extension file, using the type property
        $type = $this->file['type'];

        $allowedExtensions = join("|",$this->extentions);
        $regex = "/{$allowedExtensions}/";
        $matches = array();
        preg_match($regex,$type,$matches);

        return count($matches) > 0;
      }
    }

    public function getExtension(){
      return $this->extentions;
    }
  }
