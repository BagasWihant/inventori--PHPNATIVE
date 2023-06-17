<?php
         include '../config/config.php';

            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $sql_login = mysqli_query($con, "SELECT * FROM tbuser WHERE username='$user' AND password='$pass'");
            if (mysqli_num_rows($sql_login) > 0) {
                echo "success";
                $data = mysqli_fetch_assoc($sql_login);
                $_SESSION['user'] = $data['username'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['level'] = $data['level'];
            } else {
                echo "error";
            }
               
               
        