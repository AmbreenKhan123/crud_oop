<?php 
    require_once('./config/dbconfig.php'); 
    $db = new operations();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
	
</head>
<body>
<div class="container">
        <center>
            <div class="row">
                <div class="col">
                    <h1>Student Form</h1>
                </div>
            </div>

            <form style="width:50%;" method="POST" action="" id="form1">


                <div class="row">
                    <div class="form-row">

                    <?php $db->Store_Record(); ?>

                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="st_name" placeholder="Student Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" name="roll_no" placeholder="Roll No" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="st_class" placeholder="Class" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="st_section" placeholder="Section" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="button" id="button1" class="btn btn-primary">Add Subject</button>
                        </div>

                        <table class="table table-responsive" id="myTable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Subject No</th>
                                    <th>Subject Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                        </table>

                        <div class="form-group col-md-12">
                            <input type="submit" value="Save" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>

            </form>
        </center>
    </div>
</body>
<!-- Jquery Code -->
<script type="text/javascript">
    $(document).ready(function() {



        $(document).on('click', '.remove-btn', function() {
            ;

            $(this).closest('tr').remove();

            $('tr').each(function(index) {
                $(this).find('span.sn').html(index + 1);
            });


        });
        let someValue = 1;
 

        

        $("#button1").on('click', function() {
            $('#myTable tr:last').after('<tr><td>' + someValue + '</td><td>\
            <input type="text" class="form-control" name="sbj_code[]" placeholder="Subject Code"></td>\
            <td><input type="text" class="form-control" name="sbj_name[]" placeholder="Subject Name"></td>\
            <td><button type="button" id="button1" class="remove-btn btn btn-danger">Remove</button></td></tr>');
            someValue++;
        });


        $("#form1").validate({

            rules: {
                st_name: {
                    required: true,
                    minlength: 3,
                    nowhitespace: true,
                    lettersonly: true
                },
                roll_no: {
                    required: true,
                    minlength: 1,
                    nowhitespace: true
                },
                st_class: {
                    required: true,
                    minlength: 2,
                    nowhitespace: true,
                    lettersonly: true
                },
                st_section: {
                    required: true,
                    minlength: 1,
                    lettersonly: true,
                    nowhitespace: true
                },
                'sbj_code[]': {
                    required: true,
                    minlength: 3,
                    maxlength: 3,
                    nowhitespace: true
                },
                'sbj_name[]': {
                    required: true,
                    minlength: 3

                }
            },



            //    if you want to show your own messages instead of pre_defined messages
            messages: {
                st_name: {
                    required: "Name is mandatory",
                    minlength: "Enter atleast 3 letters"
                },
                roll_no: {
                    required: "Roll No is mandatory",
                    minlength: "Enter atleast 1 letters"
                },
                st_class: {
                    required: "Class Name is mandatory",
                    minlength: "Enter atleast 3 letters"
                },
                st_section: {
                    required: "Section Name is mandatory",
                    minlength: "Enter only one letter"
                },
                'sbj_code[]': {
                    required: "Subject Code is mandatory",
                    minlength: "Enter three numbers"
                },
                'sbj_name[]': {
                    required: "Subject Name is mandatory",
                    minlength: "Enter atleast three letters"
                }
            }

        });
    })
</script>


</html>