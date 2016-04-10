var request_url = "http://localhost/CodeIg/";
$(function(){
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
        		alert("error while inserting new record.");
        	}
        });



	});

	    if (window.location.href.indexOf("dashboard") > -1) {
        	//view all accounts
			$.get(request_url + 'account/my_accounts' , function(r_data){
				json = JSON.parse(r_data);

				$.each(json, function(index, data){
					//console.log(data);
					account_type = "";
					if(data.acc_type == "biggy"){ 
						account_type = '<div><span class="li_star"></span></div>'; 
					}else{account_type = '<div><span class="li_stack"></span></div>';}

					name = '<div class="account-name white-header"> <h5>'+data.account_name+'</h5> </div>';

					img = '<div class="account-icon" style="height:100px;width:100px;background-size: cover; background-position:center center;background-repeat:no-repeat;background-image:url(\''+data.img_path+'\')"></div>';
					
					url = '<div class="account-url">URL: ' +data.url + '</div>';

					acc_html = ' <div class="col-md-4 col-sm-4 mb" ><div class="white-panel pn"> '+name+' <div class="row"> <div class="col-sm-6 col-xs-6">'+ account_type  + img + url + '</div> </div> </div></div>';
					$(".my_accounts").append(acc_html);
				});
				
				
	        });		
	    }



	
});