<?php
    session_start();
    require_once('../_include/_models/db.php');
    $login = new Database();
    echo $login->lastError();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['crsf_token'])) {
        if (hash_equals($_SESSION['crsf_token'], $_POST['crsf_token'])) {
           $email = mysqli_real_escape_string($login->db, $_POST['email']);
           $pwd =  mysqli_real_escape_string($login->db, $_POST['password']);
           $sql = 'select admin_ID, email, password, name from admin where email = "'.$email.'"';
           echo $sql;
           $checkUserExists = $login->q($sql);
           $fetchAdminData = $checkUserExists->fetch_assoc();
           if(password_verify($pwd, $fetchAdminData['password'])){
               $_SESSION['admin_ID'] = $fetchAdminData['admin_ID'];
               $_SESSION['name'] = $fetchAdminData['name'];
               header('Location: ../');
            }else{
               echo "issue";
           }
        } else {
            // Log this as a warning and keep an eye on these attempts
        }
    }
?>