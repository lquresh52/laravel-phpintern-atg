$(function(){

    $('#form-data').submit(function(e){

        var route = $('#form-data').data('route');
        var form_data = $(this);
        var user_name = $(this.user_name).val();
        var gmail = $(this.email).val();
        var pincode = $(this.text1).val();
        $('.alert').remove();
        $.ajax({
            type: 'POST',
            url: "https://phpintern-atg.herokuapp.com/api/user_data?user_name="+user_name+"&gmail_id="+gmail+"&pincode="+pincode+"",
            data: form_data.serialize(),
            success: function(Response , status){
                console.log(Response);
                console.log("Check log working or not");
                if(Response.message){
                    $('#messages').append('<h2 class="sucess" style="color: #00cc00">'+Response.message+'</h2>');
                }
                if(Response.user_name){
                    $('#messages').append('<h2 class="sucess" style="color: red">'+Response.user_name+'</h2>');
                }
                if(Response.gmail_id){
                    $('#messages').append('<h2 class="sucess" style="color: red">'+Response.gmail_id+'</h2>');
                }
                if(Response.pincode){
                    $('#messages').append('<h2 class="sucess" style="color: red">'+Response.pincode+'</h2>');
                }
            }
        });

        e.preventDefault();
    });
});
