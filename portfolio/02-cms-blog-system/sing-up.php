<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php

if (isset($_POST["submit"])) {

    $username = escape($_POST["username"]);
    $email = escape($_POST["email"]);
    $password = escape($_POST["password"]);
    $firstname = escape($_POST["firstname"]);
    $lastname = escape($_POST["lastname"]);

    $username = mysqli_real_escape_string($con, $username);
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = mysqli_real_escape_string($con, $lastname);

    $password = password_hash($password, PASSWORD_BCRYPT, array('const' => 12));

    $query = "INSERT INTO users (username, user_email , user_password, user_lastname, user_firstname)";
    $query .= " VALUES ('{$username}', '{$email}', '{$password}', '{$lastname}', '{$firstname}' ) ";

    $register_query = mysqli_query($con, $query);

    if (!$register_query) {
        die("QUERY FAILED" . mysqli_error($con));
    }

}


?>
    <!-- Navigation -->

<?php include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <h1>Sing Up</h1>
                            <form role="form" action="sing-up.php" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                           placeholder="Enter Desired Username" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="sr-only">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control"
                                           placeholder="Enter Your Firstname" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="sr-only">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                           placeholder="Enter Your Lastname" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           placeholder="somebody@example.com" required="required">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="password" type="password" required="required"
                                           placeholder="password"
                                           name="password">
                                </div>
                                <div>
                                    <input class="form-control" id="confirm_password" type="password"
                                           required="required"
                                           placeholder="confirm password">

                                    <script>
                                        var password = document.getElementById("password")
                                            , confirm_password = document.getElementById("confirm_password");

                                        function validatePassword() {
                                            if (password.value != confirm_password.value) {
                                                confirm_password.setCustomValidity("Passwords Don't Match");
                                            } else {
                                                confirm_password.setCustomValidity('');
                                            }
                                        }

                                        password.onchange = validatePassword;
                                        confirm_password.onkeyup = validatePassword;
                                    </script>

                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" name="submit" id="btn-login"
                                           class="btn btn-primary btn-lg btn-block" value="Sing Up!">
                                </div>
                                <p align="center">Already Singed-up? <a href="index.php?source=already-user"
                                                                        class="stretched-link">Login
                                        Here</a></p>
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>


        <hr>


<?php include "includes/footer.php"; ?>