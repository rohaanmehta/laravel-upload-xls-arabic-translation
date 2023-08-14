<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- my css -->
    <link rel="stylesheet" type="text/css" href="<?= url('style.css') ?>">

    <title> Dashboard </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body>
    <div class="topnav" id="myTopnav" style='display:flex;justify-content:end'>
        <div>
            <button type="button" style='height:35px;margin-top:9px;padding-top:5px;' class="logout m-2 login_Btn btn btn-primary col-lg-0 col-md-0 col-xs-2">LOGOUT</button>
        </div>
    </div>
    <div class="container" style='background:#f7f7f7;padding:20px;border-radius:5px;margin-top:30px;'>
        <div class="row mb-4" style='justify-content:center'>
            <div class="col-12 col-md-8 col-lg-4">
                <form method='post' id='form' action='<?php echo url('/excel'); ?>' enctype='multipart/form-data'>
                    @csrf
                    <label class='form-label'> Upload your excel file </label>
                    <div class="custom-file">
                        <input type="file" name='excel' required class="form-control custom-file-input" accept=".xls" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <div class='d-flex justify-content-between'>
                            <p class='text-danger mb-3' style='font-size:13px'> *only xls file are supported </p><a style='font-size:12px' href='<?= url('uploads/sample/sample.xls')?>' target='_blank' download> Download Sample File</a>
                        </div>
                        <button class='btn btn-primary w-100'> Submit </button>
                        <div class='status' style='display:none'>
                            <div class=' d-flex mb-2' style='align-items:center;'>
                                <span class='mr-2' style='font-size:13px'> Your File will be downloaded automatically once prepared </span>
                                <!-- <div class="spinner-border spinner-border-sm" role="status"></div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $('#form').submit(function() {
                $('.status').css('display','block');
            });

            $('.logout').click(function() {
                $.ajax({
                    type: "POST",
                    url: "<?= url('/logout') ?>",
                    data: {
                        _token: '<?php echo csrf_token(); ?>',
                    },
                    dataType: "json",
                    success: function(data) {
                        setTimeout(function() {
                            window.location.href = '<?= url('/') ?>';
                        }, 1000);
                    }
                });
            });
        });
    </script>
</body>

</html>