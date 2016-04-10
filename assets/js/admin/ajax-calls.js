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
				res_html = '';
	        	$(".white-panel").append(res_html);
	        });		
	    }



	
});