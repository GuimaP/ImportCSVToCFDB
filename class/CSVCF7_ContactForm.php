<?php
  class CSVCF7_ContactForm {
    public function getForms(){
      $formsList = array();
      $query = new WP_Query([
        'post_type' => 'wpcf7_contact_form'
      ]);

      if($query->have_posts()) {
        while($query->have_posts()) { $query->the_post();
          $formsList[] = [
            'title' => get_the_title(),
            'id' => get_the_ID()
          ];
        }
      }

      return $formsList;
    }

    public function getForm($id) {
      $form = array();
      $query = new WP_Query([
        'post_type' => 'wpcf7_contact_form',
        'p'    => $id
      ]);

      if($query->have_posts()) {
        while($query->have_posts()) { $query->the_post();
          $form = [
            'title' => get_the_title(),
            'id'    => get_the_ID()
          ];
        }
      }

      return $form;
    }

    //Replace the keys that exists into contact form template 
    public function replaceData($string, $index, $value){
        $regex = '/\[('.$index.')\]/i';

        return preg_replace($regex, $value, $string);
    }


    //Replace the keys that exists into string
    public function replaceSubject($string,Array $keys){
      $subject = $string;
      foreach ($keys as $key => $value) {
        $regex = '/\[('.$key.')\]/i';
        $subject = preg_replace($regex, $value, $subject);
      }
      return $subject;
    }
  }
