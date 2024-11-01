
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php get_header(); ?>
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<?php while(have_posts()):the_post(); ?>
<?php
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

?>
<?php if($feat_image !=""){ ?>
<div class="banner-1" style="background-image:url(<?php echo $feat_image; ?>);">

</div>
<?php } ?>
	<!-- technology-left -->
	<div class="simple-blog-technology technology">
	<div class="container">
		<div class="simple-blog-left col-md-9 technology-left">
			<div class="simple-blog-agileInfo agileinfo <?php echo $post->ID; ?>">
			<div class="simple-blog-single single">
			<?php $image_id = get_post_meta( $post->ID, '_listing_image_id_740_360', true );
				  $thumbnail_html = wp_get_attachment_image( $image_id, array( 740, 360 ) , '' , array('class' => 'img-responsive' ));
			?>
			<?php if($thumbnail_html !=""){  ?>
				<?php echo $thumbnail_html; ?>
			<?php } ?>
			    <div class="simple-blog-b-bottom b-bottom"> 
				<?php $getSBTitle = get_the_title(); ?>
				<?php if($getSBTitle !=""){ ?>
			      <h5 class="simple-blog-top top"><?php echo $getSBTitle; ?></h5>
				<?php } ?>
				<?php $getSBContent = get_the_content(); ?>
				<?php if($getSBContent !=""){  ?>
				   <div class="simple-blog-sub sub"><?php the_content(); ?></div>
				<?php } ?>
				<?php $getSBPubDateCal = get_post_meta($post->ID , '_simple_pub_cal' , true);
					  $getSBPubDateMan = get_post_meta($post->ID , '' , true);
					  $getSBPubDateWord    = get_the_date('d-m-Y'); 


				?>
			      <p>On <?php if($getSBPubDateCal !="" && $getSBPubDateManAug !="" && $getSBPubDateWord !=""){ echo $etSBPubDateMan; } elseif($getSBPubDateCal !="" && $getSBPubDateManAug =="" && $getSBPubDateWord !="") { echo $getSBPubDateCal;  } elseif($getSBPubDateCal =="" && $getSBPubDateManAug !="" && $getSBPubDateWord !=""){ echo $getSBPubDateManAug; } elseif($getSBPubDateCal =="" && $getSBPubDateManAug =="" && $getSBPubDateWord !="") { echo $getSBPubDateWord; } ?> <a class="simple-blog-spanLink span_link" href="#"><span class="glyphicon glyphicon-comment"></span><?php comments_number( '0', '1', '%' ); ?> </a><a class="simple-blog-spanLink span_link" href="#"><span class="glyphicon glyphicon-eye-open"></span><?php
          sb_setPostViews(get_the_ID());
?><?php
          echo sb_getPostViews(get_the_ID());
?> </a></p>
				 
				</div>
			 </div>

				<div class="coment-form">
					<?php comments_template(); ?>
				</div>	
				<div class="clearfix"></div>
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