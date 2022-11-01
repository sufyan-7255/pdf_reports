<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Select 2 Form</title>
</head>

<body>
    <div class="container">
        <br><br>
        <h3 class="text-secondary">Dynamic Select Controller:</h3><br>
        <form action="" id="form" method="POST" class="form-control">
            <div class="row">
                <div class="col-md-6">
                    <select class="js-example-basic-single form-control" id="company_id" name="company_id">

                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" selected readonly class="form-control" name="company_name" id="company_name" placeholder="Company Name">
                </div>
                <br><br>
                <center><div class="col-6"><a id="submit" type="submit" name="submit" class="btn btn-success">Submit Record</a></div></center>


            </div>
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();


            // company code dropdown
            $.ajax({
                url: 'company_api.php',
                type: 'POST',
                data: {
                    action: 'company_id'
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('#company_id').html('');
                    $('#company_id').append('<option value="" selected disabled>Select Company</option>');
                    $.each(response, function(key, value) {
                        $('#company_id').append('<option data-name="' + value["company_name"] + '"  data-code=' + value["company_id"] + ' value=' + value["company_id"] + '>' + value["company_id"] + ' - ' + value["company_name"] + '</option>');
                    });
                },
                error: function(error) {
                    console.log(error);
                    alert("Contact IT Department");
                }
            });
            $("#form").on('change', '#company_id', function() {

                var company_name = $('#company_id').find(':selected').attr("data-name");
                var company_id = $('#company_id').find(':selected').attr("data-code");
                $('#select2-company_id-container').html(company_id);
                $('#company_name').val(company_name);
                $('#submit').attr('href', 'pdf_data_view.php?sid='+company_id);

            });
        });
    </script>
</body>

</html>
