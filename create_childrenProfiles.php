<?php 
/*
Template Name: create Children porifles
*/

	$args = array( 
			// 'post_parent' => 357,
			'p' => 893,
			'post_type' => 'page',
			'posts_per_page' => -1			
		);
	$loop = new WP_Query( $args );
?>
<?php while ($loop->have_posts() ) : $loop->the_post(); ?>
				
				<h3 style="margin-top:15px;" class="orange-text"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>

				<?php
					if(get_field('child_profile'))
	                {
	                    while(has_sub_field('child_profile')){
	                        $picture = get_sub_field('picture');
	                        $name = get_sub_field('name');
	                        $content = get_sub_field('content');

	                        // insert post
	                        $my_post = array(
							  'post_title'    => $name,
							  'post_type'	  => 'children_profile',
							  'post_content'  => $content,
							  'post_status'   => 'publish',
							  'post_author'   => 1

							  //'post_category' => array(41)
							  //'tax_input'      => array('country_profile' => array(41))  // For custom taxonomies. Default empty. 
							);

							// Insert the post into the database
							$child_id = wp_insert_post( $my_post );
							set_post_thumbnail( $child_id, $picture );
							update_post_meta($child_id, 'country', 'Palestinian Authority');
							update_post_meta($child_id, 'category', 'Children We Help');

						}
					}
	            ?>

				
				
<?php endwhile; ?>