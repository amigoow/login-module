var request_url = "http://localhost/CodeIg/";
$(document).ready(function(){
    
    /*******config********/
    //view all accounts
    


   
    
    
    //set the top title
    var title = "How Was Your Cupcake Experience?"
    
    //set the subtitle
    var subtitle = "Please rate your cucpake experience from 1-5 stars";
    
    //set the rating text
        zeroOfive = "Thanks for your feedback - we can't wait to improve!";
    one = "Thanks for your feedback - we can't wait to improve!";
        oneOfive = "Thanks for your feedback - we can't wait to improve!";
    two = "Thanks for your feedback - we can't wait to improve!";
        twoOfive = "Thanks for your feedback - we can't wait to improve!";
    three = "Thanks for your feedback - we can't wait to improve!";
        threeOfive = "Thanks for your feedback - we can't wait to improve!";
    four = "Great! Please help us by leaving us a positive review!";
        fourOfive = "Nice! Please help us by leaving us a positive review!";
    five = "Awesome! Please help us by leaving us a positive review!";
    
    
    
    /*******config_ends********/
    
    
    $("#title").html(title);
    $("#subtitle").html(subtitle);


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
    $.get(request_url + 'account/my_accounts' , function(r_data){
        if(r_data != ""){
            urls = JSON.parse(r_data);
            $.each(urls, function(key, value){
            

                btn_html = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="btn-group"> <button data-value="'+value.account_name+'" data-url="'+value.url+'" type="button" class="btn btn-default"><span class="assoc-icon" style="background-image:url(\''+value.img_path+'\')"></span></button> <button data-value="'+value.account_name+'" data-url="'+value.url+'" type="button" class="btn btn-default dropdown-toggle rev-title"  aria-haspopup="true" aria-expanded="false">' + value.account_name + '</button> </div></div>';
                  
                $("#review-sel").html(
                    btn_html
                );

            });
        }else{
            btn_html = '<p class="not_found text-center">0 accounts found.  </p>';
            $("#review-sel").html(
                btn_html
            );
        }
        
    }); 
}
