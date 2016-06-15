

var request_url = "http://localhost/CodeIg/";
$(function() {

	$(document).ajaxSend(function(event, request, settings) {
	    $('#ajax-load').show();
	});

	$(document).ajaxComplete(function(event, request, settings) {
	    $('#ajax-load').hide();
	});

	// ADD ACCOUNT 
	$("#add_account").click(function(e){
		e.preventDefault();

		var data = new Object();
		data.user = $("#logged_username").val();
		data.name = $("#acc_name").val();
		data.link = $("#acc_link").val();
		data.type = $("input[name=accType]:checked").val();
		selval = $('.selectpicker').selectpicker('val');
		
		if(selval==""){
			var form = $('form#add_acc_form')[0]; // standard javascript object here
		    var formData = new FormData(form);
		    
		    if($("#uploaded_file").val()!=""){

		        $.ajax( {
		          url:  request_url + 'account/upload_file',
		          type: 'POST',
		          data: formData,
		          processData: false,
		          contentType: false,
		          async: false
		        } ).done(function(fdata){

		        	file_data = JSON.parse(fdata);

		            if(file_data.status != 200){
		            	alert("An error occured during file upload");
		            	return;
		            }
		            else{
		            	
			            data.imgpath = file_data.save;
			            data.imgtype = file_data.type;
			        }

		            //TODO check for file type so that only images can be uploaded
		        }); 
		    }else{
		    	alert("please choose an icon image.");
		    	return;
		    }		
		}else{
			data.imgpath = request_url + 'assets/uploads/predefined/' + selval + '.png';
			data.imgtype = "dropdown/png";
		}
		

		
		

		//let's save the data
		$.ajax( {
	        url:  request_url + 'account/new_account',
	        type: 'POST',
	        data: data,
	        dataType: 'json',
        } ).done(function(r_data){
        	if(r_data.status == 200){
        		//redirect to all accounts
        		location.href = request_url + 'dashboard'
        	}else{
        		alert("Fail! error while inserting new record.");
        	}
        });


    });

	//add basic of account
	$("#add_basics").click(function(e){
		e.preventDefault();

		var data = new Object();
		data.title = $("#feedback_title").val();
		data.subtitle = $("#feedback_subtitle").val();
		data.feedback_1_5 = $("#feedback_1_5").val();
		data.feedback_2_5 = $("#feedback_2_5").val();
		data.feedback_3_5 = $("#feedback_3_5").val();
		data.feedback_4_5 = $("#feedback_4_5").val();
		data.feedback_5_5 = $("#feedback_5_5").val();


		//let's save the data
		$.ajax( {
	        url:  request_url + 'account/new_basics',
	        type: 'POST',
	        data: data,
	        dataType: 'json',
        } ).done(function(r_data){
        	if(r_data.status == 200){
        		//redirect to all accounts
        		alert("Done Successfully!");
        	}else{
        		alert("Fail! error occured.");
        	}
        });

	});

	//show all accounts when dashboard is shown
    if (window.location.href.indexOf("dashboard") > -1) {

    	//view all accounts
		$.get(request_url + 'account/my_accounts' , function(r_data){
			if(r_data != ""){
				json = JSON.parse(r_data);

				$.each(json, function(index, data){
					//console.log(data);return;
					account_type = "";
					if(data.acc_type == "biggy"){ 
						account_type = '<div><span class="li_star"></span></div>'; 
					}else{account_type = '<div><span class="li_stack"></span></div>';}

					name = '<div class="account-name white-header">'+
							'<h5>'+data.account_name+
							'<span class="fa fa-times fa-2x pull-right delete-acc-btn" onclick="deleteAccount(this);" data-user-id="'+ data.user_id +'" data-acc-id="'+data.account_id+'"></span>'+
							'<span class="fa fa-pencil pull-right edit-acc-btn" onclick="editAccount(this);" data-user-id="'+ data.user_id +'" data-acc-id="'+data.account_id+'"></span>'+
							'</h5> </div>';

					img = '<div class="account-icon" style="background-image:url(\''+data.img_path+'\')"></div>';
					
					url = '<div class="account-url"><a href="' +data.url + '">URL</a></div>';

					acc_html = ' <div class="col-md-4 col-sm-4 mb" ><div class="white-panel pn"> '+name+' <div class="row"> <div class="col-sm-12 col-xs-12">'+ account_type  + img + url + '</div> </div> </div></div>';
					$(".my_accounts").append(acc_html);
				});	
			}else{
				acc_html = '<p class="not_found text-center">0 accounts found.  </p>';
				$(".my_accounts").append(acc_html);
			}
        });		
    }



});

// DELETE ACCOUNT
function deleteAccount(e){

	user_id = $(e).data("user-id");
	acc_id = $(e).data("acc-id");
	
	var data = new Object();
	
	data.user_id = user_id;
	data.acc_id = acc_id;

	if(confirm("Are you sure you want to delete this account?")){

		$.ajax( {
	        url:  request_url + 'account/delete_account',
	        type: 'POST',
	        data: data,
	        dataType: 'json',
        } ).done(function(r_data){
        	if(r_data.status == 200){
        		//redirect to all accounts
        		location.reload();
        	}else{
        		alert("Fail! An error occured while deleting this account.");
        	}
        });
		
	}
}
// edit ACCOUNT
function editAccount(e){

	acc_id = $(e).data("acc-id");
	$.get(request_url + 'account/get_account/' + acc_id , function(r_data){
		
		r_data = JSON.parse(r_data);

		$("#edit-account-modal").modal("show");

		$("#acc_name").val(r_data[0].account_name);
		$("#acc_link").val(r_data[0].url);
		$("#update_account").attr("data-uid",  r_data[0].user_id );
		$("#update_account").attr("data-aid",  r_data[0].account_id  );
		

	});

	
}
// Update ACCOUNT 
$("#update_account").click(function(e){
	e.preventDefault();

	var data = new Object();
	data.user = $("#update_account").data().uid;
	data.account = $("#update_account").data().aid;
	data.name = $("#acc_name").val();
	data.link = $("#acc_link").val();
	data.type = $("input[name=accType]:checked").val();
	
	var form = $('form#add_acc_form')[0]; // standard javascript object here
    var formData = new FormData(form);
    
    if($("#uploaded_file").val()!=""){

        $.ajax( {
          url:  request_url + 'account/upload_file',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          async: false
        } ).done(function(fdata){

        	file_data = JSON.parse(fdata);

            if(file_data.status != 200){
            	alert("An error occured during file upload");
            	return;
            }
            else{
            	
	            data.imgpath = file_data.save;
	            data.imgtype = file_data.type;
	        }

            //TODO check for file type so that only images can be uploaded
        }); 
    }else{
    	// if not icon was selected

    }	
	
    
	//let's save the data
	$.ajax( {
        url:  request_url + 'account/update_account',
        type: 'POST',
        data: data,
        dataType: 'json',
    } ).done(function(r_data){
    	if(r_data.status == 200){
    		//redirect to all accounts
    		location.href = request_url + 'dashboard'
    	}else{
    		alert("Fail! error while inserting new record.");
    	}
    });


   


});
//get yelp reviews | S C R A P E R
$("#social_accounts_tabs li.active").click(function(){

});



function get_yelp_reviews(){
	
	

	
}
if(window.location.href.indexOf("review_ratings") > -1){
	$.get(request_url + 'account/my_accounts' , function(r_data){
		if(r_data != ""){
			json = JSON.parse(r_data);

			$.each(json, function(index, data){

				if(index == 0 )
					active_class = "in ";
				else
					active_class = "";
				
				nav_tab_html = '<li class="'+ active_class +'"><a data-url="'+data.url+'" data-toggle="tab" href="#'+data.account_name+'">'+data.account_name+'</a></li>';
				
				
				
				tabs_content_html = '<div id="'+data.account_name+'" class="tab-pane fade ' + active_class + '"> <h3>'+data.account_name+'</h3> <p>'+data.url+'</p><div class="row main_info"> </div><div class="row individual_ratings"> </div> </div>';

				if(index == 0 ){
					$("ul#social_accounts_tabs").html(nav_tab_html);
					$("div#social_accounts_tabs_content").html(tabs_content_html);
				}
				else{
					$("ul#social_accounts_tabs").append(nav_tab_html);
					$("div#social_accounts_tabs_content").append(tabs_content_html);
				}

			});	
		}else{
			acc_html = '<p class="not_found text-center">0 accounts found.  </p>';
			$("#social_accounts_scraped").append(acc_html);
		}
    });
}


$(document).on( 'show.bs.tab', 'a[data-toggle="tab"]', function (e) {
   
   var activatedTab = e.target; // activated tab

   acc_url = $(activatedTab).attr("data-url");
   if( !validateURL(acc_url) ){
   		alert("The URL is invalid you provided for this account");
   		return;
   }else{

   	
   		data = new Object();

   		if( acc_url.indexOf("yelp") > -1 ){

   			
   			

   			//Handle for YELP
   			data.yelp_url = acc_url;
			$.ajax( {
		        url:  request_url + 'scraper/yelp',
		        type: 'POST',
		        data: data,
		        dataType: 'json',
		        contentType: "application/x-www-form-urlencoded;charset=utf-8",
		    } ).done(function(r_data){
		    	//generating data here
		    	console.log(r_data);
		    	// RATING
		    	var rating = r_data.rating;
		    	
		    	var reviews = r_data.reviews;
		    	
		    	

		    	var stars = parseInt(rating);
		    	var stars_html = rating;
		    	for(i=0;i<stars;i++){
		    		stars_html += "<span class='glyphicon glyphicon-star'></span>";
		    	}
		    	for( i=0; i < (5-stars); i++ ){
		    		stars_html += "<span class='glyphicon glyphicon-star-empty'></span>";
		    	}

		    	// TOTAL REVIEWS
		    	var total_reviews = r_data.reviews_count;

		    	main_html = '<div > <div class="col-md-6"> <dl class="dl-horizontal"> <dt>Current Rating</dt> <dd> '+ stars_html +' </dd> </dl> </div> <div class="col-md-6"> <dl class="dl-horizontal"> <dt>Total Reviews:</dt> <dd>'+total_reviews+'</dd> </dl> </div> </div>';
		    	
		    	$(".main_info").append(main_html);

		    	for(i=0;i < reviews.length ; i++){



		    		individual_rating = reviews[i].biz_rating;
		    		date = reviews[i].date;
		    		description = reviews[i].description;
		    		image_path = reviews[i].image_path;
		    		user_name = reviews[i].user_name;
		    		if(individual_rating != null){
		    			individual_html = ' <div><div class="media"> <div class="media-left media-middle"> <a href="#"> <img widht="100" src="'+image_path+'" alt=""> </a> </div> <div class="media-body media-middle"> <div class="row"> <div class="col-md-6"> <h4 class="media-heading"> '+user_name+' </h4> <p> '+date+' </p> </div> <div class="col-md-6">'+individual_rating+'</div> </div> </div> </div><!-- media --> </div> <div class="row"> <blockquote><p>'+description+'</p></blockquote> </div> <hr>';

		    			$(".individual_ratings").append(individual_html);			
		    		}
		    		
		    		
		    		
		    	}
		    	
		    	


		    });
   		}

		
		
   }
   
});

function validateURL(textval) {
    var urlregex = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
    return urlregex.test(textval);
}

