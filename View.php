<?php

require_once('./config/dbconfig.php');
$db = new operations();
$result = $db->view_record();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>show data</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
</head>

</style>

<body>

    <div class="container">
        <!-- call to function display message -->
        <?php
        $db->display_message();
        $db->display_message();
        ?>

        <div class="row form-inline">
            <div class="form-group col-md-10">
                <h2>Student Information</h2>
            </div>
            <div class="form-group">
                <a type="button" href="index.php" class="btn btn-primary"> ADD STUDENTS</a>
            </div>
        </div>
        <!-- view Data Code -->
        <div class="row">
            <table class="table table-hover table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Student Name</th>
                        <th>Roll No</th>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                        <?php
                        $student_id = $row['id'];
                        $s_query2 = "SELECT * FROM `st_sbject` where st_id = '$student_id'";
                        $s_result2 = mysqli_query($db->connection, $s_query2);
                        // print_r($s_result2);
                        $subject = "";
                        while ($row2 = mysqli_fetch_assoc($s_result2)) {
                            $subject = $subject  . ' ' . $row2['sbj_name'];
                        }
                        ?>

                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['st_name'] ?></td>
                            <td><?php echo $row['roll_no'] ?></td>
                            <td><?php echo $row['st_class'] . "_" . $row['st_section'] ?></td>

                            <td><?php echo $subject; ?></td>

                            <td><a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">EDIT</a></td>
                            <td><a href="del.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a></< /td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>


</body>
<script>

</script>

</html>