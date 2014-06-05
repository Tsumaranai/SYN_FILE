<?php
/*
Plugin Name: TablePress Extension: Automatic URL conversion
Plugin URI: http://tablepress.org/extensions/automatic-url-conversion/
Description: Custom Extension for TablePress to automatically make URLs (www, ftp, and email) in table cells clickable
Version: 1.3
Author: Tobias Bäthge
Author URI: http://tobias.baethge.com/
*/

// Usage: [table id=1 automatic_url_conversion=true automatic_url_conversion_new_window=true automatic_url_conversion_rel_nofollow=true /]

add_filter( 'tablepress_table_output', 'tablepress_auto_url_conversion', 10, 3 );
add_filter( 'tablepress_shortcode_table_default_shortcode_atts', 'tablepress_add_shortcode_parameter_auto_url_conversion' );

/**
 * Add Extension's parameters as a valid parameters to the [table /] Shortcode
 */
function tablepress_add_shortcode_parameter_auto_url_conversion( $default_atts ) {
	$default_atts['automatic_url_conversion'] = false;
	$default_atts['automatic_url_conversion_new_window'] = false;
	$default_atts['automatic_url_conversion_rel_nofollow'] = false;
	$default_atts['people_hyperlink'] = false;
	$default_atts['paper_hyperlink'] = false;
	$default_atts['people_name'] = 'false';
	return $default_atts;
}

/**
 * Convert URLs to links, if Shortcode parameter is set,
 * Add target attribute in http(s):// links,
 * or Add rel attribute, if Shortcode parameter is set
 */
function tablepress_auto_url_conversion ( $output, $table, $render_options ) {
	if ( $render_options['automatic_url_conversion'] ){
		//print htmlentities( $output );
		
		$output = make_clickable( $output );
		//print htmlentities( $output );
	}
	if ( $render_options['automatic_url_conversion_new_window'] && $render_options['automatic_url_conversion_rel_nofollow'] )
		$output = str_replace( '<a href="http', '<a target="_blank" rel="nofollow" href="http', $output );
	elseif ( $render_options['automatic_url_conversion_new_window'] )
		$output = str_replace( '<a href="http', '<a target="_blank" href="http', $output );
	elseif ( $render_options['automatic_url_conversion_rel_nofollow'] )
		$output = str_replace( '<a href="http', '<a rel="nofollow" href="http', $output );
		
		
		
	/*
	*The following is what I add~
	*/	
		
		
		
		
		

	if( $render_options['people_hyperlink'] ){
	
		preg_match_all( '/(?<=<td class="column-1">).+?(?=<\/td>)/', $output, $match);
		/*column-1 is the name column*/
		//print_r( $match );
		foreach( $match[0] as $k => $v){
		/*数组0就是所有匹配的人名的数组*/
		
			//print htmlentities($v);
			//echo "</br>";
			$output = str_replace( $v, '<a href="./'.$v.'">'.$v.'</a>' , $output);
			
		}
	}	
	
	if($render_options['paper_hyperlink']){
		
		//change title to hyperlink
		preg_match_all( '/(?<=<td class="column-1">).+?(?=<\/td>)/', $output, $match_title);
		
		//var_dump($match_title);
		foreach( $match_title[0] as $k => $v){
		
			$output = str_replace( $v, '<a href="./'.$v.'">'.$v.'</a>', $output);
		}
		
		//change author to hyperlink
		preg_match_all( '/(?<=<td class="column-2">).+?(?=<\/td>)/', $output, $match);
		//var_dump($match);
		foreach( $match[0] as $k => $v){
		
			$name = split('[;.\ ,]',$v);
			//var_dump($name);
			foreach($name as $kn => $vn){
				
				$output = preg_replace( '/'.$vn.'(?=[;.\ ,])'.'|'.$vn.'(?=<\/td>)'.'/', '<a href="../../人员简介/学生/'.$vn.'">'.$vn.'</a>', $output);
				/*匹配姓名后面是";"或者是后面是"<\td>"的姓名。这样匹配不会造成混乱。*/
			}
		}
		
		preg_match_all( '/<td class="column-6">.*?<\/td>/', $output, $match);
		//var_dump($match);
		foreach( $match[0] as $k => $v){
		
			$output = str_replace( $v,'<td class="column-6"><a href="http://localhost/wordpress/download/'.$match_title[0][$k].'.pdf">点击下载</a></td>' , $output);
		}
		
	}
	
	
	
	return $output;
}
