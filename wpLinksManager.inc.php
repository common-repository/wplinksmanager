<?php
/*  Copyright 2008 and Beyond  - LinksManager LLC */

// Here We Go!!

if(!class_exists("wpLinksManagerPlugin")){
	class wpLinksManagerPlugin {
		var $adminOptionsName = "wpLinksManagerAdminOptions";
    
    
    
    /**************************************************/
		function wpLinksManagerPlugin(){
			//constructor
		}
     /**************************************************/
    
    
    
    /**************************************************/
		function init(){
			$this->getAdminOptions();
		}
	/**************************************************/
    
    
    
    /**************************************************/
		function wplinksmanager_install(){
		global $wpdb;
		$wpLinksManager_version = "1.0";
		add_option("wpLinksManager_version", $wpLinksManager_version);
		}
	/**************************************************/
    
    
    
    /**************************************************/
	//Returns Admin Options
	function getAdminOptions(){
		$wpLinksManagerAdminOptions = array(
		'lm_account_id' => "empty",
      'lm_filename' => "categories.xml",
      'lm_title' => "Resources",
      'lm_top_text' => "Welcome to our visitor resources.",
      'lm_bottom_text' => "Thank you for visiting our partners.",
		'show_main_menu' => "Yes",
		'show_add_link' => "Yes",
		'show_modify_link' => "Yes",
		'widget_linksmanager_title' => "Visitor Resources",
		'widget_show_main_menu' => "categories.xml",
		'widget_show_linklet' => "category1.xml",
		'widget_show_add_link' => "Yes",
		'widget_show_modify_link' => "Yes",
      'iframe_width' => "600",
      'widget_choice' => "0");
		$wpLinksManagerOptions = get_option($this->adminOptionsName);
		if (!empty($wpLinksManagerOptions)){
			foreach ($wpLinksManagerOptions as $key => $option)
			$wpLinksManagerAdminOptions[$key] = $option;
		}
		update_option($this->adminOptionsName, $wpLinksManagerAdminOptions);
		return $wpLinksManagerAdminOptions;
	}
    /**************************************************/
    
    
    
    /**************************************************/
	//Prints Admin Page
	function printAdminPage(){
		$wpLinksManagerOptions = $this->getAdminOptions();
		if (isset($_POST['update_wpLinksManagerPluginSettings'])){
			if (isset($_POST['lm_account_id'])){
				$wpLinksManagerOptions['lm_account_id'] = $_POST['lm_account_id'];
			}
        if (isset($_POST['lm_filename'])){
				$wpLinksManagerOptions['lm_filename'] = $_POST['lm_filename'];
			}
        if (isset($_POST['lm_title'])){
				$wpLinksManagerOptions['lm_title'] = $_POST['lm_title'];
			}
        if (isset($_POST['lm_top_text'])){
				$wpLinksManagerOptions['lm_top_text'] = $_POST['lm_top_text'];
			}
        if (isset($_POST['lm_bottom_text'])){
				$wpLinksManagerOptions['lm_bottom_text'] = $_POST['lm_bottom_text'];
			}
			if (isset($_POST['show_main_menu'])){
				$wpLinksManagerOptions['show_main_menu'] = $_POST['show_main_menu'];
			}
			if (isset($_POST['show_add_link'])){
				$wpLinksManagerOptions['show_add_link'] = $_POST['show_add_link'];
			}
			if (isset($_POST['show_modify_link'])){
				$wpLinksManagerOptions['show_modify_link'] = $_POST['show_modify_link'];
			}
			if (isset($_POST['widget_linksmanager_title'])){
				$wpLinksManagerOptions['widget_linksmanager_title'] = $_POST['widget_linksmanager_title'];
			}
			if (isset($_POST['widget_show_main_menu'])){
				$wpLinksManagerOptions['widget_show_main_menu'] = $_POST['widget_show_main_menu'];
			}
			if (isset($_POST['widget_show_linklet'])){
				$wpLinksManagerOptions['widget_show_linklet'] = $_POST['widget_show_linklet'];
			}
			if (isset($_POST['widget_show_add_link'])){
				$wpLinksManagerOptions['widget_show_add_link'] = $_POST['widget_show_add_link'];
			}
			if (isset($_POST['widget_show_modify_link'])){
				$wpLinksManagerOptions['widget_show_modify_link'] = $_POST['widget_show_modify_link'];
			}
        if (isset($_POST['iframe_width'])){
				$wpLinksManagerOptions['iframe_width'] = $_POST['iframe_width'];
			}
        if (isset($_POST['widget_choice'])){
				$wpLinksManagerOptions['widget_choice'] = $_POST['widget_choice'];
			}
			update_option($this->adminOptionsName, $wpLinksManagerOptions);
			?>
				<div class="updated"><p><strong><?php _e("Settings Updated.",
				"wpLinksManagerPlugin");?></strong></p></div>
			<?php
		} ?>
		<div class="wrap">
		<?php
		//This is where link checker was done but is now handled by LinksManager System.
		?>
		<!-- General Admin Settings -->
		<h2>General Settings</h2><br />
		<table id="LinksManager">
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		<tr>
		<td>LinksManager ID</td>
		<td><input type="text" size="40" id="lm_account_id" name="lm_account_id" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_account_id']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
      <tr>
		<td>Menu LinkLet Filename</td>
		<td><input type="text" size="40" id="lm_filename" name="lm_filename" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_filename']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
      <tr>
		<td>Menu Page Title</td>
		<td><input type="text" size="40" id="lm_title" name="lm_title" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_title']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
      <tr>
		<td>Top Text</td>
		<td><textarea rows=5 cols=35 id="lm_top_text" name="lm_top_text" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_top_text']), 'wpLinksManagerPlugin') ?>"/><?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_top_text']), 'wpLinksManagerPlugin') ?></textarea></td>
		</tr>
      <tr>
		<td>Bottom Text</td>
		<td><textarea rows=5 cols=35 id="lm_bottom_text" name="lm_bottom_text" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_bottom_text']), 'wpLinksManagerPlugin') ?>"/><?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['lm_bottom_text']), 'wpLinksManagerPlugin') ?></textarea></td>
		</tr>
		<tr>
		<td>Show Main Menu Link?</td>
		<td><input type="text" size="40" id="show_main_menu" name="show_main_menu" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['show_main_menu']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
		<tr>
		<td>Show Submit Site Link?</td>
		<td><input type="text" size="40" id="show_add_link" name="show_add_link" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['show_add_link']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
		<tr>
		<td>Show Modify Site Link?</td>
		<td><input type="text" size="40" id="show_modify_link" name="show_modify_link" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['show_modify_link']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
      <tr>
		<td>Add/Modify Iframe Width?</td>
		<td><input type="text" size="40" id="iframe_width" name="iframe_width" value="<?php _e(apply_filters('format_to_edit',$wpLinksManagerOptions['iframe_width']), 'wpLinksManagerPlugin') ?>"/></td>
		</tr>
		<!-- End General Admin Settings -->
		</table>
		<div class="submit">
		<input type="submit" name="update_wpLinksManagerPluginSettings" value="<?php _e('Update Settings &raquo;', 'wpLinksManagerPlugin') ?>" />
		<small>*If you have issues please contact LinksManager via HelpDesk</small><br /><br />
		</div>
		</form>
		<br class="clear">
		</div> <!-- /wrap -->
		<?php
	}//End function printAdminPage
	/**************************************************/
    
    
    
    /**************************************************/
	//Add CSS to header
	function xcss(){
		echo '<link rel="stylesheet" href="'.get_bloginfo('wpurl').'/wp-content/plugins/wpLinksManager/css/x_style.css" type="text/css" media="screen" />';
	} //End function xcss
    /**************************************************/

    
    /**************************************************/
	function getPluginOptions($a){
		$wpLinksManagerOptions = $this->getAdminOptions();
		//Get data from database
		switch ($a){
			case 1:
				return $wpLinksManagerOptions['lm_account_id'];
				break;
        case 2:
				return $wpLinksManagerOptions['lm_filename'];
				break;
        case 3:
				return $wpLinksManagerOptions['lm_title'];
				break;
        case 4:
				return $wpLinksManagerOptions['lm_top_text'];
				break;
        case 5:
				return $wpLinksManagerOptions['lm_bottom_text'];
				break;
			case 6:
				return $wpLinksManagerOptions['show_main_menu'];
				break;
			case 7:
				return $wpLinksManagerOptions['show_add_link'];
				break;
			case 8:
				return $wpLinksManagerOptions['show_modify_link'];
				break;
			case 9:
				return $wpLinksManagerOptions['widget_linksmanager_title'];
				break;
			case 10:
				return $wpLinksManagerOptions['widget_show_mainmenu'];
				break;
			case 11:
				return $wpLinksManagerOptions['widget_show_mainmenu'];
				break;
			case 12:
				return $wpLinksManagerOptions['widget_show_add_link'];
				break;
			case 13:
				return $wpLinksManagerOptions['widget_show_modify_link'];
				break;
        case 14:
				return $wpLinksManagerOptions['iframe_width'];
				break;
        case 15:
        	return $wpLinksManagerOptions['widget_choice'];
          break;
		}
	} //End function getPluginOptions
    /**************************************************/



	/**************************************************/
	//Build the Content Here
	function xreplacewords($content=''){
		$wpLinksManagerOptions = $this->getAdminOptions();
		//Run Input Check Here
		if (!preg_match('|<!--wpLinksManager-->|', $content)){
			return $content ; //Empty
		} else {      					//Options for displaying content
			//$action = '<h1>Good To Go</h1>';
        if ($_GET['task'] == 'view') {
        	$action = $this->displayLinks();
        }
        if ($_GET['task'] == 'add') {
        	$action = $this->displayAddLink();
        }
        if ($_GET['task'] == 'modify') {
        	$action = $this->displayModifyLink();
        }
        if ($_GET['task'] == 'menu') {
        	$action = $this->displayMainMenu();
        }
        if ($_GET['task'] == '') {
        	$action = $this->displayMainMenu();
        }
			return str_replace('<!--wpLinksManager-->', $action, $content);
		}
	} //End function xreplacewords
    /**************************************************/

    
    
        //////////////////////
        ///      Start Content      ///
        //////////////////////
      
     
      
     
    	/********** FUNCTION displayMainMenu **********
		*
      *  Will display the list of categories on the main menu page.
      *
      ********************************************/
      
      function displayMainMenu() {
		// Get Options
      $options = get_option('wpLinksManagerAdminOptions');
		//call xml file
		$lmid = $options['lm_account_id'];
		$lmfile = $options['lm_filename'];
      $file = 'http://linksmanager.com/'.$lmid.'/'.$lmfile;

		// Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      
      // Display Title
      if ($options['lm_title'] != "") {
      	$lm_title = $options['lm_title'];
      	echo '<div id="lm_title">'.$lm_title.'</div>';
      }
      // End Title
      
      // Display Top Text
      if ($options['lm_top_text'] != "") {
      	$lm_top_text = $options['lm_top_text'];
      	echo '<p>'.$lm_top_text.'</p>';
      }
      // End Top Text

		echo '<table border="0" cellpadding="0" cellspacing="0" id="categories" class="categories">';
      $currentTag = "";

      /********** FUNCTION startElement **********
		*
      *  Creates the html code before the element when parser encounters start tag.
      *
      ********************************************/
      
      function startElement($parser, $name, $attrs) {
      	global $currentTag;
        $currentTag = $name;
        //output opening html tags
        if ($name == 'CATEGORY') {
          echo "<tr><td class='category'>";
        }
        if ($name == 'TITLE') {
          echo "'><span id='title'>";
        }
        if ($name == 'CATURL') {
          echo "<a href='";
        }
      } //end startElement
      
      
      /********** FUNCTION endElement **********
		*
      *  Creates the html code after the element when parser encounters end tag.
      *
      ********************************************/
      
      function endElement($parser, $name) {
      	global $currentTag;
        //output closing  html tags
        if ($name == 'CATEGORY') {
          echo "</td></tr><tr><td>&nbsp;</td></tr>";
        }
        if ($name == 'TITLE') {
          echo "</span></a>";
        }
        if ($name == 'CATURL') {
          echo "'";
        }
        //clear currentTag var
        $currentTag = "";
      } //end endElement
      
      
      /********** FUNCTION characterData **********
		*
      *  Processes the data between the html tags.
      *
      ********************************************/

	function characterData($parser, $data) {
      	global $currentTag;
        //format the data
        if ($currentTag == 'TITLE') {
          echo $data;
        }
        if ($currentTag == 'CATURL') {
          echo $data;
        }
      } //end characterData
      
      
      //initialize parser
      $xml_parser = xml_parser_create();
      //set callbacks
      xml_set_element_handler($xml_parser, "startElement", "endElement");
      xml_set_character_data_handler($xml_parser, "characterData");
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
      echo "</table><br />";
      
      // Display Bottom Text
      if ($options['lm_bottom_text'] != "") {
      	$lm_bottom_text = $options['lm_bottom_text'];
      	echo '<p>'.$lm_bottom_text.'</p>';
      }
      // End Bottom Text
      
      // Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      
      } //end function displayMainMenu



	/********** FUNCTION displayLinks **********
		*
      *  Will display a list of the links within the specified category.
      *
      ********************************************/
      
      function displayLinks() {
      // Get Category Id
      $category = $_GET['category'];
      // Get Options
      $options = get_option('wpLinksManagerAdminOptions');
      //call xml file
		$lmid = $options['lm_account_id'];
      $file = 'http://linksmanager.com/'.$lmid.'/category'.$category.'.xml';
      
      // Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      
      
      // Display Title
      if ($options['lm_title'] != "") {
      	$lm_title = $options['lm_title'];
      	echo '<div id="lm_title">'.$lm_title.'</div>';
      }
      // End Title
      
      // Display Top Text
      if ($options['lm_top_text'] != "") {
      	$lm_top_text = $options['lm_top_text'];
      	echo '<p>'.$lm_top_text.'</p>';
      }
      // End Top Text
      
      
		echo '<table border="0" cellpadding="0" cellspacing="0" id="resources" class="resources">';
      $currentTag = "";

      /********** FUNCTION startElement **********
		*
      *  Creates the html code before the element when parser encounters start tag.
      *
      ********************************************/
      
      function startElement($parser, $name, $attrs) {
      	global $currentTag;
        $currentTag = $name;
        //output opening html tags
        if ($name == 'LINK') {
          echo "<tr><td class='resources'>";
        }
        if ($name == 'DESCRIPTION') {
          echo "<br /><span id='description'>";
        }
        if ($name == 'SITENAME') {
          echo "<br /><span id='title'>";
        }
        if ($name == 'URL') {
          echo "<a target='_blank' href='";
        }
      } //end startElement
      
      
      /********** FUNCTION endElement **********
		*
      *  Creates the html code after the element when parser encounters end tag.
      *
      ********************************************/
      
      function endElement($parser, $name) {
      	global $currentTag;
        //output closing  html tags
        if ($name == 'LINK') {
          echo "</td></tr><tr></tr>";
        }
        if ($name == 'DESCRIPTION') {
          echo "</span><br /><br />";
        }
        if ($name == 'SITENAME') {
          echo "</span></a>";
        }
        if ($name == 'URL') {
          echo "'";
        }
        //clear currentTag var
        $currentTag = "";
      } //end endElement
      
      
      /********** FUNCTION characterData **********
		*
      *  Processes the data between the html tags.
      *
      ********************************************/

	function characterData($parser, $data) {
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
      } //end characterData
      
      
      //initialize parser
      $xml_parser = xml_parser_create();
      //set callbacks
      xml_set_element_handler($xml_parser, "startElement", "endElement");
      xml_set_character_data_handler($xml_parser, "characterData");
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
      echo "</table><br />";
      
      
      // Display Bottom Text
      if ($options['lm_bottom_text'] != "") {
      	$lm_bottom_text = $options['lm_bottom_text'];
      	echo '<p>'.$lm_bottom_text.'</p>';
      }
      // End Bottom Text
      
      
      // Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      } //end function displayLinks
      
      
      /********** FUNCTION displayAddLink **********
		*
      *  Will display the Add Link Page.
      *
      ********************************************/
      
      function displayAddLink() {
      // Get Options
      $options = get_option('wpLinksManagerAdminOptions');
      // Call Iframe
      $lmid = $options['lm_account_id'];
      $iframe = 'http://linksmanager.com/'.$lmid.'/add_link.html';
      $iwidth = $options['iframe_width'];
      // Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      
      
      // Display Iframe
      echo "<iframe src='$iframe' width='$iwidth' height='1200' marginwidth='0' marginheight='0' frameborder='0' scrolling='auto' name='addlinkpage'></iframe>";
		// End Iframe

      
		// Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      } //end function displayAddLink
      
      
      /********** FUNCTION displayModifyLink **********
		*
      *  Will display the Modify Link Page.
      *
      ********************************************/
      
      function displayModifyLink() {
      // Get Options
      $options = get_option('wpLinksManagerAdminOptions');
      // Call Iframe
      $lmid = $options['lm_account_id'];
      $iframe = 'http://linksmanager.com/'.$lmid.'/modify.html';
      $iwidth = $options['iframe_width'];
      // Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      
      
      // Display Iframe
      echo "<iframe src='$iframe' width='$iwidth' height='275' marginwidth='0' marginheight='0' frameborder='0' scrolling='auto' name='modifylinkpage'></iframe>";
		// End Iframe
      
      
		// Display Breadcrumbs
      echo '<div id="breadnav">';
      if ($options['show_main_menu'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=menu">Main Menu</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_add_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=add">Add Site</a> - ';
      } else {
      	echo '';
      }
      
      if ($options['show_modify_link'] == "Yes") {
      	$lmquery = $_GET['page_id'];
        $lmbuild = 'page_id='.$lmquery.'';
      	echo '<a href="'.$_SERVER['REDIRECT_SCRIPT_URI'].'?'.$lmbuild.'&task=modify">Modify Site</a>';
      } else {
      	echo '';
      }
      echo '</div>';
      // End Breadcrumbs
      } //end function displayModifyLink
      
      


        //////////////////////
        ///      End  Content       ///
        //////////////////////
        
        
	} // End Class
} // End If
?>
