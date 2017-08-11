<?php


add_action('admin_init', 'aal_exclude_cats_actions');



 function aal_exclude_cats_actions() {
	global $wpdb;
	
		if(isset($_POST['aal_add_exclude_cat_check'])) if($_POST['aal_add_exclude_cat_check']=='ok') {
			

			$word = filter_input(INPUT_POST, 'aal_add_exclude_cat', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['id'];


			if(get_option('aal_excludecats')) {
				$old = get_option('aal_excludecats');
				update_option('aal_excludecats',$old . ',' . $word);
			}
			else {
				add_option('aal_excludecats', $word);
			} 
		//	wp_redirect("admin.php?page=aal_topmenu");
	
			
	}
	
		if(isset($_POST['aal_excludecatsdeletecheck'])) if($_POST['aal_excludecatsdeletecheck']=='ok') {
			

			$word = filter_input(INPUT_POST, 'aal_excludecatsdeletecat', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['id'];


			if(get_option('aal_excludecats')) {
				$old = get_option('aal_excludecats');
				$olda = explode(",",$old);
				if(($key = array_search($word, $olda)) !== false) {
   					 unset($olda[$key]);
				}
				$old = implode(",",$olda);
				if($old) update_option('aal_excludecats',$old);
				else delete_option('aal_excludecats');
			}
			else {
				// add_option('aal_excludewords', $word);
			} 
		//	wp_redirect("admin.php?page=aal_topmenu");
	
			
	}
	
	
} 



function wpaal_exclude_cats() {
	global $wpdb;
	
		//get excluded categories
     	$words = get_option('aal_excludecats'); 
     	if($words) $words = explode(',', $words);	
	
$args = array(
	'type'                     => 'post',
	'child_of'                 => '',
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false 

); 

$categories = get_categories( $args );

//print_r($categories);


?>

<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
 
        
        
                <h2>Exclude Categories</h2>
                <br /><br /><br />
                

<h3>Manually exclude categories</h3>                
                
                 <form name="aal_add_exclude_cats_form" id="aal_add_exclude_cats_form" method="post">
                    <b>Select Category to exclude </b>:
                    <select name="aal_add_exclude_cat" id="aal_add_exclude_cat" >
						<option value="">-Select a category-</option>
						<?php foreach($categories as $cat) if(!in_array($cat->term_id,$words)) { ?>
						<option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name .' ('. $cat->category_count .')'; ?></option>	
						<?php } ?>                 
                    
                    </select>
                    <input type="hidden" name="aal_add_exclude_cat_check" value="ok" />
                    <input  class="button-primary"  type="submit" value="Exclude Category"/>
                </form>
                
                
                
               <br />
               <br /
     <h4>Excluded Categories:</h4><br /><br />
	<table class="widefat fixed" > 
	<thead>
		<th>Excluded Category</th>
		<th>Actions</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</thead>
     <?php 

     	
     if(is_array($words)) foreach ($words as $word) { ?>
     	
     	
	<tr>
		<td><?php echo get_the_category_by_ID($word); ?></td>
		<td><form name="aal_excludecatsdelete" method="post" ><input type="hidden" name="aal_excludecatsdeletecheck" value="ok" /><input type="hidden" name="aal_excludecatsdeletecat" value="<?php echo $word; ?>" /><input class="button-primary" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this item?');" /></form></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
     		
 
     	
     	
     	<?php 	
     	}
     
     
     
     
     ?>
       </table>        
 
                
                
    <br />
    <br /><br />
    <hr />
  <p>If you have problems or questions about the plugin, or if you just want to send a suggestion or request to our team, you can use the <a href="http://wordpress.org/support/plugin/wp-auto-affiliate-links">support forum</a>. Make sure that you consult our <a href="http://wordpress.org/plugins/wp-auto-affiliate-links/faq/">FAQ section</a> first. </p>
  
  </div>













<?php



}