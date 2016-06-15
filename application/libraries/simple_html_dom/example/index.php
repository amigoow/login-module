<?php
// example of how to use advanced selector features
include('../simple_html_dom.php');

if(isset($_POST["yelp_url"]){
    // get DOM from URL or file
    $html = file_get_html($_POST["yelp_url"]);

    $review_items["rating"] =  $html->find('.biz-rating i',0)->title;
    $review_items["reviews-count"] =  $html->find('span.review-count span[itemprop]' , 0)->plaintext;

    foreach($html->find('.review-list .ylist .review') as $e){

        $review_item["user-name"] = $e->find('li.user-name',0)->plaintext;
        $review_item["biz-rating"] = $e->find('.review-wrapper .biz-rating i',0)->title;
        $review_item["description"] = $e->find('.review-wrapper p[itemprop="description"]',0)->plaintext;
        $review_item["date"] = $e->find('.review-wrapper meta[itemprop=datePublished]',0)->content;
        $review_item["image-path"] = $e->find('.review-wrapper .photo-box img',0)->src;
        
        $review_items["reviews"][] = $review_item;
        
    }

    echo json_encode($review_items);
}






?>