<?php
/*
Plugin Name: Import CSV to CFDB
Plugin URL: http://www.unius.com.br
Description: Import csv into contact form DB
Version: 1.0
Author: Guilherme Rodrigues
License: MIT
*/

//Include the file class
require "class/CSVCF7_File.php";
require "class/CSVCF7_CSV.php";
require "class/CSVCF7_DB.php";
require "class/CSVCF7_ContactForm.php";
require "class/CSVCF7_Mail.php";


function csvcf7_main_admin_add() {
    add_menu_page("Import CSV to CFDB", "Import CSV to CFDB", 'edit_themes', basename(__FILE__), 'csvcf7_main_admin_html', '');
}


// Print page
function csvcf7_main_admin_html() {
  include "admin_page.php";
}



add_action('admin_menu' , 'csvcf7_main_admin_add');
