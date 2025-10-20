<?php
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

session_start();
include('../functions/dbcon.php');

if(isset($_POST['regis-btn'])){ 

    $idnumber = mysqli_real_escape_string($con, $_POST['id_no']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $Rpassword = mysqli_real_escape_string($con, $_POST['Rpassword']);
    // $code = mysqli_real_escape_string($con, md5($_POST['email'].rand(10,9999)));
   
    $domain = substr(strrchr($email, "@" ), 1 );
    $whitelist = array('mbc.edu.ph', 'admin.mbc.edu.ph', 'gmail.com');

    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['message'] = "Email already registered";
        $_SESSION['modal_show'] = "registerModal";
        header("Location: ../index.php?url=home");
        exit();
    } 
    else if(!in_array($domain, $whitelist)){
        $_SESSION['message'] = "Invalid email please use your school email";
        $_SESSION['modal_show'] = "registerModal";
        header("Location: ../index.php?url=home");
        exit();
    }
    else{

        if($password == $Rpassword){

            $insert_query = "INSERT INTO users (firstname, lastname, email, phone, password, ver_code) VALUES ('$firstname', '$lastname', '$email', '$phone', '$password', '$code')";
            $insert_query_run = mysqli_query($con, $insert_query);
            $userid = mysqli_insert_id($con);

            $message = "
						<h2>Thank you for Registering.</h2>
						<p>Your Account:</p>
						<p>Email: ".$email."</p>
						<p>Password: ".$_POST['password']."</p>
						<p>Please click the link below to activate your account.</p>
						<a href='http://localhost/sti_proware/functions/activate.php?code=".$code."&user=".$userid."'>Activate Account</a>
					";

            // phpmailer
                require '../phpmailer/src/Exception.php';
                require '../phpmailer/src/SMTP.php';
                require '../phpmailer/src/PHPMailer.php';

                $mail = new PHPMailer(true);                             
                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
                    $mail->isSMTP();                                     
                    $mail->Host = 'smtp.gmail.com';                      
                    $mail->SMTPAuth = true;                               
                    $mail->Username = 'adriannoveda2@gmail.com';     
                    $mail->Password = 'nvyuxxarpuokyris';                
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                    );                         
                    $mail->SMTPSecure = 'ssl';                           
                    $mail->Port = 465;                                   

                    $mail->setFrom('adriannoveda2@gmail.com');
                    
                    //Recipients
                    $mail->addAddress($email);              
                    $mail->addReplyTo('donotreply@mbc.edu.ph');
                    
                    //Content
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Online Library Email Activation';
                    $mail->Body    = $message;

                    $mail->send();

                    if($insert_query_run){
                        $_SESSION['message'] = "Register Successfully, check your email for account activation.";
                        $_SESSION['modal_show'] = "registerModal";
                        header("Location: ../index.php?url=home");
                        exit();
                    }
                    else{
                        $_SESSION['message'] = "Something went wrong";
                        $_SESSION['modal_show'] = "registerModal";
                        header("Location: ../index.php?url=home");
                        exit();
                    }
                } 
                catch (Exception $e) {
                    $_SESSION['message'] = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
                   $_SESSION['modal_show'] = "registerModal";
                    header("Location: ../index.php?url=home");
                    exit();
                }
            }
            else{
            $_SESSION['message'] = "Password do not match";
            $_SESSION['modal_show'] = "registerModal";
            header("Location: ../index.php?url=home");
            exit();
        }
    }
}

else if(isset($_POST['login-btn'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    try{
        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0){
            $userdata = mysqli_fetch_assoc($login_query_run);

            if($userdata['status'] == 1){

                $_SESSION['auth'] = true;
                $_SESSION['user_id'] = (int)$userdata['id'];
                
                $role_as = $userdata['type'];

                $_SESSION['auth_user'] = [
                    'firstname' => $userdata['firstname'],
                    'email' => $userdata['email']
                ];

                $_SESSION['type'] = $role_as;

                if($role_as == 1){
                    $_SESSION['message'] = "Logged In Successfully as admin";
                    header("location: ../admin/home.php "); 
                }
                else{
                $_SESSION['message'] = "Logged In Successfully";
                header("location: ../student/home.php ");
                }
            }
            else{
                $_SESSION['message'] = "Activate your account.";
                $_SESSION['modal_show'] = "loginModal";
                header("Location: ../index.php?url=home");
                exit();
            }
        }
        else{
            $_SESSION['message'] = "Invalid Account";
            $_SESSION['modal_show'] = "loginModal";
            header("Location: ../index.php?url=home");
            exit();
        }
    }
    catch(Exception $e){
        $_SESSION['modal_error'] = "There is some problem in connection: " . $e->getMessage();
        $_SESSION['modal_show'] = "loginModal";
        header("Location: ../index.php?url=home");
        exit();
    }
}

else if(isset($_POST['edt-btn'])){
    $currentUser = $_SESSION['name'];

    $edit_query = "SELECT * FROM users WHERE name = '$currentUser' ";
    $edit_query_run = mysqli_query($con, $edit_query);

    if($edit_query_run){
        if(mysqli_num_rows($edit_query_run) > 0){
            while($row = mysqli_fetch_array($edit_query_run)){
            }
        }
    }
}

?>