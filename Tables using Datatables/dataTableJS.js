$(document).ready(function() {

   $('#table').dataTable({
       "sDom": "t",
       "ordering": false,
       "bPaginate": false,
       "status": false,
       "ajax": "data.json.txt",
       "columns": [
           {"data": "person_name"},
           {"data": "person_title"},
           {"data": "organization_name"},
           {"data": "location"}
       ]

   });

    $('#table1').dataTable({
        "sDom": "t",
        "ordering": false,
        "bPaginate": false,
        "ajax": "data.json.txt",
        "columns": [
            {"data": "organization_name"},
            {"data": "location"}
        ]

    });
/* filtering the two tables*/
    var table1 = $("#table").dataTable();
    var table2 = $("#table1").dataTable();

    $("#Search_All").keyup( function () {
        table1.fnFilterAll(this.value);
        table2.fnFilterAll(this.value);

    });
    /* trigging the draw table when 'X' of html search is clicked */
    $("input").bind("mouseup", function(e){
        var $input = $(this),
            oldValue = $input.val();

        if (oldValue == "") return;

        setTimeout(function(){
            var newValue = $input.val();
            if (newValue == ""){
                $input.trigger("cleared");
                $("#table").DataTable().search('').draw();
                $("#table1").DataTable().search('').draw();
            }
        }, 1);
    });
} );