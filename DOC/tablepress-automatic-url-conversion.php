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

/*
 * Add Extension's parameters as a valid parameters to the [table /] Shortcode
 */
function tablepress_add_shortcode_parameter_auto_url_conversion( $default_atts ) {
	$default_atts['automatic_url_conversion'] = false;
	$default_atts['automatic_url_conversion_new_window'] = false;
	$default_atts['automatic_url_conversion_rel_nofollow'] = false;
	$default_atts['people_hyperlink'] = false;
	$default_atts['paper_hyperlink'] = false;
	$default_atts['people_name'] = false;
	$default_atts['project_name'] = false;
	$default_atts['paper_title']=false;
	$default_atts['people_info']=false;
	return $default_atts;
}

/**
 * Convert URLs to links, if Shortcode parameter is set,
 * Add target attribute in http(s):// links,
 * or Add rel attribute, if Shortcode parameter is set
 */
 
 
 
function tablepress_auto_url_conversion ( $output, $table, $render_options ) {
	
	/*
	*you can change the url_address when the network enviorment changed
	*meanwhile there's any staff adjustions, remember to modify the staff_group array;
	*/
	$url_address = "http://10.13.30.143/wordpress/";
	
	
	if ( $render_options['automatic_url_conversion'] ){
		//print htmlentities( $output );
		
		$output = make_clickable( $output );
		//print htmlentities( $output );
		//print $output;
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
	$pos_name = $render_options['people_info'];
	
	if( !is_bool($pos_name) ){
		/*如果不是false而是人员信息,就处理*/
		
			preg_match_all( '/<tr class="row-.+?>\n.+\n<\/tr>/', $output, $match);
			
			//var_dump($match);
			
			foreach($match[0] as $k => $v){
				
				if( $k == 0 )
					continue;		/*第一个是标题不用匹配*/
				if(strpos($v, $pos_name) === false){
				
					$output = str_replace( $v, '', $output);
				}
			}
		
	}
	
	$p_name = $render_options['people_name'];
	

	if( !is_bool($p_name) ){
		/*如果不是false而是姓名（string）,就处理*/
		
			preg_match_all( '/<tr class="row-.+?>\n.+\n<\/tr>/', $output, $match);
			
			//var_dump($match);
			
			foreach($match[0] as $k => $v){
				
				if( $k == 0 )
					continue;		/*第一个是标题不用匹配*/
				if(strpos($v, $p_name) === false){
				
					$output = str_replace( $v, '', $output);
				}
			}
		
	}
	
	$p_name = $render_options['project_name'];
	if( !is_bool($p_name) ){
		/*如果不是false而是项目名（string）,就处理*/
		
			preg_match_all( '/<tr class="row-.+?>\n.+\n<\/tr>/', $output, $match);
			
			//var_dump($match);
			
			foreach($match[0] as $k => $v){
				
				if( $k == 0 )
					continue;		/*第一个是标题不用匹配*/
				if(strpos($v, $p_name) === false){
				
					$output = str_replace( $v, '', $output);
				}
			}
		
	}
	

	$p_name = $render_options['paper_title'];
	
	if( !is_bool($p_name) ){
		/*如果不是false而是项目名（string）,就处理*/
		
			preg_match( '/<tr class="row-.+?>\n.+'.$p_name.'.+<\/td>/', $output, $match);
			
			//var_dump($match);
			preg_match( '/<td class="column-1">.+?<\/td>/', $match[0], $tmp);
			$output = '<!--'.$tmp[0].'-->';
			
			preg_match( '/<td class="column-2">.+?<\/td>/', $match[0], $tmp);
			//column-2 stands for author
			
			$output .= '论文作者：'.$tmp[0].'<br/>';
			preg_match( '/<td class="column-3">.+?<\/td>/', $match[0], $tmp);
			
			$output .= '发表年份：'.$tmp[0].'<br/>';
			
			preg_match( '/<td class="column-4">.+?<\/td>/', $match[0], $tmp);
			
			$output .= '发表会议期刊：'.$tmp[0].'<br/>';
			
			preg_match( '/<td class="column-5">.*?<\/td>/', $match[0], $tmp);
			
			$output .= '下载链接：'.$tmp[0].'<br/>';
			
			preg_match( '/<td class="column-6">.+?<\/td>/', $match[0], $tmp);
			
			$output .= '相关项目：'.$tmp[0].'<br/>';
	}

	if( $render_options['people_hyperlink'] ){
	
		preg_match_all( '/(?<=<td class="column-1">).+?(?=<\/td>)/', $output, $match);
		/*column-1 is the name column*/
		
		foreach( $match[0] as $k => $v){
		/*数组0就是所有匹配的人名的数组*/
		
			//print htmlentities($v);
			//echo "</br>";
				$output = str_replace( $v, '<a href="'.$url_address.$v.'">'.$v.'</a>' , $output);
			
		}
	}	
	
	if($render_options['paper_hyperlink']){
		
		
		//change title to hyperlink
		//print htmlentities( $output );
		preg_match_all( '/(?<=<td class="column-1">).+?(?=<\/td>)/', $output, $match_title);
		//生成论文超链接
		//var_dump($match_title);
		foreach( $match_title[0] as $k => $v){
		
			$output = str_replace( $v, '<a href="'.$url_address.$v.'">'.$v.'</a>', $output);
		}
		
		//'<a href="../../科研成果/学术论文/'.$vn.'">'.$vn.'</a>'
		//change author to hyperlink
		preg_match_all( '/(?<=<td class="column-2">).+?(?=<\/td>)/', $output, $match);
		//生成人员超链接
		//var_dump($match);
		$table_info = TablePress::$controller->model_table->load( 1 );
	/*
	*
	*this function is so improtant, I should search the thread earlier!!
	*1 means table_id people infomation was stored in table 1
	*/
		//var_dump( $table_info );
		
		foreach( $table_info['data'] as $k => $v){
			
			if( $k == 0)
				continue;//first is title
			$staff_group[($k - 1)] = $v[0];
			//$v[0] array 0 is stored by name
		}
		
		foreach( $match[0] as $k => $v){
		
			$name = split('[;.\ ,]',$v);
			//var_dump($name);
			foreach($name as $kn => $vn){
				
				if(in_array( $vn, $staff_group))
					$output = preg_replace( '/'.$vn.'(?=[;.\ ,])'.'|'.$vn.'(?=<\/td>)'.'/', '<a href="'.$url_address.$vn.'">'.$vn.'</a>', $output);
				/*匹配姓名后面是";"或者是后面是"<\td>"的姓名。这样匹配不会造成混乱。*/
			}
		}
		
		preg_match_all( '/<td class="column-5">.*?<\/td>/', $output, $match);
		//生成下载超链接
		//var_dump( $match_title[0] );
		//var_dump($match);
		foreach( $match[0] as $k => $v){
			
			$v = str_replace('/','\/',$v);
			//str_replace在这里做字符串转义
			$output = preg_replace( '/'.$v.'/','<td class="column-5"><a href="'.$url_address.'download/'.$match_title[0][$k].'.pdf">点击预览下载</a></td>' , $output, 1);
			//preg_replace可以每次只替换一个
		}
		
		
		//生成项目超链接
		preg_match_all( '/(?<=<td class="column-6">).+?(?=<\/td>)/', $output, $match);
		
		//var_dump($match);
		foreach( $match[0] as $k => $v){
		
			$pro_name = split('[;.\ ,]',$v);
			//var_dump($pro_name);
			foreach($pro_name as $kn => $vn){
				
				$output = preg_replace( '/'.$vn.'(?=[;.\ ,])'.'|'.$vn.'(?=<\/td>)'.'/', '<a href="'.$url_address.'项目介绍/'.$vn.'">'.$vn.'</a>', $output);
				/*匹配姓名后面是";"或者是后面是"<\td>"的姓名。这样匹配不会造成混乱。*/
			}
		}
		
	
		
	}//end of paper_hyperlink
	
	
	return $output;
}
