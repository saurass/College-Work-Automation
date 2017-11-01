$(document).ready(function(){
    $('select').material_select();
    setTimeout(function(){
        $(".preloading-screen").fadeOut(500);
    },1000);
    $(".welcome-to-greenboard").find("*").hide();
    setTimeout(function(){
        $(".welcome-to-greenboard").find("h3").fadeIn(600);
    },1200);
    setTimeout(function(){
        $(".welcome-to-greenboard").find("h3").fadeOut(600);
    },3000);
    setTimeout(function(){
        $(".welcome-to-greenboard").find("h5").fadeIn(600);
    },3600);
    setTimeout(function(){
        $(".welcome-to-greenboard").find("h5").fadeOut(600);
    },7100);
    setTimeout(function(){
        $(".welcome-to-greenboard").find("p").fadeIn(600);
    },7700);
    setTimeout(function(){
        $(".welcome-to-greenboard").find("p").fadeOut(600);
    },9000);
    setTimeout(function(){
        $(".welcome-to-greenboard").find("a").fadeIn(600);
        $(".welcome-to-greenboard").find(".not-anyone").fadeIn(600);
    },9600);
    $("#skip").click(function(){
        var highestTimeoutId = setTimeout(";");
        for (var i = 0 ; i < highestTimeoutId ; i++) {
            clearTimeout(i);
        }
        $(".welcome-to-greenboard").find("*").hide();
        $(".welcome-to-greenboard").find("a").show();
        $(".welcome-to-greenboard").find(".not-anyone").show();
    });
    $('.dropdown-button').dropdown({
            inDuration: 300,
            outDuration: 225,
            constrainWidth: false, // Does not change width of dropdown to that of the activator
            hover: false, // Activate on hover
            gutter: 2, // Spacing from edge
            belowOrigin: true, // Displays dropdown below the button
            alignment: 'left', // Displays dropdown with edge aligned to the left of button
            stopPropagation: false // Stops event propagation
        }
    );
    $(".open-seasame").click(function(){
        var $right = $("aside").css("right");
        if($right == "-200px"){
            $(this).find("i").removeClass("fa-arrow-up").addClass("fa-arrow-down");
            $("aside").animate({
                right : 0
            },300);
        }
        else{
            $(this).find("i").removeClass("fa-arrow-down").addClass("fa-arrow-up");
            $("aside").animate({
                right : "-200px"
            },300);
        }
    });
    $("aside.side-navigation ul li").hide();
    $(".oh-here-is-a-back-button").hide();
    $("aside.side-navigation ul a").click(function(){
        $(this).parent("ul").siblings("ul").toggle();
        $(this).siblings("li").toggle();
        $(this).toggleClass("green darken-2")
        $(".oh-here-is-a-back-button").toggle();

    });
    $("aside.side-navigation ul li a.backwards").click(function(){
        $(this).closest("ul").siblings("ul").toggle();
        $(this).parent("li").siblings("li").toggle();
        $(this).parent("li").toggle();
        $(".oh-here-is-a-back-button").toggle();
        $(this).removeClass("green darken-2");
    });

});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile').attr('src', e.target.result);
        };
        $("#profile").show();
        $("#icon").hide();

        reader.readAsDataURL(input.files[0]);
    }
}