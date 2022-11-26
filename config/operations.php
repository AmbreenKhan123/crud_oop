<?php
session_start();

require_once('./config/dbconfig.php');
$db = new dbconfig();

class operations extends dbconfig
{
    // Insert Record in the Database
    public function Store_Record()
    {
        global $db;
        if (isset($_POST['submit'])) {
            $name = $db->check($_POST['st_name']);
            $roll_no = $db->check($_POST['roll_no']);
            $st_class = $db->check($_POST['st_class']);
            $st_section = $db->check($_POST['st_section']);
            $code = $_POST['sbj_code'];
            $sbj_name = $_POST['sbj_name'];

            if ($this->insert_record($name, $roll_no, $st_class, $st_section, $code, $sbj_name)) {
                echo $this->set_messsage('<div class="alert alert-success"> Your Record Has Been Saved :) </div>');
                header("location:view.php");
            } else {
                echo $this->set_messsage('<div class="alert alert-danger"> Failed </div>');
            }
        }
    }


    // Insert Record in the Database Using Query    
    function insert_record($name, $roll_no, $st_class, $st_section, $code, $sbj_name)
    {
        global $db;
        $query = "INSERT INTO  `st_form` ( `st_name`, `roll_no`, `st_class`, `st_section`) values('$name','$roll_no','$st_class','$st_section')";
        // $result = mysqli_query($db->connection,$query);

        if (mysqli_query($db->connection, $query)) {
            $last_id = mysqli_insert_id($db->connection);
            echo " Last inserted ID is:" . $last_id . "";
            // return true;
        } else {
            // return false;
        }
        if (isset($last_id)) {
            foreach ($code as $index => $names) {
                // echo $names."_".$sbj_name[$index];

                $s_code = $names;
                $sb_name = $sbj_name[$index];

                $query2 = "INSERT INTO `st_sbject`(`st_id`, `sbj_code`, `sbj_name`)VALUES ('$last_id','$s_code','$sb_name')";
                // print_r($query2 );
                $result2 = mysqli_query($db->connection, $query2);
            }
        }
        if (isset($result2)) {
            return true;
        }
        return false;
    }

    //    View Database Record
    public function view_record()
    {
        global $db;
        $query = "SELECT * FROM `st_form`";
        $result = mysqli_query($db->connection, $query);
        return $result;
    }


    // Get Particular Record
    public function get_record($id)
    {
        global $db;
        $sql = "SELECT * FROM st_form WHERE id='" . $_GET['id'] . "'";
        $data = mysqli_query($db->connection, $sql);
        return $data;
    }


    public function get_subject_records($id)
    {
        global $db;
        $st_subj = "SELECT * FROM st_sbject WHERE st_id='" . $_GET['id'] . "'";
        $row_sbj = mysqli_query($db->connection, $st_subj);
        // $row_sub = mysqli_fetch_array($row_sbj);
        return  $row_sbj;
    }


    // Update Record
    public function update()
    {
        global $db;

        if (isset($_POST["submit_update"])) {
            $st_id = $_POST['id'];
            $name_upd = $db->check($_POST['st_name']);
            $roll_noupd = $db->check($_POST['roll_no']);
            $st_classupd = $db->check($_POST['st_class']);
            $st_sectionupd = $db->check($_POST['st_section']);
            $sbj_id = $_POST['sbj_id'];
            $code_upd = $_POST['sbj_code'];
            $sbj_nameupd = $_POST['sbj_name'];

            if ($this->update_record($st_id, $name_upd, $roll_noupd, $st_classupd, $st_sectionupd, $sbj_id, $code_upd, $sbj_nameupd)) {
                echo $this->set_messsage('<div class="alert alert-success"> Your Record Has Been Updated : )</div>');
                header("location:view.php");
            } else {
                echo $this->set_messsage('<div class="alert alert-success"> Something Wrong : )</div>');
            }
        }
    }

    // Update Function 2
    public function update_record($st_id, $name_upd, $roll_noupd, $st_classupd, $st_sectionupd, $sbj_id, $code_upd, $sbj_nameupd)
    {
        global $db;
        $sql = "UPDATE `st_form` SET `st_name`='$name_upd', `roll_no`=$roll_noupd, `st_class`='$st_classupd' , `st_section`='$st_sectionupd' WHERE id = $st_id ";
        $result = mysqli_query($db->connection, $sql);
        if ($result) {
            // return true;
        } else {
            // return false;
        }
        $sql_dlt = "DELETE FROM `st_sbject` WHERE `st_id` =  $st_id ";
        $dlt_result = mysqli_query($db->connection, $sql_dlt);
        if (isset($dlt_result)) {

            foreach ($code_upd as $index => $names) {
                // echo $names."_".$sbj_name[$index];

                $s_codeupd = $names;
                $sb_nameupd = $sbj_nameupd[$index];

                $update2 = "INSERT INTO `st_sbject`(`st_id`, `sbj_code`, `sbj_name`)VALUES ('$st_id','$s_codeupd','$sb_nameupd')";
                // print_r($update2);
                // die;
                $result_upd = mysqli_query($db->connection, $update2);
            }
        }
        if (isset($result_upd)) {
            return true;
        }
        return false;
    }


    //Delete Record

    public function Delete_Record($id)
    {
        global $db;
        $del_query = "DELETE FROM `st_form` WHERE `id` = $id";
        $del_result = mysqli_query($db->connection, $del_query);
        if ($del_result) {
            return true;
        } else {
            return false;
        }
    }

    // Set Session Message
    public function set_messsage($msg)
    {
        if (!empty($msg)) {
            $_SESSION['Message'] = $msg;
        } else {
            $msg = "";
        }
    }

    // Display Session Message
    public function display_message()
    {
        if (isset($_SESSION['Message'])) {
            echo $_SESSION['Message'];
            unset($_SESSION['Message']);
        }
    }
}
