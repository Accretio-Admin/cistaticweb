$('#tbl_quota_report').on('click','#orderbydate', function(){
    let orderby = $(this).data('order');
    let date = $('.datetimepicker').val();

    if(orderby === 'desc')
    {
        $(this).data('order','asc');
        orderby = 'asc';
        $('#orderbydate > i').removeClass('fa-sort-down');
        $('#orderbydate > i').addClass('fa-sort-up');
    }
    else
    {
        $(this).data('order','desc');
        orderby = 'desc';
        $('#orderbydate > i').removeClass('fa-sort-up');
        $('#orderbydate > i').addClass('fa-sort-down');
    }

    load_quota_report(date,orderby);

});

$('#qr_btn_search').on('click',function(){
    let orderby = $('#orderbydate').data('order');
    let date = $('.datetimepicker').val();

    if(orderby === 'desc')
    {
        $(this).data('order','asc');
        $('#orderbydate > i').removeClass('fa-sort-up');
        $('#orderbydate > i').addClass('fa-sort-down');
    }
    else
    {
        $(this).data('order','desc');
        $('#orderbydate > i').removeClass('fa-sort-down');
        $('#orderbydate > i').addClass('fa-sort-up');
    }

    load_quota_report(date,orderby);
    
});

function load_quota_report(date,orderby)
{
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: base_url+"Network/load_quota_report_content",
        data: {
            date: date,
            orderby: orderby
        },
        beforeSend: function () {
        $(".btn").prop("disabled", true);
        },
        complete: function () {
        $(".btn").prop("disabled", null);
        },
        success: function (response) {
            $('#tbl_quota_report > tbody').html(response['table_content'])
        },
        error: function () {
        $.alert({
            title: "Error!",
            content: "Failed!",
        });
        },
    });
}