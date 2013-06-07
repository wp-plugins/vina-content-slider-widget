<?php
/*
Plugin Name: Vina Content Slider Widget
Plugin URI: http://VinaThemes.biz
Description: Showing off the best content of your website in a nice intuitive way will surely catch more eyeballs.
Version: 1.0
Author: VinaThemes
Author URI: http://VinaThemes.biz
Author email: mr_hiennc@yahoo.com
Demo URI: http://VinaDemo.biz
Forum URI: http://VinaForum.biz
License: GPLv3+
*/

//Defined global variables
if(!defined('VINA_CSLIDER_DIRECTORY')) 		define('VINA_CSLIDER_DIRECTORY', dirname(__FILE__));
if(!defined('VINA_CSLIDER_INC_DIRECTORY')) 	define('VINA_CSLIDER_INC_DIRECTORY', VINA_CSLIDER_DIRECTORY . '/includes');
if(!defined('VINA_CSLIDER_URI')) 			define('VINA_CSLIDER_URI', get_bloginfo('url') . '/wp-content/plugins/vina-cslider-widget');
if(!defined('VINA_CSLIDER_INC_URI')) 		define('VINA_CSLIDER_INC_URI', VINA_CSLIDER_URI . '/includes');

//Include library
if(!defined('TCVN_FUNCTIONS')) {
    include_once VINA_CSLIDER_INC_DIRECTORY . '/functions.php';
    define('TCVN_FUNCTIONS', 1);
}
if(!defined('TCVN_FIELDS')) {
    include_once VINA_CSLIDER_INC_DIRECTORY . '/fields.php';
    define('TCVN_FIELDS', 1);
}

class CSlider_Widget extends WP_Widget 
{
	function CSlider_Widget()
	{
		$widget_ops = array(
			'classname' => 'cslider_widget',
			'description' => __("Showing off the best content of your website in a nice intuitive way will surely catch more eyeballs.")
		);
		$this->WP_Widget('cslider_widget', __('Vina Content Slider Widget'), $widget_ops);
	}
	
	function form($instance)
	{
		$instance = wp_parse_args( 
			(array) $instance, 
			array( 
				'title' 			=> '',
				'categoryId' 		=> '',
				'noItem' 			=> '5',
				'ordering' 			=> 'id',
				'orderingDirection' => 'desc',
				
				'width'			=> '400',
				'height'		=> '250',
				'tabWidth'		=> '250',
				'tabHeight'		=> '60',
				'thumbW'		=> '80',
				'thumbH'		=> '50',
				'autoRun'		=> 'yes',
				'duration'		=> '5000',
				
				'showTitle'		=> 'yes',
				'showImage'		=> 'yes',
				'imageWidth'	=> '600',
				'imageHeight'	=> '200',
				'showContent'	=> 'yes',
				'readmore'		=> 'yes',
			)
		);

		$title			= esc_attr($instance['title']);
		$categoryId		= esc_attr($instance['categoryId']);
		$noItem			= esc_attr($instance['noItem']);
		$ordering		= esc_attr($instance['ordering']);
		$orderingDirection = esc_attr($instance['orderingDirection']);
		
		$width		= esc_attr($instance['width']);
		$height		= esc_attr($instance['height']);
		$tabWidth	= esc_attr($instance['tabWidth']);
		$tabHeight	= esc_attr($instance['tabHeight']);
		$thumbW		= esc_attr($instance['thumbW']);
		$thumbH		= esc_attr($instance['thumbH']);
		$autoRun	= esc_attr($instance['autoRun']);
		$duration	= esc_attr($instance['duration']);
		
		$showTitle		= esc_attr($instance['showTitle']);
		$showImage		= esc_attr($instance['showImage']);
		$showContent	= esc_attr($instance['showContent']);
		$readmore		= esc_attr($instance['readmore']);
		?>
        <div id="tcvn-timeline" class="tcvn-plugins-container">
            <div style="color: red; padding: 0px 0px 10px; text-align: center;">You are using free version ! <a href="http://vinathemes.biz/commercial-plugins/item/28-vina-content-slider-widget.html" title="Download full version." target="_blank">Click here</a> to download full version.</div>
            <div id="tcvn-tabs-container">
                <ul id="tcvn-tabs">
                    <li class="active"><a href="#basic"><?php _e('Basic'); ?></a></li>
                    <li><a href="#display"><?php _e('Display'); ?></a></li>
                    <li><a href="#advanced"><?php _e('Advanced'); ?></a></li>
                </ul>
            </div>
            <div id="tcvn-elements-container">
                <!-- Basic Block -->
                <div id="basic" class="tcvn-telement" style="display: block;">
                    <p><?php echo eTextField($this, 'title', 'Title', $title); ?></p>
                    <p><?php echo eSelectOption($this, 'categoryId', 'Category', buildCategoriesList('Select all Categories.'), $categoryId); ?></p>
                    <p><?php echo eTextField($this, 'noItem', 'Number of Post', $noItem, 'Number of posts to show. Default is: 5.'); ?></p>
                	<p><?php echo eSelectOption($this, 'ordering', 'Post Field to Order By', 
						array('id'=>'ID', 'title'=>'Title', 'comment_count'=>'Comment Count', 'post_date'=>'Published Date'), $ordering); ?></p>
                    <p><?php echo eSelectOption($this, 'orderingDirection', 'Ordering Direction', 
						array('asc'=>'Ascending', 'desc'=>'Descending'), $orderingDirection, 
						'Select the direction you would like Articles to be ordered by.'); ?></p>
                </div>
                <!-- Display Block -->
                <div id="display" class="tcvn-telement">
                	<p><?php echo eTextField($this, 'width', 'Content Width', $width); ?></p>
                    <p><?php echo eTextField($this, 'height', 'Content Height', $height); ?></p>
                    <p><?php echo eTextField($this, 'tabWidth', 'Tab Width', $tabWidth); ?></p>
                    <p><?php echo eTextField($this, 'tabHeight', 'Tab Height', $tabHeight); ?></p>
                    <p><?php echo eTextField($this, 'thumbW', 'Thumbnail Width', $thumbW); ?></p>
                    <p><?php echo eTextField($this, 'thumbH', 'Thumbnail Height', $thumbH); ?></p>
                    <p><?php echo eSelectOption($this, 'autoRun', 'Auto Rotate', 
						array('yes'=>'Yes', 'no'=>'No'), $autoRun); ?></p>
                    <p><?php echo eTextField($this, 'duration', 'Time Duration (ms)', $duration); ?></p>
                </div>
                <!-- Advanced Block -->
                <div id="advanced" class="tcvn-telement">
                    <p><?php echo eSelectOption($this, 'showTitle', 'Post Title', 
						array('yes'=>'Show post title', 'no'=>'Hide post title'), $showTitle); ?></p>
                    <p><?php echo eSelectOption($this, 'showImage', 'Show Thumbnail', 
						array('yes'=>'Yes', 'no'=>'No'), $showImage); ?></p>
                    <p><?php echo eSelectOption($this, 'showContent', 'Post Content', 
						array('yes'=>'Show post content', 'no'=>'Hide post content'), $showContent); ?></p>
                    <p><?php echo eSelectOption($this, 'readmore', 'Readmore', 
						array('yes'=>'Show readmore button', 'no'=>'Hide readmore button'), $readmore); ?></p>
                </div>
            </div>
        </div>
		<script>
			jQuery(document).ready(function($){
				var prefix = '#tcvn-timeline ';
				$(prefix + "li").click(function() {
					$(prefix + "li").removeClass('active');
					$(this).addClass("active");
					$(prefix + ".tcvn-telement").hide();
					
					var selectedTab = $(this).find("a").attr("href");
					$(prefix + selectedTab).show();
					
					return false;
				});
			});
        </script>
		<?php
	}
	
	function update($new_instance, $old_instance) 
	{
		return $new_instance;
	}
	
	function widget($args, $instance) 
	{
		extract($args);
		
		$title 			= getConfigValue($instance, 'title',		'');
		$categoryId		= getConfigValue($instance, 'categoryId',	'');
		$noItem			= getConfigValue($instance, 'noItem',		'5');
		$ordering		= getConfigValue($instance, 'ordering',		'id');
		$orderingDirection = getConfigValue($instance, 'orderingDirection',	'desc');
		
		$width			= getConfigValue($instance, 'width',  '400');
		$height			= getConfigValue($instance, 'height', '250');
		$tabWidth		= getConfigValue($instance, 'tabWidth', '250');
		$tabHeight		= getConfigValue($instance, 'tabHeight', '60');
		$thumbW 		= getConfigValue($instance, 'thumbW', '80');
		$thumbH 		= getConfigValue($instance, 'thumbH', '50');
		$autoRun 		= getConfigValue($instance, 'autoRun', 'yes');
		$duration 		= getConfigValue($instance, 'duration', '5000');
		
		$showTitle		= getConfigValue($instance, 'showTitle',	'yes');
		$showImage		= getConfigValue($instance, 'showImage',	'yes');
		$showContent	= getConfigValue($instance, 'showContent',	'yes');
		$readmore		= getConfigValue($instance, 'readmore',		'yes');
		
		$params = array(
			'numberposts' 	=> $noItem, 
			'category' 		=> $categoryId, 
			'orderby' 		=> $order,
			'order' 		=> $orderingDirection,
		);
		
		if($categoryId == '') {
			$params = array(
				'numberposts' 	=> $noItem, 
				'orderby' 		=> $order,
				'order' 		=> $orderingDirection,
			);
		}
		
		$posts 	 = get_posts($params);
		
		echo $before_widget;
		
		if($title) echo $before_title . $title . $after_title;
		
		if(!empty($posts)) :
		
		$tabs 	  = '';
		$elements = '';
		$i = 0;
		foreach($posts as $post) 
		{
			$thumbnailId = get_post_thumbnail_id($post->ID);				
			$thumbnail 	 = wp_get_attachment_image_src($thumbnailId, '70x45');	
			$altText 	 = get_post_meta($thumbnailId, '_wp_attachment_image_alt', true);
			$commentsNum = get_comments_number($post->ID);
			$postTitle   = $post->post_title;
			$largeImage  = VINA_CSLIDER_INC_URI . '/timthumb.php?w='.$width.'&h='.$height.'&a=c&q=99&z=0&src=';
			$smallImage  = VINA_CSLIDER_INC_URI . '/timthumb.php?w='.$thumbW.'&h='.$thumbH.'&a=c&q=99&z=0&src=';
			$link   = get_permalink($post->ID);
			$text   = explode('<!--more-->', $post->post_content);
			$sumary = $text[0];
			
			$tabs .= '<li class="ui-tabs-nav-item " id="nav-fragment-'.$i.'">';
				$tabs .= '<a href="#fragment-'.$i.'">';
					$tabs .= ($showImage == 'yes') ? '<img src="'.$smallImage.$thumbnail[0].'" alt="'.$postTitle.'" />' : '';
					$tabs .= '<span>'.$postTitle.'</span>';
				$tabs .= '</a>';
			$tabs .= '</li>';
			
			$elements .= '<div id="fragment-'.$i.'" class="ui-tabs-panel" style="">';
				$elements .= '<img src="'.$largeImage.$thumbnail[0].'" alt="'.$postTitle.'" />';
				$elements .= '<div class="info">';
					$elements .= ($showTitle == 'yes') ? '<h2><a href="'.$link.'" title="'.$postTitle.'">'.$postTitle.'</a></h2>' : '';
					$elements .= ($showContent == 'yes') ? '<p>'.$sumary . (($readmore == 'yes') ? '... <a href="'.$link.'" title="'.$postTitle.'">Readmore</a>' : '').'</p>' : '';
				$elements .= '</div>';
			$elements .= '</div>';
			
			$i++;
		}
		?>
        <style type="text/css">
			#vina-cslider-container {
				width:<?php echo $width; ?>px; 
				padding-right:<?php echo $tabWidth; ?>px;
				height:<?php echo $height; ?>px;
			}
			#vina-cslider-container ul.ui-tabs-nav {
				left:<?php echo $width; ?>px;
				width:<?php echo $tabWidth; ?>px; 
				height:<?php echo $height; ?>px;
			}
			#vina-cslider-container li.ui-tabs-nav-item a {
				height:<?php echo $tabHeight; ?>px; 
			}
			#vina-cslider-container .ui-tabs-panel {
				width:<?php echo $width; ?>px; 
				height:<?php echo $height; ?>px;
			}
		</style>
        <div id="vina-cslider-container" class="vina-cslider-container">
            <ul class="ui-tabs-nav">
                <?php echo $tabs; ?>
            </ul>
			<?php echo $elements; ?>    
		</div>
        <div id="tcvn-copyright">
        	<a href="http://vinathemes.biz" title="Free download Wordpress Themes, Wordpress Plugins - VinaThemes.biz">Free download Wordpress Themes, Wordpress Plugins - VinaThemes.biz</a>
        </div>
        <script type="text/javascript">
			jQuery(document).ready(function($){
				<?php if($autoRun == 'yes') { ?>
				$("#vina-cslider-container").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);  
				<?php } else { ?>
				$("#vina-cslider-container").tabs({fx:{opacity: "toggle"}});
				<?php } ?>
			});
		</script>
		<?php
		endif;
		
		echo $after_widget;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CSlider_Widget");'));
wp_enqueue_style('vina-admin-css', VINA_CSLIDER_INC_URI . '/admin/css/style.css', '', '1.0', 'screen' );
wp_enqueue_script('vina-tooltips', VINA_CSLIDER_INC_URI . '/admin/js/jquery.simpletip-1.3.1.js', 'jquery', '1.0', true);

wp_enqueue_style('vina-cslider-css', 	 VINA_CSLIDER_INC_URI . '/css/style.css', '', '1.0', 'screen' );
wp_enqueue_script("jquery");
wp_enqueue_script("jquery-ui-tabs");
wp_enqueue_script('vina-cslider-tabs', 	 VINA_CSLIDER_INC_URI . '/js/jquery-ui-tabs-rotate.js', 'jquery', '1.0', true);
?>