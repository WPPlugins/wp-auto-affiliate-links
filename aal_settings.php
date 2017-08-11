<?php

//Change General setings through ajax 
function aalChangeOptions(){	

		if ( !current_user_can("publish_pages") ) return;
		
		if(!isset($_POST['aal_settings_update']))  return;
		if(!$_POST['aal_settings_update']=='ok') return;


		//Input check
		$aal_showhome = filter_input(INPUT_POST, 'aal_showhome', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_showlist = filter_input(INPUT_POST, 'aal_showlist', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_showwidget = filter_input(INPUT_POST, 'aal_showwidget', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_showexcerpt = filter_input(INPUT_POST, 'aal_showexcerpt', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_showhtags = filter_input(INPUT_POST, 'aal_showhtags', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_notimes = filter_input(INPUT_POST, 'aal_notimes', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_notimescustom = filter_input(INPUT_POST, 'aal_notimescustom', FILTER_SANITIZE_SPECIAL_CHARS);
		//$aal_exclude = filter_input(INPUT_POST, 'aal_exclude', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_iscloacked = filter_input(INPUT_POST, 'aal_iscloacked', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_cloakurl = filter_input(INPUT_POST, 'aal_cloakurl', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_targeto = filter_input(INPUT_POST, 'aal_target', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_relationo = filter_input(INPUT_POST, 'aal_relation', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_cssclass = filter_input(INPUT_POST, 'aal_cssclass', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_langsupport = filter_input(INPUT_POST, 'aal_langsupport', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_display = filter_input(INPUT_POST, 'aal_display', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_samekeyword = filter_input(INPUT_POST, 'aal_samekeyword', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_samelink = filter_input(INPUT_POST, 'aal_samelink', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_linkdistribution = filter_input(INPUT_POST, 'aal_linkdistribution', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_pluginstatus = filter_input(INPUT_POST, 'aal_pluginstatus', FILTER_SANITIZE_SPECIAL_CHARS);
		$aal_displayc = array();
		if(is_array($_POST['aal_displayc'])) foreach($_POST['aal_displayc'] as $dc) {
			$dc = sanitize_text_field($dc);
			$aal_displayc[] = $dc;		
		}
		//$aal_displayc = $_POST['aal_displayc'];
		$aal_displayc = json_encode($aal_displayc);
		
		
		$aal_showhome = sanitize_text_field($aal_showhome);	
		$aal_showlist = sanitize_text_field($aal_showlist);	
		$aal_showwidget = sanitize_text_field($aal_showwidget);	
		$aal_showexcerpt = sanitize_text_field($aal_showexcerpt);
		$aal_showhtags = sanitize_text_field($aal_showhtags);	
		$aal_notimes = sanitize_text_field($aal_notimes);	
		$aal_notimescustom = sanitize_text_field($aal_notimescustom);	
		$aal_iscloacked = sanitize_text_field($aal_iscloacked);	
		$aal_cloakurl = sanitize_text_field($aal_cloakurl);	
		$aal_targeto = sanitize_text_field($aal_targeto);	
		$aal_relationo = sanitize_text_field($aal_relationo);	
		$aal_cssclass = sanitize_text_field($aal_cssclass);	
		$aal_langsupport = sanitize_text_field($aal_langsupport);	
		$aal_display = sanitize_text_field($aal_display);	
		$aal_samekeyword = sanitize_text_field($aal_samekeyword);
		$aal_samelink = sanitize_text_field($aal_samelink);
		$aal_linkdistribution = sanitize_text_field($aal_linkdistribution);	
		$aal_displayc = sanitize_text_field($aal_displayc);	
		$aal_pluginstatus = sanitize_text_field($aal_pluginstatus);	
		
		
		$aal_cloakurl = strtolower($aal_cloakurl);
		$aal_cloakurl = preg_replace("/[^a-z]+/", "", $aal_cloakurl);
		if(!$aal_cloakurl || !is_string($aal_cloakurl)) $aal_cloakurl = 'goto';
		
		
		//Delete the settings and re-add them		
         aal_add_option( 'aal_iscloacked', $aal_iscloacked, '', 'yes');		
         aal_add_option( 'aal_cloakurl', $aal_cloakurl, '', 'yes');	
		aal_add_option( 'aal_showhome', $aal_showhome, '', 'yes');	
		aal_add_option( 'aal_showlist', $aal_showlist, '', 'yes');	
		aal_add_option( 'aal_showwidget', $aal_showwidget, '', 'yes');
		aal_add_option( 'aal_showexcerpt', $aal_showexcerpt, '', 'yes');
		aal_add_option( 'aal_showhtags', $aal_showhtags, '', 'yes');
		aal_add_option( 'aal_notimes', $aal_notimes, '', 'yes');	
		aal_add_option( 'aal_notimescustom', $aal_notimescustom, '', 'yes');				
		//aal_add_option( 'aal_exclude', $aal_exclude);		
		aal_add_option( 'aal_target', $aal_targeto, '', 'yes');
		aal_add_option( 'aal_relation', $aal_relationo, '', 'yes');
      aal_add_option( 'aal_cssclass', $aal_cssclass, '', 'yes');
     aal_add_option( 'aal_langsupport', $aal_langsupport, '', 'yes');
      aal_add_option( 'aal_display', $aal_display, '', 'yes');
     aal_add_option( 'aal_samekeyword', $aal_samekeyword, '', 'yes');
     aal_add_option( 'aal_samelink', $aal_samelink, '', 'yes');
      aal_add_option( 'aal_linkdistribution', $aal_linkdistribution, '', 'yes');
      aal_add_option( 'aal_displayc', $aal_displayc, '', 'yes');        
       aal_add_option( 'aal_pluginstatus', $aal_pluginstatus, '', 'yes');    
       
  
       flush_rewrite_rules(false);
      

}


function aal_add_option($option,$value) {
	
/*	 if(get_option($option)) {
		update_option($option,$value);
	}
	else {
		add_option($option,$value,'', 'yes');
	} 
	*/
	
	update_option($option,$value);
	
}


function wpaal_general_settings() {
	global $wpdb;
	$table_name = $wpdb->prefix . "automated_links";	
	

	$pluginstatus = get_option('aal_pluginstatus');
        
   $cloakurl = get_option('aal_cloakurl');
   $iscloacked = get_option('aal_iscloacked');
	if($iscloacked=='true') $isc = 'checked'; else $isc = '';
	
        $langsupport = get_option('aal_langsupport');
	if($langsupport=='true') $langsc = 'checked'; else $langsc = '';
        
	$showhome = get_option('aal_showhome'); //echo $showhome;
        if($showhome=='true') $shse = 'checked'; else $shse = '';
        
	$showlist = get_option('aal_showlist'); //echo $showlist;
        if($showlist=='true') $slse = 'checked'; else $slse = '';
        
    $showwidget = get_option('aal_showwidget'); //echo $showwidget;
        if($showwidget=='true') $swse = 'checked'; else $swse = '';
        
    $showexcerpt = get_option('aal_showexcerpt'); //echo $showexcerpt;
        if($showexcerpt=='true') $sese = 'checked'; else $sese = '';
        
    $showhtags = get_option('aal_showhtags'); //echo $showhtags;
        if($showhtags=='true') $shtagsse = 'checked'; else $shtagsse = '';
        
	$notimes = get_option('aal_notimes');
	$notimescustom = get_option('aal_notimescustom');
	$samekeyword = get_option('aal_samekeyword');
	if(!$samekeyword) $samekeyword = 'nolimit';
	$samelink = get_option('aal_samelink');
	$linkdistribution = get_option('aal_linkdistribution');
	$cssclass = get_option('aal_cssclass');
        
	$targeto = get_option('aal_target');
	if($targeto=="_blank") { $tsc1 = 'checked'; $tsc2 = ''; }
	else if($targeto=="_self") { $tsc2 = 'checked'; $tsc1 = ''; }
	else { $tsc1 = 'checked'; $tsc2 = '';  }
	
	$displayo = get_option('aal_display');
        
        $relationo = get_option('aal_relation');
	if($relationo=="nofollow") { $rsc1 = 'checked'; $rsc2 = ''; }
	else { $rsc2 = 'checked'; $rsc1 = ''; }	
	
	
	$displayc = get_option('aal_displayc'); 
	$displayc =json_decode(stripslashes($displayc));
	$post_types = get_post_types( '', 'names' ); 
	unset($post_types['revision']);
	unset($post_types['attachment']);
	unset($post_types['nav_menu_item']);
	//print_r($post_types);	
	
	
	?>
	
	
<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
        
        
                <h2>General Settings</h2>
                <div class="aal_general_settings">
                <form name="aal_settings" id="aal_changeOptions-nonJS" method="post">
                	<input type="hidden" name="aal_settings_update" value="ok" />
                                      
           
                
                    
                    <span class="aal_label">Link Frequency:</span> <select name="aal_notimes" id="aal_notimes" value="<?php echo $notimes ;?>" size="1" onchange="aalFrequencySelector();" />
                    	<option value="1" <?php if($notimes=="1") echo "SELECTED"; ?> >Very Low</option>
						<option value="2" <?php if($notimes=="2") echo "SELECTED"; ?> >Low</option>
						<option value="3" <?php if($notimes=="3") echo "SELECTED"; ?> >Average</option>
						<option value="4" <?php if($notimes=="4") echo "SELECTED"; ?> >High</option>
						<option value="5" <?php if($notimes=="5") echo "SELECTED"; ?> >Very High</option>
						<option value="0" <?php if($notimes=="0") echo "SELECTED"; ?> >No Links</option>
						<option value="custom" <?php if($notimes=="custom") echo "SELECTED"; ?> >Custom Value</option>
					</select>                    
                    <br /><br />

                    <div id="aal_custom_frequency" <?php if($notimes=="custom") echo 'style="display: block;"'; else echo 'style="display: none;"'; ?>><span class="aal_label">Max links in every article:</span> <input type="text" name="aal_notimescustom" id="aal_notimescustom" value="<?php echo $notimescustom ;?>" size="1" />            
                    <br /><br /></div>
 
                    <span class="aal_label">Same keyword limit:</span> <select name="aal_samekeyword" id="aal_samekeyword" value="<?php echo $samekeyword ;?>" size="1" />
                    	<option value="1" <?php if($samekeyword=="1") echo "SELECTED"; ?> >1</option>
						<option value="2" <?php if($samekeyword=="2") echo "SELECTED"; ?> >2</option>
						<option value="3" <?php if($samekeyword=="3") echo "SELECTED"; ?> >3</option>
						<option value="4" <?php if($samekeyword=="4") echo "SELECTED"; ?> >4</option>
						<option value="5" <?php if($samekeyword=="5") echo "SELECTED"; ?> >5</option>
						<option value="5" <?php if($samekeyword=="6") echo "SELECTED"; ?> >6</option>
						<option value="5" <?php if($samekeyword=="7") echo "SELECTED"; ?> >7</option>
						<option value="nolimit" <?php if($samekeyword=="nolimit") echo "SELECTED"; ?> >No limit</option>
					</select>                    
                    <br /><br />   
                    <span class="aal_label">Same link limit:</span> <select name="aal_samelink" id="aal_samelink" value="<?php echo $samelink ;?>" size="1" />
                    	<option value="1" <?php if($samelink=="1") echo "SELECTED"; ?> >1</option>
						<option value="2" <?php if($samelink=="2") echo "SELECTED"; ?> >2</option>
						<option value="3" <?php if($samelink=="3") echo "SELECTED"; ?> >3</option>
						<option value="4" <?php if($samelink=="4") echo "SELECTED"; ?> >4</option>
						<option value="5" <?php if($samelink=="5") echo "SELECTED"; ?> >5</option>
						<option value="6" <?php if($samelink=="6") echo "SELECTED"; ?> >6</option>
						<option value="7" <?php if($samelink=="7") echo "SELECTED"; ?> >7</option>
						<option value="nolimit" <?php if($samelink=="nolimit") echo "SELECTED"; ?> >No limit</option>
					</select>                    
                    <br /><br />  
                <span class="aal_label">Link distribution:</span> <select name="aal_linkdistribution" id="aal_linkdistribution" value="<?php echo $linkdistribution;?>" size="1" />
                    <option value="top" <?php if($linkdistribution=="top") echo "SELECTED"; ?> >Top</option>
						<?php /* <option value="bottom" <?php if($linkdistribution=="bottom") echo "SELECTED"; ?> >Bottom</option> */ ?>
						<option value="random" <?php if($linkdistribution=="random") echo "SELECTED"; ?> >Random</option>
					</select>                    
                    <br /><br />                
                    
                    
                    <span class="aal_label">Active post types:</span> 
                    <?php foreach($post_types as $pt) { ?>
                    	<input id="aal_displayc" type="checkbox" name="aal_displayc[]" value="<?php echo $pt; ?>" <?php if(in_array($pt,$displayc)) echo 'checked'; ?> /><?php echo $pt; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                    <!-- <select name="aal_display" id="aal_display" value="<?php echo $displayo; ?>" size="1" />
                  <option value="" <?php if($displayo=="") echo "SELECTED"; ?> >All content</option>
						<option value="post" <?php if($displayo=="post") echo "SELECTED"; ?> >Posts Only</option>
						<option value="page" <?php if($displayo=="page") echo "SELECTED"; ?> >Pages Only</option>

					</select>  -->                  
                    <br /><br />
                    
                    <span class="aal_label">Add links on: </span> <input type="checkbox" name="aal_showhome" id="aal_showhome" value="true" <?php echo $shse;?> /> Homepage 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="aal_showlist" id="aal_showlist" value="true" <?php echo $slse;?> /> Post listing pages ( category, tags, archives, etc ) 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="aal_showwidget" id="aal_showwidget" value="true" <?php echo $swse;?> /> Widget text 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="aal_showexcerpt" id="aal_showexcerpt" value="true" <?php echo $sese;?> /> Excerpt
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="aal_showhtags" id="aal_showhtags" value="true" <?php echo $shtagsse;?> /> Subtitles (H tags)
                    <br /><br />
                    
                     <span class="aal_label">Target:</span> <input type="radio" name="aal_target" value="_blank" <?php echo $tsc1;?> /> New window <input type="radio" name="aal_target" value="_self" <?php echo $tsc2 ;?>/> Same Window <br /><br />
 					

                    <?php //echo $relationo; ?>
                    <span class="aal_label">Link relation:</span> <input type="radio" name="aal_relation" value="nofollow" <?php echo $rsc1; ?> /> Nofollow <input type="radio" name="aal_relation" value="dofollow" <?php echo $rsc2 ;?>/> Dofollow <br /><br /><br />
                    
                    
                    <span class="aal_label">Cloak links:</span> <input type="checkbox" name="aal_iscloacked" id="aal_iscloacked" value="true" <?php echo $isc;?> /> 
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  Cloark url (optionl): <input type="text" id="aal_cloakurl" name="aal_cloakurl" value="<?php echo $cloakurl; ?>" />  Use with caution. Visit Settings -> Permalinks if you update this         
                    <br /><br />
                     					
                     					
                     					
                  <span class="aal_label">Link class :</span> <input type="text" name="aal_cssclass" id="aal_cssclass" value="<?php echo $cssclass; ?>" /> <br /><br /> 
				<span class="aal_label">Plugin status :</span>
					<select name="aal_pluginstatus" id="aal_pluginstatus" value="<?php echo $pluginstatus ;?>" size="1" >
						<option value="active" <?php if($pluginstatus=="active") echo "SELECTED"; ?> >Active</option>
						<option value="inactive" <?php if($pluginstatus=="inactive") echo "SELECTED"; ?> >Inactive</option>
					</select> <br /><br /> 
                    <span class="aal_label">International Language Support:</span> <input type="checkbox" name="aal_langsupport" id="aal_langsupport" value="true" <?php echo $langsc;?> /><br /><br />
                   
                   <p class="submit"> <input type="submit" class="button-primary"  value="Save Changes" /> </p>
                </form>
                <span class="aal_add_link_status"> </span>	
				</div>
				
				<div id="aal_settings_confirmation" style="display: none;position: fixed;top:45%;left:45%;background-color: #fff;padding: 50px;font-size: 20px;z-index: 900;border: 1px solid;">
						Settings Saved. <a href="javascript:;" onclick="document.getElementById('aal_settings_confirmation').style.display = 'none';" >Close</a>			
				</div>
				
				
	<br />
	<br />
<p>If you have problems or questions about the plugin, or if you just want to send a suggestion or request to our team, you can use the <a href="http://wordpress.org/support/plugin/wp-auto-affiliate-links">support forum</a>. Make sure that you consult our <a href="http://wordpress.org/plugins/wp-auto-affiliate-links/faq/">FAQ section</a> first. </p>
	
	</div>
	
	<?php
	
	 
}




?>