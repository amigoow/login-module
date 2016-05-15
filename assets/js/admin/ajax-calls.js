

var request_url = "http://localhost/CodeIg/";
$(function(){

	// ADD ACCOUNT 
	$("#add_account").click(function(e){
		e.preventDefault();

		var data = new Object();
		data.user = $("#logged_username").val();
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
	    	alert("please choose an icon image.");
	    	return;
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
					
					url = '<div class="account-url">' +data.url + '</div>';

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
		console.log(r_data);
	});

	
}
