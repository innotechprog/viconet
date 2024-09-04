<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION


// ============================================================================
//============= Custom Code Start =============================================
//===================== Know
add_action('add_meta_boxes', 'blink_product_add_meta_boxes');
function blink_product_add_meta_boxes()
{
  add_meta_box('blink-product-detail-sizeguide-contact', 'Youtube video URL FOR Resources', 'blink_product_meta_boxes_callback', 'post', 'normal', 'default');
}

function blink_product_meta_boxes_callback($post, $box)
{
  wp_nonce_field('blink-leo-metaboxes', 'blink-leo-metaboxes-nonce');
  $output = '<table class="links-table" cellpadding="0"><tbody>';
  if ($box['id'] === 'blink-product-detail-sizeguide-contact') {
	  echo '<input style="width:80%; padding:5px 10px;" name="blink-resource_video_url" id="blink-resource_video_url" type="text" size="40" value="' . get_post_meta($post->ID, 'blink-resource_video_url', true) . '">';
  }
}

function blinksave_meta_boxes($post_id)
{
  if (!isset($_POST['blink-leo-metaboxes-nonce'])) {
    return;
  }

  if (!wp_verify_nonce($_POST['blink-leo-metaboxes-nonce'], 'blink-leo-metaboxes')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') and DOING_AUTOSAVE) {
    return;
  }

  if (isset($_POST['blink-resource_video_url']))
    update_post_meta($post_id, 'blink-resource_video_url', $_POST['blink-resource_video_url']);
}
add_action('save_post', 'blinksave_meta_boxes');




add_action('wp_head', 'blink_add_googleanalytics');
function blink_add_googleanalytics() { ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KKFL8T6');</script>
<!-- End Google Tag Manager -->
<?php
} 


// Add Google Tag code which is supposed to be placed after opening body tag.
add_action( 'wp_body_open', 'wpdoc_blink_add_custom_body_open_code' );

function wpdoc_blink_add_custom_body_open_code() {
	echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KKFL8T6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
}

function custom_shortcode_with_css_and_js() {
    // Get the absolute path of the current file (functions.php)
$current_file_path = __DIR__;
// Navigate back to the root directory
$root_directory = dirname(dirname(dirname($current_file_path)));
// Include a file from the root directory
//include_once $root_directory . '/file-in-root-directory.php';

include_once $root_directory."dev.talent.viconetgroup.com/include/connect.php";
include_once $root_directory."dev.talent.viconetgroup.com/include/functions.php";
    // Add CSS styles
    echo '<style>
        .blue-header {
            background-color: #26266A;
            padding: 10px;
            height:150px;
            width:100%;
        }
        .talent-search{
    width: 100%;
    height: 70px;
    background: #fff;
    border-radius: 15px;
    margin-bottom: 15px;
    display: flex;
    padding: 10px;
}
.s_tal{
    width: 100%;
    position: relative;
}
.s_tal.sactive .autocomplete-search{
 pointer-events: auto;
}
.autocomplete-search{
    width:100%;
    position: absolute;
    max-height: 500px;
    overflow-y: auto;
    background: #fff;
    border-radius: 15px;
    pointer-events: none;
    z-index: 10;
    max-height: 300px;
}
.autocomplete-search li{
    list-style: none;
    cursor: pointer;
    line-height: 30px;
  cursor: default;
  display: none;
}
.autocomplete-search li:hover{
    background: #efefef;
}

.talent-search input{
    height: 100%;
    border-radius: 15px;
    width: 100%;
    border: none;
    outline: none;
}
.s_tal.sactive .autocomplete-search li{
display: block;
}
.talent-search img{
    width: 24px;
    margin-left: 10px;
    margin-right: 10px;
    
}
.search-btn{
    padding: 10px 25px;
}
.search-btn:hover{
background: #17a2b8;
}
.cust-select{
    width: 30%!important;
    border-radius: 10px;
    background: #E5E5E5;
    font-family: Quicksand;
}

    </style>';

    // Add JavaScript
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Your JavaScript code here
            console.log("Shortcode JavaScript executed.");
        });
    </script>';

    // Output the shortcode content
    $output = ' <div class="blue-header">
    <label> 1'.createRandomPassword().' 2Job Search</label>';
    $output .= '
    <div>
    <form id="myForm" method="post"> 
        <div class="talent-search">
            <div class="s_tal">
                <input type="text" name="search_field" autocomplete="off" placeholder="Job Title, keywords..." class="s_input" id="inputBox"> 
                <div class="autocomplete-search">
                  <!--Auto suggestion-->
                </div>
            </div>
            <select class="cust-select mr-3 p-12" name="job_category" id="category">
                <option value="all">All Categories</option>
                <?php 
                $query = $corp->getAllIndustries();
                for ($i=0; $rows = $query->fetch() ; $i++) { ?>
                    <option value=""</option>
                    <?php
                }
                ?>  
            </select>
            <button class="search-btn bton btn1 " type="button" id="job_search">SEARCH</button>         
        </div>
    </form>
</div>
';
    $output .= '</div>';

    return $output;
}

add_shortcode('customjobsshortcode', 'custom_shortcode_with_css_and_js');
