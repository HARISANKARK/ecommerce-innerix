
    function getProducts()
    {
        var category_id = $("#category_id").val();

        $.ajax({
            type : 'POST',
            data: { 'category_id':category_id ,
                '_token': $('meta[name="csrf-token"]').attr('content') // Assuming CSRF token is set in a meta tag
            },
            url : $('#BASE_URL').val()+'/products/get_products', //base url defined in main blade
            success:function(data)
            {
                $("#product_id").empty();
                $("#product_id").append('<option value="" hidden></option>');
                console.log('products',data);
                if(data){
                    data.forEach(function(item) {
                        $("#product_id").append('<option value=' + item['p_id'] + '>' + item['p_name'] + '</option>');
                    });
                }

            },
            // async: false
        });
    }
