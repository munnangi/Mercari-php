/**
 * Created by munna on 7/3/2017.
 */



function searchText(searchtxt,feedClass) {

    var searchval = $(searchtxt).val().toLowerCase();

   $("."+feedClass).each(function () {
       console.log(feedClass);
        var feed = $(this).text().toLowerCase();

        if (feed.indexOf(searchval) != -1) {
            $(this).parent().show();
        }
        else {
            $(this).parent().hide();
        }
    });


}
$(document).ready(function(){

     $('#newtab').click(function () {
         if(!($.trim($('div#tab2').html()).length)) {
             var newajax = makenewajax();
             newajax.done(function (data) {
                 $('#tab2').removeClass("loader");
                 $('#tab2').html(data);
             });
             $('#tab2').addClass("loader");
             function makenewajax() {
                 return $.ajax({
                     url: "/new",
                     type: "GET"
                 });
             }
         }
     });





    $('#easyPaginate,#easyPaginateNew').easyPaginate({
        paginateElement: 'div',
        elementsPerPage: 10,
        effect: 'climb'
    });

});



