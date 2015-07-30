<?php

/**
 *
 * This filter allows bad explicit language to be replaced by ***** to make website more user friendly.
 *
 * @since 4.1.1
 *
 * @param type  $var content.
 * @param type  $var explicit_words.
 * @param array $args {
 *     @type type $var content : is a wordpress variable that represents post content 
 *     @type type $var explicit_words : is a variable to store a list of bad words 
 * }
 */
function bad_word_filter($content) {
 	$explicit_words = array( 'ass', 'douche', 'balls', '@ss');
 	$content = str_ireplace($explicit_words,'*****', $content);
 
 	return $content;
}

/**
 *
 * This function allows the addition of a note to be appended at the end of each post 
 *
 * @since 4.1.1
 *
 * @param type  $var content.
 * @param type  $var explicit_words.
 * @param array $args {
 *     @type type $var content : is a wordpress variable that represents post content 
 *     @type type $var postID : variable to store the ID for the post
 *     @type type $var title : variable to store the title of the identfied post 
 *     @type type $var category : stores the cateogry for the post
 * }
 */

function appendNote($content) {
    $postID = get_the_ID();
    $title = get_the_title( $postID);
   	$category = get_the_category(); 
    $content.= "<h4>Want Even More?... Join Our Social Media Pages</h4>";
    
    return $content;
}

/**
 *
 * Adds a piece of commented out code to the source code of each webpage that shows many queries occur, time taken and memory used  
 *
 * @since 4.1.1
 *
 * @param type  $var statisitcs.
 * @param array $args {
 *     @type type $var statistics : var to store the the queries and echo it out to the page 
 * }
 */

function addStatistics() {
    $statistics = sprintf( '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
    );
    if( current_user_can( 'manage_options' ) ) {
        echo "<!-- {$statistics} -->";
    }
}

/**
 *
 * Function helped access the wordpress codex faster and more efficiently by adding link to admin bar  
 *
 * @since 4.1.1
 *
 * @param type  $var wp_admin_bar.
 * @param array $args {
 *     @type type $var wp_admin_bar: is a global wordpress variable that represents the admin bar, adding a node to the bar 
 * }
 */

function addLinksToAdminBar() {
    global $wp_admin_bar;
    
    $wp_admin_bar->add_node( array(
        'id'    => 'visit-codex',
        'title' => 'Visit Wordpress Codex',
        'href'  => 'http://codex.wordpress.org/',
        'meta'  => array( 'target' => '_blank' )
    ) );
}


/**
 *
 * Function allowed custome theme to be setup correctly and necessary function for Wordpress standards 
 *
 * @since 4.1.1
 *
 * @param type  $feature.
 * @param type  $arguments.
 */
function custom_theme_setup() {
    add_theme_support( $feature, $arguments );
}

/**
 *
 * This function posts an email to an author once their article is published on the website  
 *
 * @since 4.1.1
 *
 * @param type  $authorPost.
 * @param type  $author.
 * @param type  $message.
 * @param array $args {
 *     @type type $var authorPost: var to store the post for a specific author
 *     @type type $var author: var to store the author belonging to that post
 *     @type type $var message: var to store the message that will post to the user
 * }
 */
function emailAuthorNotification($post_id) {
   $authorPost = get_post($post_id);
   $author = get_userdata($post->post_author);

   $message = "
      Hi ".$author->display_name.",
      Your post, ".$authorPost->post_title." has just been published at ".get_permalink( $post_id ).". Congrats!
   ";
   wp_mail($author->user_email, "Your post has been successfully published to SoundDog", $message);
}

/**
 *
 * This function set all the uppercase letters in comments to be lowercase 
 *
 * @since 4.1.1
 *
 * @param type  $commentdata.
 * @param array $args {
 *     @type type $var commentdata: var to store the content of a comment
 * }
 */
//  
function commentsToLowercase( $commentdata ) {
    if( $commentdata['comment_content'] == strtoupper( $commentdata['comment_content'] ))
        $commentdata['comment_content'] = strtolower( $commentdata['comment_content'] );
    return $commentdata;
}

/**
 *
 * This function notifies a user by email that he/she is removed from the system 
 *
 * @since 4.1.1
 *
 * @param type  $deletedUser.
 * @param type  $userEmail.
 * @param type  $headers.
 * @param type  $emailSubject.
 * @param type  $emailMessage.
 * @param array $args {
 *     @type type $var deletedUser: var to store the user that will be deleted
 *     @type type $var userEmail: var to store the removed user's email address
 *     @type type $var headers: var to store the message headers
 *     @type type $var emailSubject: var to store the subject of the message
 *     @type type $var emailMessage: var to store final message sent to the user
 * }
 */ 
function notifyRemovedUser( $user_id ) {
    global $wpdb;
    $deletedUser = get_userdata( $user_id );
    $userEmail = $deletedUser->user_email;
    $headers = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_bloginfo( 'admin_email' ) . '>' . "\r\n";
    $emailSubject = 'SoundDog account removed';
    $emailMessage = 'Your account at ' . get_bloginfo( 'name' ) . ' has been deleted because of your disregard of the rules stated';
    wp_mail( $email, $emailSubject, $emailMessage, $headers );
}

/**
 *
 * Let user know by email that he/she updated their profile information 
 *
 * @since 4.1.1
 *
 * @param type  $blog_url.
 * @param type  $userInfo.
 * @param type  $userName.
 * @param type  $userEmail.
 * @param type  $emailSubject.
 * @param type  $emailMessage.
 * @param array $args {
 *     @type type $var blog_url: var to store blog name 
 *     @type type $var userInfo: var to store the retrieved user based on their ID
 *     @type type $var userName: var to store users name
 *     @type type $var userEmail: var to store the user email 
 *     @type type $var emailSubject: var to store email subject
 * }
 */  
function notifyUpdatedProfile( $user_id ) {
    $blog_url = get_bloginfo( 'name' );
    $userInfo = get_userdata( $user_id );
    $userName = $user_info->display_name;
    $userEmail = $user_info->user_email;
    $emailSubject = "Profile updated";
    $emailMessage = "Hello $userName,\n\n Your profile has been updated! Thank you for using $site_name.";
    wp_mail( $userEmail, $emailSubject, $emailMessage );
}

/**
 *
 * This function redirects users to homepage when logged out 
 *
 * @since 4.1.1
 *
 */

function logoutRedirect() {
    wp_redirect( home_url() );
    exit();
}

/**
 *
 * Adds the filter and actions
 *
 * @since 4.1.1
 *
 */ 
add_filter('the_content', 'bad_word_filter');
add_filter ('the_content', 'appendNote');
add_action( 'wp_footer', 'addStatistics' );
add_action( 'wp_before_admin_bar_render', 'addLinksToAdminBar' ); 
add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action('publish_post', 'emailAuthorNotification');
add_filter( 'preprocess_comment', 'commentsToLowercase' );
add_action( 'delete_user', 'notifyRemovedUser' );
add_action( 'profile_update', 'notifyUpdatedProfile' );
add_action( 'wp_logout', 'logoutRedirect' );

?>



