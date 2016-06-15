var request_url = "http://localhost/CodeIg/";
$(document).ready(function(){
    
    /*******config********/
    //view all accounts
    

    var profile_username = $("#get_profile_for_user").val();

    var title, subtitle, zeroOfive, one, oneOfive, two, twoOfive, three, threeOfive, four, fourOfive, five;
    //fetch basic info
    $.post(request_url + 'account/get_basic_info' , {username : profile_username})
    .done(function(r_data){
        

        r_data = JSON.parse(r_data);
        data = r_data[0];
        
        
        //populating vars
        title = data.title;
        
        subtitle = data.subtitle;
        
        //set the rating text
            zeroOfive = data.feedback_1_5;
        one = data.feedback_1_5;
            oneOfive = data.feedback_2_5;
        two = data.feedback_2_5;
            twoOfive = data.feedback_3_5;
        three = data.feedback_3_5;
            threeOfive = data.feedback_4_5;
        four = data.feedback_4_5;
            fourOfive = data.feedback_5_5;
        five = data.feedback_5_5;
        
        //populating fields
        $("#title").html(title);
        $("#subtitle").html(subtitle);

        //for admin form
        $("#feedback_title").val(title);
        $("#feedback_subtitle").val(subtitle);
        $("#feedback_1_5").val(one);
        $("#feedback_2_5").val(two);
        $("#feedback_3_5").val(three);
        $("#feedback_4_5").val(four);
        $("#feedback_5_5").val(five);
        

        // Rating star
        $("#my_rating").rating({
            starCaptions: {
                0.5: zeroOfive,
                1: one,
                1.5: oneOfive,
                2: two,
                2.5: twoOfive,
                3: three,
                3.5: threeOfive,
                4: four,
                4.5: fourOfive,
                5: five
            },
            size: 'lg',
            showCaption : false,
            showClear: false,
            starCaptionClasses: function(val){
                if (val < 2) {
                   return 'label label-default';
                }
                else if (val >= 2 && val <= 4) {
                    return 'label label-warning';
                } 
                else {
                    return 'label label-success';
                }
                
            },
            captionElement: "#myCaption"
        });// Rating star
    }); 
   
    
   
    
    
    
    /*******config_ends********/
    
    
    


    // sending the email
    $('#sendEmail').click(function(){
        var fname = $("#f_name").val();
        var email = $("#email").val();
        var improve = $("#improve").val();
        
        data =  {'fname': fname, 'email' : email , 'improve' : improve };
        
        $.ajax({
          type: "POST",
          url: 'ajax.php',
          data: data
        }).done(function( msg ) {
           alert( "Data Saved: " + msg );
        });
        
        
    });// sending the email


    

    //rating change
    var counter = 0;
    $('#my_rating').on('rating.change', function(event, value, caption) {
        if(counter == 0 ){
            $("#feedbackForm, #myCaption").show();
        }
        if(value >= 4){

            //fetching user accounts
            fetchMyAccounts();

            $("#optModal").modal("show");
        
        }

        counter++;
    });

    
    


    

    //let's load the modal url
    $('#review-sel .btn-group button').on('click', function(e) {
        e.preventDefault();


        value = $(this).data("value");
        url = $(this).data("url");

        $('.review-iframe').html('<h2></h2><iframe width="100%" height="95%" frameborder="0" allowtransparency="true" src="' + url + '"></iframe>');            
        
        value = value.toLowerCase();
        
        if(value == "facebook" || value == "google" || value == "amazon"){
            $("#optModal").modal("hide");
            window.open(url, '_blank');
        }else{
            $("#optModal").modal("hide");
            $("#myModal").modal("show");   
        }

     
    });//let's load the modal url ends
});
function fetchMyAccounts(){
    var urls;
    var profile_username = $("#get_profile_for_user").val();

    
    $.post(request_url + 'account/my_accounts' , {username : profile_username})
    .done(function(r_data){

        if(r_data != ""){

            urls = JSON.parse(r_data);
            
            $.each(urls, function(key, value){
            

                btn_html = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="btn-group"> <button data-value="'+value.account_name+'" data-url="'+value.url+'" type="button" class="btn btn-default"><span class="assoc-icon" style="background-image:url(\''+value.img_path+'\')"></span></button> <button data-value="'+value.account_name+'" data-url="'+value.url+'" type="button" class="btn btn-default dropdown-toggle rev-title"  aria-haspopup="true" aria-expanded="false">' + value.account_name + '</button> </div></div>';
                if(key == 0){
                    $("#review-sel").html(btn_html);    
                }else{
                    $("#review-sel").append(btn_html);    
                }
                

            });
        }else{
            btn_html = '<p class="not_found text-center">0 accounts found.  </p>';
            $("#review-sel").html(
                btn_html
            );
        }
        
    }); 
}
