<html lang = "en">
   
   <head>
      <title>Tutorialspoint.com</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         
         .form-signin {
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
     
      
   </head>
	
   <body dir='rtl'>

<?php
class DB
{
    
   private $host = 'db4free.net';
   private $MySqlUsername = 'smartcity4u';
   private $MySqlPassword = '23243125';
   private $DBname        = 'smartcity4u';

    public $conn;



    function prepare()
    {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->DBname;charset=utf8", $this->MySqlUsername, $this->MySqlPassword, []);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();
            $this->conn = $conn;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function done()
    {
        // $this->conn->commit();
        $this->conn = null;
    }

}

class SortAttende extends DB{


    function __construct(){
        $this->prepare();
    }
    public function GetQuery(){
        $dlb = $this->conn->prepare("SELECT * FROM users");
        $dlb->execute();
        if($dlb->rowCount() > 0){
            $data     = $dlb->fetchAll();

            return $data;
        }else{
            return FALSE;
        }
    }
    function __destruct(){
        $this->done();
    }

}

class mailer
{
    private $host = "smtp.gmail.com";
    private $smtpAut = true;
    private $EmailAddress = "mohamed007258@gmail.com";
    private $EmailPassword = "zddtgyqrecuuubru";
    private $smtpProto = "tls";
    private $mailPort = 587;
    private $mail;
    private $body;
    private $footer = "\n \n\ \n \nنشكرك للتعاون معنا";
    public function load()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = $this->host;
        $this->mail->SMTPAuth = $this->smtpAut;
        $this->mail->Username = $this->EmailAddress;
        $this->mail->Password = $this->EmailPassword;
        $this->mail->SMTPSecure = $this->smtpProto;
        $this->mail->Port = $this->mailPort;
    }
    public function sendMail($body, $email, $name, $title)
    {
        try {
            $this->mail->From = $this->EmailAddress;
            $this->mail->FromName = "التحول الرقمى واداره المدن الذكيه";
            $this->mail->addAddress($email,  $name);
            $this->mail->WordWrap = 50;
            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';
            $this->mail->Subject = $title;
            $this->mail->Body = $body;
            $this->mail->AltBody = $this->footer;
            $this->mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
}

function CreateRow($row){

   echo "<tr>";
   echo '<td>' . $row['id'] . '</td>';
   echo '<td>' . $row['u_name'] . '</td>';
   echo '<td>' . $row['gender'] . '</td>';
   echo '<td>' . $row['email'] . '</td>';
   echo '<td>' . $row['phone'] . '</td>';
   echo '<td>' . $row['targeted'] . '</td>';
   echo '<td>' . $row['types'] . '</td>';
   echo '<td>' . $row['org'] . '</td>';
   echo '<td>' . $row['note'] . '</td>';

   echo "</tr>";

}

function doSomething(){
   $myObject = new SortAttende;
   $result = $myObject->GetQuery();

   echo "<div class='table-responsive' ><table class='table' border='1'>
            <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>الجنس</th>
            <th>البريد الالكترونى</th>
            <th>رقم الهاتف</th>
            <th>جهه القدوم</th>
            <th>المؤسسه التابع لها</th>
            <th>نوع المشاركه</th>
            <th>تعليقات</th>

            </tr>";

   if (isset($result['u_name'])){
      $row = $result;
      echo "<tr>";
      echo '<td>' . $row['id'] . '</td>';
      echo '<td>' . $row['u_name'] . '</td>';
      echo '<td>' . $row['gender'] . '</td>';
      echo '<td>' . $row['email'] . '</td>';
      echo '<td>' . $row['phone'] . '</td>';
      echo '<td>' . $row['targeted'] . '</td>';
      echo '<td>' . $row['types'] . '</td>';
      echo '<td>' . $row['org'] . '</td>';
      echo '<td>' . $row['note'] . '</td>';
      echo "</tr>";

   }else{

     foreach ($result as $row ){
      echo "<tr>";
      CreateRow($row);
      echo "</tr>";
   }
   }
   
   
   echo "</table></div>";
}


?>
<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

      <h2>بيانات  الحاضريين للمؤتمر </h2> 
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['username'] == 'admin' && 
                  $_POST['password'] == 'admin') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'tutorialspoint';
                  ?>
                    <style type="text/css">#body{
                    display:none;
                    }</style>
                  <?php
                  doSomething();
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div id="body">

      <div class = "container">

         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>         
      </div> 
      </div>
   </body>
</html>