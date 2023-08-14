<!-- DEBUG-VIEW START 1 APPPATH/Views/login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- ajax  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- toastify  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- my css -->
    <link rel="stylesheet" type="text/css" href="<?= url('style.css')?>">

    <!-- datatable  -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Online Attendance</title>
</head>
<?php

use Illuminate\Support\Facades\Cookie;

$email = '';
$password = '';
$checked = '';

if (Cookie::get('rememberme') == '1') {
  $email = Cookie::get('email');
  $password = Cookie::get('password');
  $checked = 'checked';
  echo $email;
} ?>
<body>
    <div class="container bg">
        <div class="card  mt-3" style='border:none'>
            <form id='loginform' class='bg'>
                <div class="col-lg-6 col-md-8 col-xs-12 login_Container">
                    <div class="col">
                        <h3 class='mb-3'> Login </h3>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name='username' id='username' value='<?= $email ?>' placeholder="Email" aria-label="Username" value=''>
                        </div>
                    </div>
                    <div class="col mb-1">
                        <input type="password" minlength="4" class="form-control" name='password' value='<?= $password ?>' id='password' placeholder="Password" aria-label="Password" value=''>
                    </div>
                    <div class="form-check mb-3">
                    <input type="checkbox" <?= $checked ?>name='Remember'  id="r" >
                        <label class="form-check-label" for="exampleCheck1"> Remember Me</label>
                    </div>
                    <div class="col mb-3">
                        <button type="submit" class="login_Btn btn btn-primary col-lg-12 col-md-12 col-xs-12">Login</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#loginform').submit(function(e) {
                e.preventDefault();
                var remember = 'off';
                if($('#r').is(':checked')) {
                    remember = 'on';
                }
                // alert(remember);
                $.ajax({
                    type: "POST",
                    url: "<?= url('/logincheck') ?>",
                    data: {
                        users_email: $('#username').val(),
                        users_password: $('#password').val(),
                        remember: remember,
                        _token: '<?php echo csrf_token(); ?>',
                    },
                    cache: false,
                    success: function(data) {
                        if (data.status == 200) {
                            Toastify({
                                text: "Login Successfull",
                                style: {
                                    background: 'green',
                                },
                                duration: 2000
                            }).showToast();
                            setTimeout(function() {
                                window.location.href = '<?= url('dashboard') ?>';
                            }, 2000);
                        } else {
                            Toastify({
                                text: data.result,
                                style: {
                                    background: 'red',
                                },
                                duration: 2000
                            }).showToast();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
<!-- DEBUG-VIEW ENDED 1 APPPATH/Views/login.php -->