
<?php


if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password =  $_POST['password'];


    $sql = $mysqli->prepare("SELECT * FROM user_tbl INNER JOIN student_faculty_profile_tbl as prfl INNER JOIN institution_tbl as institution ON institution.name = prfl.institution WHERE user_tbl.user_id = prfl.user_id AND email = ?");
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            if (password_verify($password, $row["password"]) && $row["usertype"] == "Student") {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['usertype'] = $row['usertype'];
                $_SESSION['institution_id'] = $row['institution_id'];
                $_SESSION['email'] = $row['email'];

                header("location:home-student.php?page=user-home");
            } else if (password_verify($password, $row["password"]) && $row["usertype"] == "Faculty") {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['usertype'] = $row['usertype'];
                $_SESSION['institution_id'] = $row['institution_id'];
                $_SESSION['email'] = $row['email'];

                header("location:home-student.php?page=user-home");
            }else if (password_verify($password, $row["password"]) && $row["usertype"] == "Personnel") {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['usertype'] = $row['usertype'];
                $_SESSION['institution_id'] = $row['institution_id'];
                $_SESSION['email'] = $row['email'];

                header("location:home-student.php?page=user-home");
            }else if(password_verify($password, $row["password"]) && $row["usertype"] == "Admin"){
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['usertype'] = $row['usertype'];
                header("location:admin/home-admin.php?page=admin-dashboard");
            }else{
                $_SESSION['errMsg'] = "Invalid Username or Password";
                $_SESSION['success'] = 'danger';
                header("location:index.php?page=login");
            }
        }
    } else {
        $_SESSION['errMsg'] = "This Account Doesn't Exist";
        $_SESSION['success'] = 'danger';
        header("location:index.php?page=login");
    }
    $sql->close();

}
