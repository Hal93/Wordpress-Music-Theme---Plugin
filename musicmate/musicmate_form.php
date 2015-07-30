<?php 
    if($_POST['hidden'] == 'flagValue') {
        //Form data sent
        $dbpwd = $_POST['oscimp_dbpwd'];
        update_option('oscimp_dbpwd', $dbpwd);
 
        $dbhost = $_POST['oscimp_dbhost'];
        update_option('oscimp_dbhost', $dbhost);
         
        $dbuser = $_POST['oscimp_dbuser'];
        update_option('oscimp_dbuser', $dbuser);
        
        $dbname = $_POST['oscimp_dbname'];
        update_option('oscimp_dbname', $dbname);

        $product_images = $_POST['oscimp_prod_img_folder'];
        update_option('oscimp_prod_img_folder', $product_images);
 
        $store_url = $_POST['oscimp_store_url'];
        update_option('oscimp_store_url', $store_url);
        ?>
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
        <?php
    } else {
        //Normal page display
        $dbhost = get_option('oscimp_dbhost');
        $dbname = get_option('oscimp_dbname');
        $dbuser = get_option('oscimp_dbuser');
        $dbpwd = get_option('oscimp_dbpwd');
        $product_images = get_option('oscimp_prod_img_folder');
        $store_url = get_option('oscimp_store_url');
    }
?>


<div class="form">
    <?php    echo "<h2>" . __( 'Store Connect Options', 'oscimp_trdom' ) . "</h2>"; ?>
     
    <form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="hidden" value="flagValue">
        <?php    echo "<h4>" . __( 'OSCommerce Database Settings', 'oscimp_trdom' ) . "</h4>"; ?>
        <p><?php _e("Database Hostname: " ); ?><input type="text" name="oscimp_dbhost" value="<?php echo $dbhost; ?>" size="20"><?php _e(" ex: localhost" ); ?></p>
        <p><?php _e("Database Name: " ); ?><input type="text" name="oscimp_dbname" value="<?php echo $dbname; ?>" size="20"><?php _e(" ex: my_shop_database" ); ?></p>
        <p><?php _e("Database User: " ); ?><input type="text" name="oscimp_dbuser" value="<?php echo $dbuser; ?>" size="20"><?php _e(" ex: root" ); ?></p>
        <p><?php _e("Database Password: " ); ?><input type="text" name="oscimp_dbpwd" value="<?php echo $dbpwd; ?>" size="20"><?php _e(" ex: chosenpassword" ); ?></p>
        <hr />
        <?php    echo "<h4>" . __( 'OSCommerce Storage Settings', 'oscimp_trdom' ) . "</h4>"; ?>
        <p><?php _e("Store URL: " ); ?><input type="text" name="oscimp_store_url" value="<?php echo $store_url; ?>" size="20"><?php _e(" ex: http://www.mystore.com/" ); ?></p>
        <p><?php _e("Store Images Folder URL: " ); ?><input type="text" name="oscimp_prod_img_folder" value="<?php echo $product_images; ?>" size="20"><?php _e(" ex: http://www.mystore.com/images/" ); ?></p>
         
        
        <p class="submit">
        <input type="submit" name="Submit" value="<?php _e('Save Options', 'oscimp_trdom' ) ?>" />
        </p>
    </form>
</div>



