
<div id="TopNews"> 
	<ul>
		<h2>Top 5 Stories</h2>
		<?php $searchResults = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 5"); 
		foreach ($searchResults as $post) { 
			setup_postdata($post);
			$postID = $post->ID; 
			$postTitle = $post->post_title; 
			$commentNum = $post->comment_count; 
			if ($commentNum != 0) { ?> 
				<li><a href="<?php echo get_permalink($postID); ?>" title="<?php echo $postTitle ?>">
				<?php echo $postTitle ?></a>
				</li>
		<?php } } ?>
	</ul>
</div>

 <div id="sidebar">
 <h2 ><?php _e('Categories'); ?></h2>
 <ul >
 <?php
wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
 </ul>
 <h2 ><?php _e('Archives'); ?></h2>
 <ul >
 <?php
 wp_get_archives('type=monthly'); ?>
 </ul>
</div>

<div id="twitterAPI"> 
	<a class="twitter-timeline" href="https://twitter.com/theindie_music" data-widget-id="577956739540189185">Tweets by @theindie_music</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
</div>