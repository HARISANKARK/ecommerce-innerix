
function calcProductStock()
{
    var product_id = null;
    $.ajax({
        type: 'GET',
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'), // CSRF token if needed
        },
        url: $('#BASE_URL').val() + '/orders/calc_product_stock/' + product_id, // Use GET and pass product_id in URL
        success: function(data) {
            if (data) {
                // console.log('data = '+data);
                data.forEach(function (item) {
                    if (item.balance_qty <= 0) {
                        $('#' + item.product_id).hide();
                        $('#' + item.product_id + 'out').show();
                    } else {
                        $('#' + item.product_id).show();
                        $('#' + item.product_id + 'out').hide();
                    }
                });
            }
        },
    });
}
