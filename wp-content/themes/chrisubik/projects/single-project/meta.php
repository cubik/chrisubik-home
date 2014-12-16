<?php
/**
 * Single Project Meta
 *
 * @author 		WooThemes
 * @package 	Projects/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
?>
<div class="project-meta">

	<?php
		// Categories
		$terms_as_text 	= get_the_term_list( $post->ID, 'project-category', '<li>', '</li><li>', '</li>' );

		// Meta
		$client 		= esc_attr( get_post_meta( $post->ID, '_client', true ) );
		$url 			= esc_url( get_post_meta( $post->ID, '_url', true ) );

        /**
		 * Display featured image if set
		 */


		 if ( has_post_thumbnail() ) {

			$image       		= get_the_post_thumbnail( $post->ID, 'project-single' );
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( projects_get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[project-gallery]';
			} else {
				$gallery = '';
			}

			if ( apply_filters( 'projects_gallery_link_images', true ) ) {
				echo '<a href="' . $image_link . '" title="' . $image_title . '">' . $image . '</a>';
			} else {
				echo $image;
			}

		}

		/**
		 * Display categories if they're set
		 */


		if ( $terms_as_text ) {
			echo '<div class="categories">';
			echo '<h3>' . __( 'Categories', 'projects-by-woothemes' ) . '</h3>';
			echo '<ul class="single-project-categories">';
			echo $terms_as_text;
			echo '</ul>';
			echo '</div>';
		}

		/**
		 * Display client if set
		 */
		if ( $client ) {
			echo '<div class="client">';
			echo '<h3>' . __( 'Client', 'projects-by-woothemes' ) . '</h3>';
			echo '<span class="client-name">' . $client . '</span>';
			echo '</div>';
		}

		/**
		 * Display link if set
		 */
		if ( $url ) {
			echo '<div class="url">';
			echo '<h3>' . __( 'Link', 'projects-by-woothemes' ) . '</h3>';
			echo '<span class="project-url"><a href="' . $url . '">' . apply_filters( 'projects_visit_project_link', __( 'Visit project', 'projects-by-woothemes' ) ) . '</a></span>';
			echo '</div>';
		}
	?>
</div>