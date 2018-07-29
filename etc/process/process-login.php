<?php
    session_start();
    require_once('../_include/_models/admin.php');
    require_once('../_include/_models/db.php');
    $loginConn = new Database();
    $loginAdmin = new Administrator($loginConn->db);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['crsf_token'])) {
        if (hash_equals($_SESSION['crsf_token'], $_POST['crsf_token'])) {
            $email = mysqli_real_escape_string($loginConn->db, $_POST['email']);
            $pwd =  mysqli_real_escape_string($loginConn->db, $_POST['password']);
            $fetchAdminData = $loginAdmin->fetchAdmin('select admin_ID, adminPrivilege, email, password, name from admin where email = "'.$email.'"');
            if($fetchAdminData){
                if(password_verify($pwd, $fetchAdminData->password)){
                    $_SESSION['admin_ID'] = $fetchAdminData->admin_ID;
                    $_SESSION['admin_privilege'] = $fetchAdminData->adminPrivilege;
                    $_SESSION['name'] = $fetchAdminData->name;
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                   header('Location: ../');
                }else{
                    echo header('Location: ../?login-error=true');
               }
            }else{
                echo header('Location: ../?login-error=true');
            }
        } else {
            // Log this as a warning and keep an eye on these attempts
        }
    }
?>