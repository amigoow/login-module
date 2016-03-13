$(document).ready(function(){
    
    /*******config********/
    
    var urls = {
        "yelp" : {
          "url" : "http://www.yelp.com/writeareview/biz/sJjrlg2UZUQhu1J3iYMVuw?return_url=%2Fbiz%2FsJjrlg2UZUQhu1J3iYMVuw",
          "icon" : "icons/yelp.png" 
        }
        ,
        "google" : {
          "url" : "http://www.google.com",
          "icon" : "icons/google.png"
        }
    };
    
    
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
    four = "Thank you! Please help us by leaving us a positive review!";
        fourOfive = "Thank you! Please help us by leaving us a positive review!";
    five = "Thank you! Please help us by leaving us a positive review!";
    
    
    
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
    $(".rating#my_rating").rating({
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
        showClear: false,
        starCaptionClasses: {
            0.5: "text-danger",1: "text-danger",1.5: "text-danger", 2: "text-warning",2.5: "text-warning", 3: "text-info",3.5: "text-info", 4: "text-primary",4.5: "text-primary", 5: "text-success"
        },
        captionElement: "#myCaption"
    });// Rating star

    //rating change
    var counter = 0;
    $('.rating#my_rating').on('rating.change', function(event, value, caption) {
        if(counter == 0 ){
            $("#feedbackForm, #myCaption").show();
        }
        if(value >= 4){

            $("#optModal").modal("show");
        
        }

        counter++;
    });

    //nice select
    $.each(urls, function(key, value){
        
        console.log(value.url);

        btn_html = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="btn-group"> <button data-value="'+key+'" data-url="'+value.url+'" type="button" class="btn btn-default"><span class="assoc-icon" style="background-image:url('+value.icon+')"></span></button> <button data-value="'+key+'" data-url="'+value.url+'" type="button" class="btn btn-default dropdown-toggle rev-title"  aria-haspopup="true" aria-expanded="false">' + key + '</button> </div></div>';
          
        $("#review-sel").append(
            btn_html
        );

    }); //nice select

    $("option").each(function() {
        $(this).text($(this).text().charAt(0).toUpperCase() + $(this).text().slice(1));
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