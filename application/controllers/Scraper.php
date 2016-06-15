<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'libraries/simple_html_dom/simple_html_dom.php');
error_reporting(E_ALL & ~E_NOTICE);
/**
 * Dashboard class.
 * 
 * @extends CI_Controller
 */
class Scraper extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		

		
	}
	
	public function yelp() {
		
		

		if(isset($_POST["yelp_url"])) {

		    // get DOM from URL or file
		    $html = file_get_html($_POST["yelp_url"]);

		    // $review_items["rating"] =  $html->find('.biz-rating i',0)->title;

		    $review_items["rating"] =  $html->find('.biz-main-info meta[itemprop=ratingValue]' , 0)->content;
		    
		    $review_items["reviews_count"] =  $html->find('span.review-count span[itemprop]' , 0)->plaintext;

		    foreach($html->find('.review-list .ylist .review') as $e){

		        $review_item["user_name"] = $e->find('li.user-name',0)->plaintext;
		        $review_item["biz_rating"] = $e->find('.review-wrapper meta[itemprop=ratingValue]',0)->content;
		        $review_item["description"] = $e->find('.review-wrapper p[itemprop="description"]',0)->plaintext;
		        $review_item["date"] = $e->find('.review-wrapper meta[itemprop=datePublished]',0)->content;
		        $review_item["image_path"] = $e->find('.media-avatar .photo-box img',0)->src;
		        
		        $review_items["reviews"][] = $review_item;
		        
		    }

		    echo json_encode($review_items);
		}

	}
}
