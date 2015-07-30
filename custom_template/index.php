<?php get_header(); ?>

<div id="main">
 <div id="content">
 <!--<h1>Posts</h1>-->
<?php body_class( $class ); ?>
 <div id="posts">
 <?php
 if (have_posts()) :
 while (have_posts()) :
 the_post(); 
  ?> 

 <h1><?php the_title(); ?></h1>
 <h6><?php wp_title(); ?></h6>
 
 <h4>Posted <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></h4>
 <p><?php the_content($more_link_text , $strip_teaser); ?></p> 
 <?php comments_template(); ?> 
 <?php posts_nav_link(); ?>

 <hr>
 <?php
 endwhile;
 else: ?>
 <p><?php _e('Sorry, no posts found!'); ?></p><?php endif; ?>
 </div>
 </div>

 <?php get_sidebar(); ?>

 <div class="taxonomies">
	<div class="taglist"><?php wp_tag_cloud( $args ); ?></div>
</div>

</div>
<div id="delimiter">
</div>
<?php get_footer(); ?>
