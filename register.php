<?php

session_start();

include 'connection.php';

$recaptchaSecretKey = '6Le8qm8pAAAAADkpNttV02JPwp4oLoXmbIrFL7P4';
$captchaNotDone = true;

$_SESSION['submittedForm'] = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    if (!empty($recaptchaResponse)) {
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = array(
            'secret' => $recaptchaSecretKey,
            'response' => $recaptchaResponse
        );

        $recaptchaOptions = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaData)
            )
        );

        $recaptchaContext = stream_context_create($recaptchaOptions);
        $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
        $recaptchaData = json_decode($recaptchaResult);

        if ($recaptchaData->success === true) {
            $captchaNotDone = false;
            $_SESSION['submittedForm'] = false;

            $firstname = htmlspecialchars($_POST['firstname']);
            $middlename = htmlspecialchars($_POST['middlename']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $user_name = htmlspecialchars($_POST['username']);
            $pass_word = htmlspecialchars($_POST['password']);
            $confirmpassword = htmlspecialchars($_POST['confirmpassword']);
            $email = htmlspecialchars($_POST['email']);
            $phonenumber = htmlspecialchars($_POST['phonenumber']);
            $birthday = htmlspecialchars($_POST['birthday']);
            $currentDate = new DateTime();
            $birthdayDate = new DateTime($birthday);

            $interval = $currentDate->diff($birthdayDate);
            $age = $interval->y;
            $gender = htmlspecialchars($_POST['genderselect']);
            $country = htmlspecialchars($_POST['countryselect']);
            $regionorstate = htmlspecialchars($_POST['regionselect']);
            $city = htmlspecialchars($_POST['cityselect']);
            $postcode = htmlspecialchars($_POST['postcode']);
            $barangay = htmlspecialchars($_POST['barangay']);
            $street = htmlspecialchars($_POST['street']);
            $recoverypassword = htmlspecialchars($_POST['recoverypassword']);
            $termservice = false;

            if (isset($_POST['termservice'])) {
                $termservice = true;
            }

            if (empty($firstname) || empty($lastname) || empty($user_name) || empty($pass_word) || empty($confirmpassword) || empty($email) || empty($phonenumber) || empty($birthday) || (empty($gender) && $gender === "Specify") || (empty($country) && $country === "Your country") || (empty($regionorstate) && $regionorstate === "Your region") || (empty($city) && $city === "Your city") || empty($postcode) || (empty($barangay) && $barangay === "Your barangay") || empty($street)) {
                echo "All fields are required.";
                exit;
            } else {

            }

            $user_ip = null;
            $accountType = 'User';
            $status = 'Online';
            $user_activity = '0';
            $hashedPassword = password_hash($pass_word, PASSWORD_DEFAULT);
            $hashedId = str_replace(['.', '/'], '', uniqid() . substr($hashedPassword, 13, 9));

            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $user_ip = $_SERVER['REMOTE_ADDR'];
            }

            $insertAccountSql = "INSERT INTO users (hashed_id, username, password, recoverypassword, firstname, middlename, lastname, email, contactnumber, gender, age, bio, birthday, country, regionstate, city, postcode, barangay, street, ip_address, account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertAccountSql);

            mysqli_stmt_bind_param($stmt, "ssssssssssissssssssss", $hashedId, $user_name, $hashedPassword, $recoverypassword, $firstname, $middlename, $lastname, $email, $phonenumber, $gender, $age, $bio, $birthday, $country, $regionorstate, $city, $postcode, $barangay, $street, $user_ip, $accountType);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $_SESSION['isLoggedIn']['status'] = true;
                $_SESSION['username'] = $user_name;
                $_SESSION['userid'] = mysqli_insert_id($conn);
                $_SESSION['hashedid'] = $hashedId;

                header("Location:home");
            } else {
                echo "Error encountered while signing up.";
            }

            exit();
        } else {
            if (isset($_POST['submit'])) {
                header('Location: signup');
                $captchaNotDone = true;
                $_SESSION['submittedForm'] = true;
                exit();
            }


        }
    } else {
        if (isset($_POST['submit'])) {

            $captchaNotDone = true;
            $_SESSION['submittedForm'] = true;

            if ($_SESSION['submittedForm']) {
                header('Location: signup');
            }

            exit();
        } else {
            $_SESSION['submittedForm'] = false;
        }
    }
} else {


    $captchaNotDone = false;
    $_SESSION['submittedForm'] = false;
}

?>