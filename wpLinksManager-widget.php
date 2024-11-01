<?php
/*
Plugin Name: wpLinksManager - Widget
Plugin URI: http://wordpress.linksmanager.com
Description: This Widget connects your WordPress blog with your LinksManager account. Display can be set to show categories or link lists.
Version: 1.0.1
Author: Phillip Chafin
Author URI: http://www.thelastwebmaster.com
*/

/*  Copyright 2008 and Beyond  - LinksManager LLC */

// Here We Go!!

function widget_linksmanager_init(){
	if (!function_exists('register_sidebar_widget')){
		return;
	} //end if
    
	//Viewer for widget
	function listLinksManager(){
		$options = get_option('wpLinksManagerAdminOptions');

		//Display Content Here
				
				   
		/********** FUNCTION displayMainMenu **********
		*
      *  Will display the list of categories on the main menu page.
      *
      ********************************************/
      
      function displayMainMenu() {
			$options = get_option('wpLinksManagerAdminOptions');
			
      //call xml file
			$lmid = $options['lm_account_id'];
			$lmfile = $options['lm_filename'];
      $file = 'http://linksmanager.com/'.$lmid.'/'.$lmfile;
		echo '<div id="lmwidget" class="lmwidget"><ul>';
      $currentTag = "";

      /********** FUNCTION startElementW **********
		*
      *  Creates the html code before the element when parser encounters start tag.
      *
      ********************************************/
      
      function startElementW($parser, $name, $attrs) {
      	global $currentTag;
        $currentTag = $name;
        //output opening html tags
        if ($name == 'CATEGORY') {
          echo "<li>";
        }
        if ($name == 'TITLE') {
          echo "'><span id='title'>";
        }
        if ($name == 'CATURL') {
          echo "<a href='";
        }
      } //end startElementW
      
      
      /********** FUNCTION endElementW **********
		*
      *  Creates the html code after the element when parser encounters end tag.
      *
      ********************************************/
      
      function endElementW($parser, $name) {
      	global $currentTag;
        //output closing  html tags
        if ($name == 'CATEGORY') {
          echo "</li>";
        }
        if ($name == 'TITLE') {
          echo "</span></a>";
        }
        if ($name == 'CATURL') {
          echo "'";
        }
        //clear currentTag var
        $currentTag = "";
      } //end endElementW
      
      
      /********** FUNCTION characterData **********
		*
      *  Processes the data between the html tags.
      *
      ********************************************/

	function characterDataW($parser, $data) {
      	global $currentTag;
        //format the data
        if ($currentTag == 'TITLE') {
          echo $data;
        }
        if ($currentTag == 'CATURL') {
          echo $data;
        }
      } //end characterDataW
      
      
      //initialize parser
      $xml_parser = xml_parser_create();
      //set callbacks
      xml_set_element_handler($xml_parser, "startElementW", "endElementW");
      xml_set_character_data_handler($xml_parser, "characterDataW");
      //open XML
      if (!($fp = fopen($file, "r"))) {
      	die("Cannot locate XML data file: $file");
      }
      //read and parse
      while ($data = fread($fp, 4096)) {
      	if (!xml_parse($xml_parser, $data, feof($fp))) {
        	die(sprintf("XML Error: %s at line %d",
          xml_error_string(xml_get_error_code($xml_parser)),
          xml_get_current_line_number($xml_parser)));
        }
      }
      //clean up
      xml_parser_free($xml_parser); 
      echo "</ul></div>";
      
      } //end function displayMainMenu
			
				/********** FUNCTION displayLinks **********
		*
      *  Will display a list of the links within the specified category.
      *
      ********************************************/
      
      function displayLinks() {
      	
        //Get the passed category id number
        $category = $_GET['categoryid'];
        
        $options = get_option('wpLinksManagerAdminOptions');
			
      //call xml file
			$lmid = $options['lm_account_id'];
			$lmfile = $options['widget_show_linklet'];
      $file = 'http://linksmanager.com/'.$lmid.'/'.$lmfile;
		echo '<div id="lmwidget" class="lmwidget"><ul>';
      $currentTag = "";

      /********** FUNCTION startElementW **********
		*
      *  Creates the html code before the element when parser encounters start tag.
      *
      ********************************************/
      
      function startElementW($parser, $name, $attrs) {
      	global $currentTag;
        $currentTag = $name;
        //output opening html tags
        if ($name == 'LINK') {
          echo "<li>";
        }
        if ($name == 'DESCRIPTION') {
          echo " title='";
        }
        if ($name == 'SITENAME') {
          echo "<span id='title'>";
        }
        if ($name == 'URL') {
          echo "<a target='_blank' href='";
        }
      } //end startElementW
      
      
      /********** FUNCTION endElementW **********
		*
      *  Creates the html code after the element when parser encounters end tag.
      *
      ********************************************/
      
      function endElementW($parser, $name) {
      	global $currentTag;
        //output closing  html tags
        if ($name == 'LINK') {
          echo "</li>";
        }
        if ($name == 'DESCRIPTION') {
          echo "'";
					// echo "'";
        }
        if ($name == 'SITENAME') {
          echo "</span></a>";
        }
        if ($name == 'URL') {
          echo "'";
        }
        //clear currentTag var
        $currentTag = "";
      } //end endElementW
      
      
      /********** FUNCTION characterDataW **********
		*
      *  Processes the data between the html tags.
      *
      ********************************************/

	function characterDataW($parser, $data) {
      	global $currentTag;
        //format the data
        if ($currentTag == 'SITENAME') {
          echo $data;
        }
        if ($currentTag == 'URL') {
          echo $data;
        }
        if ($currentTag == 'DESCRIPTION') {
          echo $data;
        }
      } //end characterDataW
      
      
      //initialize parser
      $xml_parser = xml_parser_create();
      //set callbacks
      xml_set_element_handler($xml_parser, "startElementW", "endElementW");
      xml_set_character_data_handler($xml_parser, "characterDataW");
      //open XML
      if (!($fp = fopen($file, "r"))) {
      	die("Cannot locate XML data file: $file");
      }
      //read and parse
      while ($data = fread($fp, 4096)) {
      	if (!xml_parse($xml_parser, $data, feof($fp))) {
        	die(sprintf("XML Error: %s at line %d",
          xml_error_string(xml_get_error_code($xml_parser)),
          xml_get_current_line_number($xml_parser)));
        }
      }
      //clean up
      xml_parser_free($xml_parser); 
      echo "</ul></div>";
      
      } //end function displayLinks

			
		//Choose Categories vs. LinkLets
        
			if ($options['widget_choice'] == "0") {
				displayMainMenu();
			}
			if ($options['widget_choice'] == "1") {	
				displayLinks();
			}
		//End Content Here
      
      //Process Add/Modify Links
      $lmid = $options['lm_account_id'];
      	echo '<br />';
      	if ($options['widget_show_add_link'] == "Yes") {
        echo '<ul id="addlink"><li><a target="_blank" href="http://linksmanager.com/'.$lmid.'/add_link.html">Add Your Site</a></li></ul>';
        }
        if ($options['widget_show_modify_link'] == "Yes") {
        echo '<ul id="modifylink"><li><a target="_blank" href="http://linksmanager.com/'.$lmid.'/modify.html">Modify Your Site</a></li></ul>';
        }
      
	} //end listLinksManager
    /************************************/
    
    
    
    /************************************/
	function wLinksManager($args){
		extract($args);
		$options = get_option('wpLinksManagerAdminOptions');
		$title = $options['widget_linksmanager_title'];
      $lmid = $options['lm_account_id'];
		echo $before_widget.$before_title.$title.$after_title;
		if (function_exists('listLinksManager')){
			listLinksManager();
		} //end if
		echo $after_widget.'<br /><small>Powered by <a href="http://linksmanager.com/cgi-bin/welcome.cgi?'.$lmid.'  " target="_blank" title="LinksManager WordPress Plugin" rel="dofollow">LinksManager</a></small>';
	} //end wLinksManager
    /************************************/
    
    
    
    /************************************/
	function widget_LinksManager_options() {
		$options = get_option('wpLinksManagerAdminOptions');
		if ($_POST['widget_linksmanager_submit']){
			$options['widget_linksmanager_title'] = strip_tags($_POST['widget_linksmanager_title']);
			$options['widget_show_main_menu'] = strip_tags($_POST['widget_show_main_menu']);
			$options['widget_show_linklet'] = strip_tags($_POST['widget_show_linklet']);
			$options['widget_show_add_link'] = strip_tags($_POST['widget_show_add_link']);
			$options['widget_show_modify_link'] = strip_tags($_POST['widget_show_modify_link']);
			$options['widget_choice'] = strip_tags($_POST['widget_choice']);
			update_option('wpLinksManagerAdminOptions', $options);
		} //end if
		
		//Title
		echo '<p style="text-align:left;"><label for="widget_linksmanager_title">';
		_e('Widget Title', 'LinksManagerPluginSeries');
		echo '&nbsp;: </label><br/><input type="text" id="widget_linksmanager_title" name="widget_linksmanager_title" value="'.htmlspecialchars(stripslashes($options['widget_linksmanager_title'])).'" /></p>'."\n";

		//Categories Display
		echo '<p style="text-align:left;"><label for="widget_show_main_menu">';
		_e('Display Categories : Filename', 'LinksManagerPluginSeries');
		echo '&nbsp;: </label><br/><input type="text" id="widget_show_main_menu" name="widget_show_main_menu" value="'.htmlspecialchars(stripslashes($options['widget_show_main_menu'])).'" />&nbsp;<input type="radio" id="widget_choice" name="widget_choice" value="0" checked />Enable?<br/><small>Default is categories.xml</small></p>'."\n";

		//Linklet Display
		echo '<p style="text-align:left;"><label for="widget_show_linklet">';
		_e('Display Linklets : Filename', 'LinksManagerPluginSeries');
		echo '&nbsp;: </label><br/><input type="text" id="widget_show_linklet" name="widget_show_linklet" value="'.htmlspecialchars(stripslashes($options['widget_show_linklet'])).'" />&nbsp;<input type="radio" id="widget_choice" name="widget_choice" value="1" />Enable?<br/><small>Default is linklet.xml</small></p>'."\n";
		
		//Submit Site
		echo '<p style="text-align:left;"><label for="widget_show_add_link">';
		_e('Show Submit Site Link?', 'LinksManagerPluginSeries');
		echo '&nbsp;: </label><br/><input type="text" id="widget_show_add_link" name="widget_show_add_link" value="'.htmlspecialchars(stripslashes($options['widget_show_add_link'])).'" /><br/><small>Default is Yes</small></p>'."\n";

		//Modify Site
		echo '<p style="text-align:left;"><label for="widget_show_modify_link">';
		_e('Show Modify Site Link?', 'LinksManagerPluginSeries');
		echo '&nbsp;: </label><br/><input type="text" id="widget_show_modify_link" name="widget_show_modify_link" value="'.htmlspecialchars(stripslashes($options['widget_show_modify_link'])).'" /><br/><small>Default is Yes</small></p>'."\n";
		//Hidden Submit
		echo '<input type="hidden" id="widget_linksmanager_submit" name="widget_linksmanager_submit" value="1"/>'."\n";

	} //end widget_LinksManager_options
    /************************************/

    
    
    /************************************/
	//Register Widgets
	register_sidebar_widget('LinksManager', 'wLinksManager');
	register_widget_control('LinksManager', 'widget_LinksManager_options');
    /************************************/
    
    
} //end init

add_action('plugins_loaded', 'widget_linksmanager_init');
?>
