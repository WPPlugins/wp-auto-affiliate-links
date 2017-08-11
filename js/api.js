(function($) {

$(document).ready(function() { 

		//if(document.getElementById('aal_api_data')) { 
		
		$("div[id*='aal_api_data']").each(function() { //console.log(this.getAttribute('data-divnumber'));
			//datadiv = document.getElementById('aal_api_data');		
			var datadiv = this;
			var aal_divnumber = datadiv.getAttribute('data-divnumber');
			var aal_target = datadiv.getAttribute('data-target');
			var aal_relation = datadiv.getAttribute('data-relation');
			var aal_postid = datadiv.getAttribute('data-postid');
			var aal_apikey = datadiv.getAttribute('data-apikey');
			var aal_clickbankid = datadiv.getAttribute('data-clickbankid');
			var aal_clickbankgravity = datadiv.getAttribute('data-clickbankgravity');
			var aal_notimes = datadiv.getAttribute('data-notimes');
			var aal_clickbankcat = datadiv.getAttribute('data-clickbankcat');
			var aal_amazonlocal = datadiv.getAttribute('data-amazonlocal');
			var aal_amazonid = datadiv.getAttribute('data-amazonid');
			var aal_amazoncat = datadiv.getAttribute('data-amazoncat');
			var aal_amazonactive = datadiv.getAttribute('data-amazonactive');
			var aal_clickbankactive = datadiv.getAttribute('data-clickbankactive');
			var aal_shareasaleid = datadiv.getAttribute('data-shareasaleid');
			var aal_shareasaleactive = datadiv.getAttribute('data-shareasaleactive');
			var aal_cjactive = datadiv.getAttribute('data-cjactive');
			var aal_ebayactive = datadiv.getAttribute('data-ebayactive');
			var aal_ebayid = datadiv.getAttribute('data-ebayid');
			var aal_bestbuyactive = datadiv.getAttribute('data-bestbuyactive');
			var aal_bestbuyid = datadiv.getAttribute('data-bestbuyid');
			var aal_walmartactive = datadiv.getAttribute('data-walmartactive');
			var aal_walmartid = datadiv.getAttribute('data-walmartid');
			var aal_envatoid = datadiv.getAttribute('data-envatoid');
			var aal_envatosite = datadiv.getAttribute('data-envatosite');
			var aal_envatoactive = datadiv.getAttribute('data-envatoactive');
			var aal_aurl = datadiv.getAttribute('data-aurl');
			var aal_excludewords = datadiv.getAttribute('data-excludewords');
			// aal_content = datadiv.getAttribute('data-content');
			var aal_content = encodeURIComponent(document.getElementById('aalcontent_' + aal_divnumber).parentNode.innerHTML);
			//aalapidata = datadiv.getAttribute('data-apidata');		
			
			//console.log(aal_divnumber);
			//console.log(aal_content);
			
			
			var aalapidata = {content: aal_content, apikey: aal_apikey, clickbankid: aal_clickbankid, clickbankcat: aal_clickbankcat,  clickbankgravity: aal_clickbankgravity, amazonid: aal_amazonid, amazoncat: aal_amazoncat, amazonlocal: aal_amazonlocal, amazonactive: aal_amazonactive, clickbankactive: aal_clickbankactive, shareasaleactive: aal_shareasaleactive, shareasaleid: aal_shareasaleid, cjactive: aal_cjactive, ebayactive: aal_ebayactive, ebayid: aal_ebayid, bestbuyactive: aal_bestbuyactive, bestbuyid: aal_bestbuyid, walmartactive: aal_walmartactive, walmartid: aal_walmartid, envatoid: aal_envatoid, envatosite: aal_envatosite, envatoactive: aal_envatoactive, aurl: aal_aurl, notimes: aal_notimes, excludewords: aal_excludewords};

		
			aal_retrievelinks(aalapidata,aal_divnumber,aal_target,aal_relation);
		
	//}
		});
		 });




function aal_retrievelinks(aalapidata,aal_divnumber,aal_target,aal_relation) {
	
	//console.log(aalapidata);

	//aalapidata = {action: 'aal_update_exclude_posts',aal_exclude_posts:'aaa'};
 $.ajax({
                    type: "POST",
                    url: "//autoaffiliatelinks.com/api/pro.php",
                    data: aalapidata,
                    cache: false,
                    success: function(returned){
                    console.log('succes');   
                    console.log(returned);

	var datadiv = document.getElementById('aal_api_data');
	var cssclass = datadiv.getAttribute('data-cssclass');
	
                    
	var parray = $.parseJSON(returned);
	var spydiv = document.getElementById('aalcontent_' + aal_divnumber);
	var parentdiv = spydiv.parentNode;
	if(parentdiv.innerHTML == '<div id="aalcontent_' + aal_divnumber + '></div>') parentdiv = parentdiv.parentNode;
	var acontent = parentdiv.innerHTML;
	
	parray.forEach(function(entry) {
		
	var re2 = new RegExp("(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/a>))\\b("+ entry.key +")\\b","i");
	var re = new RegExp("(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/a>))(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/h.>))(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/script.>))\\b("+ entry.key +")\\b","i");
	acontent = acontent.replace(re, '<a title="$1" class="aalauto '+ cssclass +'" target="' + aal_target + '" ' + '" rel="' + aal_relation + '" ' + ' href="'+ entry.url +'">$1</a>');	    
	    
	    
	    
	    
	});
	

		
	parray.forEach(function(entry) {
		
		//console.log(entry);
		
		$('ul.aal_widget_holder').each(function(i, obj) {
    		$( this ).append( '<li><a href="' + entry.url + '">' + entry.key + '</a></li>' );
		});    
	    
	    
	    
	    
	});

	
	//console.log(parray[0]);



	var reg = '/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))\b($name)\b/imsU';
	var rep = '<a title="$1" class="aal" target="$targeto" relation="$relo" href="$url">$1</a>';


	parentdiv.innerHTML = acontent;

	//Re-add lazy loading lost functionality

		if ($('img[data-lazy-src]').length) {

			$( 'img[data-lazy-src]' ).bind( 'scrollin', { distance: 200 }, function() {
				sbp_lazy_load_init( this );
			});
		
		}


                    
     }
     
   });
   
   
}



	function sbp_lazy_load_init( img ) {
		var $img = jQuery( img ),
			src = $img.attr( 'data-lazy-src' );

		$img.unbind( 'scrollin' ) // remove event binding
			.hide()
			.removeAttr( 'data-lazy-src' )
			.attr( 'data-lazy-loaded', 'true' );

		img.src = src;
		$img.fadeIn();
	}

})(jQuery);