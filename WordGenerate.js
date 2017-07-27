/**
 * Created by munna on 7/5/2017.
 */

$(document).ready(function(){

   $('#button_generate').on("click",function () {

       console.log($(self).find('.modal').text());

       $('body').addClass("load");
       $('body').css("overflow:hidden");

        var myinterval =   setInterval(function(){
            $('.modal').append(".") }
        ,1000);

       $.ajax({
           url: '/word',
           type: "GET",
           success: function (data) {
               clearInterval(myinterval);
               $('input#wordg').val(data);
               $('body').removeClass("load");

           }

       });
   });


    $('#button_transform').on("click",function () {
var wordgen = $("#wordg").val();

        $('body').addClass("load");
        var myintervalt = setInterval(function(){

                $('.modalt').append(".");},
            1000);

        $.ajax({
            url: '/transform',
            type: "POST",
            data: {"gen_word": wordgen},
            success: function (data) {
                clearInterval(myintervalt);
                $('input#wordg').val(data);

                $('body').removeClass("load");

            }

        });
    });

});