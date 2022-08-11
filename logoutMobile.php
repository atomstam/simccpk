<?
//session_start();
//unset($_SESSION['admin_user']); // clear session
//unset($_SESSION['ua']); // clear session
session_unset();
//session_destroy();
setcookie("admin_user");
//setcookie("ua");
echo "<meta http-equiv='refresh' content='1; url=http://sims.kut.ac.th/qrcode.php'>";
?>

<!-- This Code Download from www.ThaiCreate.Com -->