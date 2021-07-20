$(function() {
    $(document).ready(function() {
        //alert('working');
        $('.delcat').click(function() {
            var id = $(this).data('id');
            var text = $(this).data('text');
            $.ajax({
                type: 'POST',
                url: surl+'admin/deleteCategory',
                data: {
                    id:id,
                    text:text
                },
                success:function(data) {
                    var ndata = JSON.parse(data);
                    if(ndata.return == true) {
                        $('.error').text(ndata.message);
                        $('.ccat'+id).fadeOut();

                    }
                    else if(ndata.return == false) {
                        $('.error').text(ndata.message);

                    }
                    else{
                        $('.error').text('Something went wrong.');

                    }
                    //console.log(ndata);
                    //console.log(data);
                },
                error:function() {
                    $('.error').text('Something went wrong.');

                }
            });
        });

        $('.delproduct').click(function() {
            var id = $(this).data('id');
            var text = $(this).data('text');
            $.ajax({
                type: 'POST',
                url: surl+'admin/deleteProduct',
                data: {
                    id:id,
                    text:text
                },
                success:function(data) {
                    var ndata = JSON.parse(data);
                    if(ndata.return == true) {
                        $('.error').text(ndata.message);
                        $('.ccat'+id).fadeOut();

                    }
                    else if(ndata.return == false) {
                        $('.error').text(ndata.message);

                    }
                    else{
                        $('.error').text('Something went wrong.');

                    }
                    //console.log(ndata);
                    //console.log(data);
                },
                error:function() {
                    $('.error').text('Something went wrong.');

                }
            });
        });

        $('.delmodel').click(function() {
            var id = $(this).data('id');
            var text = $(this).data('text');
            $.ajax({
                type: 'POST',
                url: surl+'admin/deleteModel',
                data: {
                    id:id,
                    text:text
                },
                success:function(data) {
                    var ndata = JSON.parse(data);
                    if(ndata.return == true) {
                        $('.error').text(ndata.message);
                        $('.ccat'+id).fadeOut();

                    }
                    else if(ndata.return == false) {
                        $('.error').text(ndata.message);

                    }
                    else{
                        $('.error').text('Something went wrong.');

                    }
                    //console.log(ndata);
                    //console.log(data);
                },
                error:function() {
                    $('.error').text('Something went wrong.');

                }
            });
        });

        // the + button to create feilds to add specs
        $(function() {
            $('.add_spec').click(function() {
                var sp_count = $('.sp_cn').length;
                var items = "";
                items +="<div class='form-group contspecvalue rmov"+sp_count+"'>";
                items +="<input type='text' name='sp_value[]' class='form-control sp_cn' placeholder='Spec value'>"; 
                items +="<a href='javascript:void(0)' class='remov_spec' data-id="+sp_count+">-</a>"; 

                items +="</div>";
                console.log(sp_count);
                if(sp_count <=5) {
                    $('.htmlitem').append(items)
                }
        

            });

        });
        $('body').on("click","a.remov_spec", function(){
            var current = $(this).data('id');
            console.log(current);
            $('.rmov'+current).remove();
        });


        $('.specNow').click(function() {
            var id = $(this).data('id');
            var text = $(this).data('text');
            $.ajax({
                type: 'POST',
                url: surl+'admin/deleteSpec',
                data: {
                    id:id,
                    text:text
                },
                success:function(data) {
                    var ndata = JSON.parse(data);
                    if(ndata.return == true) {
                        $('.error').text(ndata.message);
                        $('.ccat'+id).fadeOut();

                    }
                    else if(ndata.return == false) {
                        $('.error').text(ndata.message);

                    }
                    else{
                        $('.error').text('Something went wrong.');

                    }
                    //console.log(ndata);
                    //console.log(data);
                },
                error:function() {
                    $('.error').text('Something went wrong.');

                }
            });
        });

    });// ready function ends here.
});