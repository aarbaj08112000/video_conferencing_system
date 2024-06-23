$( document ).ready(function() {
  // get_meet_list();
  var meter_domain = "gayu.metered.live";
    $('.carousel-main').owlCarousel({
        items: 1,
        loop: false,
        autoplay: false,
        autoplayTimeout: 1500,
        margin: 10,
        nav: true,
        dots: true,
        navText: ['<','>'],
    })

    $(".add-new-meeting").on("click",function(){

        $.ajax({
            type: "POST",
            url: "curl.php",
            data: [],
            success: function (response) {
                var res = JSON.parse(response)
                if(res.success == 1){
                    var return_arr = JSON.parse(res.result_arr);
                    console.log(return_arr)
                    if(return_arr.roomName != "" && return_arr.roomName != null && return_arr.roomName != undefined){
                        var frame = new MeteredFrame();
                        $(".meeting-home").hide();
                        frame.init({
                            // This URL will be different. It will be unique based on your appName and roomName
                            roomURL: meter_domain+"/"+return_arr.roomName,
                        }, document.getElementById("metered-frame"));

                    }else{
                        alert(return_arr.message)
                    }
                }

            },
            error: function (error) {
              // console.error("Error:", error);

            },
          });

    // setTimeout(function(){
    //     $(".h-screen.w-screen ").remove()
    //     console.log("k")
    // },5000)

    })

})

function get_meet_list(){
  $.ajax({
      type: "POST",
      url: "get_all_meet.php",
      data: [],
      success: function (response) {
          var res = JSON.parse(response)
          if(res.success == 1){
              var return_arr = JSON.parse(res.result_arr);
              console.log(return_arr)

          }

      },
      error: function (error) {
        // console.error("Error:", error);

      },
    });
}
