



//$("select").chosen({width:"95%"}).trigger("liszt:updated");
//$("#select2").chosen({width:"95%"});
//$("#select3").chosen({width:"95%"});
//$("#select4").chosen({width:"95%"});

//$("select").chosen();
//$(".chzn-select-deselect").chosen({allow_single_deselect:true});

$("select").chosen({width:"95%"});

$("select, .check, .check :checkbox, input:radio, input:file").uniform();



$(".titleIcon input:checkbox").click(function() {
    var checkedStatus = this.checked;
    $("#checkAll").find("tbody tr td:first-child input:checkbox").each(function() {
        this.checked = checkedStatus;
        if (checkedStatus == this.checked) {
            $(this).closest('.checker > span').removeClass('checked');
            $(this).closest('table tbody tr').removeClass('thisRow');
        }
        if (this.checked) {
            $(this).closest('.checker > span').addClass('checked');
            $(this).closest('table tbody tr').addClass('thisRow');
        }
    });
});

$(function() {
    $('#checkAll').find('tbody tr td:first-child input[type=checkbox]').change(function() {
        $(this).closest('tr').toggleClass("thisRow", this.checked);
    });

});

/*
oTable = $('table').dataTable({
    "bJQueryUI": false,
    "bAutoWidth": false,
    "sPaginationType": "full_numbers",
    "sDom": '<"H"fl>t<"F"ip>'
});
*/

$('table').dataTable({
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bSort": true,
    "bInfo": false,
    "bAutoWidth": false
});