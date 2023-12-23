<script>
    $(document).on("click",".success_myForm", function(){	
        var product_id = "good";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $.ajax({
            async: false,
            method: "post",
            url: "{{url(LaravelLocalization::getCurrentLocale())}}" + "/dashboard/test",
            data: {
                product_id: product_id,
        },
        
        success: function (data) {
            alert('asd');
        },
        error: function (data) {
            alert('false');
        }
        });
    })
</script>