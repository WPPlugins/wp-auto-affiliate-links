<?php


class AalLink
{
	var $id;
    var $link;
    var $keywords;
    var $medium;
    var $meta;
    var $hooks = array();


	function __construct($id = '',$link,$keywords,$medium,$meta) {
		
		$this->id = $id;
		$this->link = $link;
		$this->keywords = $keywords;
		$this->medium = $medium;
		$this->meta = $meta;

	}
	
	static function showAll($medium = '') {
			global $wpdb;
			$table_name = $wpdb->prefix . "automated_links";	
			$orderby = filter_input(INPUT_GET, 'aalorder', FILTER_SANITIZE_SPECIAL_CHARS); // $_GET['aalorder'];
			$ordersql = '';
			if($orderby) $ordersql = " ORDER BY ". $orderby; 			
			
			
			$myrows = $wpdb->get_results( "SELECT * FROM ". $table_name . $ordersql);

			if($myrows) {
        	 foreach($myrows as $row) {

				$link = new AalLink($row->id,$row->link,$row->keywords,$row->medium,$row->meta);
				$link->display();
            
             } 	
            }
          else {
          
          	echo '<div>Add some links using the form above</div>';
          
          }
		
	}	
	
	

	function display() {
		$meta = json_decode($this->meta);
		
 		?>
 		

 		
            <form name="edit-link-<?php echo $this->id; ?>" method="post">
                  <input value="<?php echo $this->id; ?>" name="edit_id" type="hidden" />
                  
                  <input type="hidden" name="aal_edit" value="ok" />
                                                
                  <?php
                  if (function_exists('wp_nonce_field')) wp_nonce_field('WP-auto-affiliate-links_edit_link');
                  ?>
                  <li style="" class="aal_links_box">
                  <input type="checkbox" name="aal_massids[]" value="<?php echo $this->id; ?>" />
                       Link: <input style="margin: 5px 10px;width: 32%;" type="text" name="aal_link" value="<?php echo $this->link; ?>" />
                       Keywords: <input style="margin: 5px 10px;width: 15%;" type="text" name="aal_keywords" value="<?php echo $this->keywords; ?>" />
                       Title: <input style="margin: 5px 10px;width: 10%;" type="text" name="aal_title" value="<?php echo $meta->title; ?>" />
                       <input  class="button-primary" style="margin: 5px 2px;" type="submit" name="ed" value="Update" />
                        <a href="#" id="<?php echo $this->id; ?>" class="aalDeleteLink"><img src="<?php echo plugin_dir_url(__FILE__);?>../images/delete.png"/></a>
                  </li>    
</form>

                                            
         <?php		
		
		
	}

}


function aalGetLink($id) {
	
		if(!$id) return false;	
		global $wpdb;
		$table_name = $wpdb->prefix . "automated_links";	
		$myrows = $wpdb->get_results( "SELECT * FROM ". $table_name ." WHERE id='". $id ."' ");
		
		$link = AalLink($id,$link,$keyword,$medium);
	
	
}

function aalGetLinkByUrl($url) {
		
		if(!$url) return false;
		global $wpdb;
		$table_name = $wpdb->prefix . "automated_links";	
		$myrows = $wpdb->get_results( "SELECT * FROM ". $table_name ." WHERE link='". $url ."' ");
		
		$link = AalLink($id,$link,$keyword,$medium);
	
	
}


?>