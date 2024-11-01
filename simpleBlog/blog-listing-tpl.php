<?php
/**
 * Template Name: Blog Listing page
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

<?php while(have_posts()):the_post(); ?>

<!-- banner -->
<?php
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

?>
<?php $getC = get_the_content(); ?>
<?php if($getC !=""){ ?>
<div class="bannerSB" style="background-image:url(<?php echo $feat_image; ?>);">
<div class="container">	
		<?php the_content(); ?>
	</div>
</div>
<?php } ?>

	<!-- technology-left -->
	<div class="technology">
	<div class="container">
		<div class="col-md-9 technology-left">
		<div class="tech-no">
			<!-- technology-top -->
			
			 <div class="tc-ch wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
				<?php $querySB=1; query_posts("post_type=blog&showposts=5"); ?>
				<?php while(have_posts()):the_post(); ?>
					<div class="tch-img <?php if($querySB > 1){ echo "SBT"; } ?>">
											<?php $image_id = get_post_meta( $post->ID, '_listing_image_id_750_350', true );
				  $thumbnail_html = wp_get_attachment_image( $image_id, array( 750, 350 ) , '' , array('class' => 'img-responsive' ));
			?>
				<?php if($thumbnail_html !=""){  ?>
					<a href="<?php the_permalink(); ?>" title="Go for quick read"><?php echo $thumbnail_html; ?></a>
				<?php } ?>
					</div>
					
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h6>BY <a href="javascript:void(0)"><?php $getSBAuth = get_post_meta($post->ID , '_simple_author' , true); ?><?php if($getSBAuth !=""){ echo $getSBAuth; } else { the_author(); } ?></a><?php $getSBPubDateCal = get_post_meta($post->ID , '_simple_pub_cal' , true);
					  $getSBPubDateMan = get_post_meta($post->ID , '' , true);
					  $getSBPubDateWord    = get_the_date('d-m-Y'); 


				 if($getSBPubDateCal !="" && $getSBPubDateManAug !="" && $getSBPubDateWord !=""){ echo $etSBPubDateMan; } elseif($getSBPubDateCal !="" && $getSBPubDateManAug =="" && $getSBPubDateWord !="") { echo $getSBPubDateCal;  } elseif($getSBPubDateCal =="" && $getSBPubDateManAug !="" && $getSBPubDateWord !=""){ echo $getSBPubDateManAug; } elseif($getSBPubDateCal =="" && $getSBPubDateManAug =="" && $getSBPubDateWord !="") { echo $getSBPubDateWord; } ?>.</h6>
						<div class="sbText"><?php $getShortSB = get_post_meta($post->ID , '_simple_short_content' , true); $getSSB = (string)$getShortSB; $small = substr($getSSB, 0, 160); echo $getShortSB; //echo $small;  ?></div>
						<div class="bht1">
							<a href="<?php the_permalink(); ?>">Continue Reading</a>
						</div>
						
						<div class="soci">
							<ul>
								<li class="hvr-rectangle-out"><a class="fb" href="#"></a></li>
								<li class="hvr-rectangle-out"><a class="twit" href="#"></a></li>
								<li class="hvr-rectangle-out"><a class="goog" href="#"></a></li>
								<li class="hvr-rectangle-out"><a class="pin" href="#"></a></li>
								<li class="hvr-rectangle-out"><a class="drib" href="#"></a></li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<?php $querySB++ ; endwhile; wp_reset_query(); ?>
						
			</div>
			<div class="clearfix"></div>
			<!-- technology-top -->

			<!-- technology-top -->
		
			
			</div>
		</div>
		<!-- technology-right -->
		<div class="col-md-3 technology-right">
				
				
				<div class="blo-top1">
							
					<div class="tech-btm">
					<div class="search-1">
							<form action="#" method="post">
								<input type="search" name="s" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" id="s" required="">
								<input type="submit" value=" ">
							</form>
						</div>
							<?php
								$query = new WP_Query( array(
										'post_type'     => 'blog', //your post type
										'posts_per_page' => 5, 
										'meta_key'      => 'post_views_count', //the metakey previously defined
										'orderby'       => 'meta_value_num',
										'order'         => 'DESC'
									)
								);

								
							?>
							<h4>Popular Posts </h4>
							<?php while ($query->have_posts()):$query->the_post();  ?>
								
								
								<div class="blog-grids">
									<div class="blog-grid-left">
										<?php if($thumbnail_html !=""){  ?>
				<a href="<?php the_permalink(); ?>" title="Go for quick read"><?php echo $thumbnail_html; ?></a>
			<?php } ?>
									</div>
									<div class="blog-grid-right">
										
										<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h5>
									</div>
									<div class="clearfix"> </div>
								</div>
								<?php endwhile; ?>
						   <?php query_posts("post_type=blog&showposts=5"); ?>
						   
							<h4>Recent Posts </h4>
							<?php while(have_posts()):the_post(); ?>
								<div class="blog-grids">
									<div class="blog-grid-left">
										<?php $image_id = get_post_meta( $post->ID, '_listing_image_id_740_360', true );
				  $thumbnail_html = wp_get_attachment_image( $image_id, array( 740, 360 ) , '' , array('class' => 'img-responsive' ));
			?>
			<?php if($thumbnail_html !=""){  ?>
				<a href="<?php the_permalink(); ?>" title="Go for quick read"><?php echo $thumbnail_html; ?></a>
			<?php } ?>
									</div>
									<div class="sb-blog-grid-right blog-grid-right">
										
										<h5 class="sb-recent-posts"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h5>
									</div>
									<div class="clearfix"> </div>
								</div>
						<?php endwhile; wp_reset_query(); ?>
				
					
				
					</div>
					
					
					
				</div>
				
			
		</div>
		<div class="clearfix"></div>
		<!-- technology-right -->
	</div>
</div>
<?php endwhile; wp_reset_query(); ?>

<?php get_footer(); ?>