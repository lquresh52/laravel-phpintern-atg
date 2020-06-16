<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Login</title>

    {{-- Ajax online url --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <style>
        html {
            height: 100%;
        }

        body {
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background: #1a2a6c;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #fdbb2d, #b21f1f, #1a2a6c);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #fdbb2d, #b21f1f, #1a2a6c);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .center_div {
            margin: 0 auto;
            width: 80%;
            /* value of your choice which suits your alignment */
        }

    </style>

</head>

<body>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class='container center_div col-md-6 shadow p-3 mb-5 bg-white rounded'>

        <div class="container" style="text-align:center;">
            <h1>Login</h1>
            <br>
            @if(count($errors) > 0)

                <div class="alert alert-success" role="alert">
                    @foreach($errors->all() as $error)
                        <h2 style="color: #00cc00"> {{ $error }} </h2>
                    @endforeach
                </div>

            @endif

            <div id="messages"></div>

            <?php if(strlen($duplicate_data)>0){ ?>
            <div class="alert alert-danger" role="alert">
                <h2 style="color: red"> {{ $duplicate_data }} </h2>
            </div>
            <?php } ?>
            <?php if(strlen($sucess_msg)>0) { ?>
            <div class="alert alert-success" role="alert">
                <h2 style="color: #00cc00"> {{ $sucess_msg }} </h2>
            </div>
            <?php  } elseif (strlen($pin_error_msg)) { ?>
            <div class="alert alert-danger" role="alert">
                <h2 style="color: red">{{ $pin_error_msg }} </h2>
            </div>
            <?php   } ?>
        </div>

        <form id="form-data" name="form1" data-route="{{ route('post_user_data_save') }}"
            method="post">
            {{-- <form id="form" > --}}
            @csrf

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input name="user_name" type="text" class="form-control" id="exampleInputName">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="gmail_id" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="exampleInputPincode">Pincode</label>
                <input type="number" name="pincode" class="form-control" id="exampleInputPincode" maxlength="6"
                    required />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div id="demo"></div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $('#form-data').submit(function (e) {

                var route = $('#form-data').data('route');
                // alert(route);
                var form_data = $(this);
                var user_name = $(this.user_name).val();
                var gmail = $(this.email).val();
                var pincode = $(this.text1).val();
                // alert(user_name+gmail+pincode);
                $('.alert').remove();
                $.ajax({
                    type: 'POST',
                    // url: route,
                    // url: "http://localhost/laravelwebsite/api/user_data?user_name="+user_name+"&gmail_id="+gmail+"&pincode="+pincode+"",
                    url: "https://phpintern-atg.herokuapp.com/api/user_data?user_name="+user_name+"&gmail_id="+gmail+"&pincode="+pincode+"",
                    data: form_data.serialize(),
                    success: function (Response, status) {
                        // alert(status);
                        console.log(Response);
                        console.log("Check log working or not");
                        if (Response.message) {
                            $('#messages').append(
                                '<h2 class="sucess" style="color: #00cc00">' + Response
                                .message + '</h2>');
                        }
                        if (Response.user_name) {
                            $('#messages').append('<h2 class="sucess" style="color: red">' +
                                Response.user_name + '</h2>');
                        }
                        if (Response.gmail_id) {
                            $('#messages').append('<h2 class="sucess" style="color: red">' +
                                Response.gmail_id + '</h2>');
                        }
                        if (Response.pincode) {
                            $('#messages').append('<h2 class="sucess" style="color: red">' +
                                Response.pincode + '</h2>');
                        }
                    }
                });

                e.preventDefault();
            });
        });

    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> --}}
</body>

</html>
