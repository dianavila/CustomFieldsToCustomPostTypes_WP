<?php 
/*
Template Name: create Children porifles
*/

	$args = array( 
			
			'p' => 893, /*post id*/
			'post_type' => 'page',
			'posts_per_page' => -1	/*brings all post*/		
		);
	$loop = new WP_Query( $args );
?>
<?php while ($loop->have_posts() ) : $loop->the_post(); ?>
				
				<h3 ><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><!--just for confirmation-->

				<?php
					if(get_field('child_profile'))/* repeater field*/
	                {
	                    while(has_sub_field('child_profile')){
	                        $picture = get_sub_field('picture');
	                        $name = get_sub_field('name');
	                        $content = get_sub_field('content');

	                        // preparign parameters to create post in database
	                        $my_post = array(
							  'post_title'    => $name,
							  'post_type'	  => 'children_profile',
							  'post_content'  => $content,
							  'post_status'   => 'publish',
							  'post_author'   => 1

							);

							// Insert the post into the database
							$child_id = wp_insert_post( $my_post );
							set_post_thumbnail( $child_id, $picture );
							update_post_meta($child_id, 'country', '');/*Custom field assigned to this custum post type*/
							update_post_meta($child_id, 'category', '');/*Custom field assigned to this custum post type*/

						}
					}
	            ?>

				
				
<?php endwhile; ?>