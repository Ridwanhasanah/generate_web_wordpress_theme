<?php 
/*
* Template Name: sendemailtest
*/
get_header();
?>
<form action="#" method="post">
	<label>Masukan Email</label>
	<input type="text" name="email">
	<input type="submit" name="submit">
</form>
<?php
if (isset($_POST['submit']))  {
   global $wpdb;

    $random = substr( md5(rand()), 0, 10);
    
    $to=$_POST['email'];
    $token=$random;
    $to = htmlentities($to);
    $token = htmlentities($token);

            global $wpdb;
            $table = $wpdb->prefix."email";
            $wpdb->query("INSERT INTO $table (email,token) VALUES ('$to','$token');");

    $to =  $_POST['email'];
    $subject = "Selamat datang di Qilata";
    $body = "

    Untuk konfirmasi pembayan kami telah memberi link ini. Silakan menuju alamat berikut:

    http://localhost/https:/demo1/registration?for=".$to."&key=".$token."

    Salam sukses, Qilata Team.";

    $headers = 'Billing@qilata.com <qilata@gmail.com>';

    wp_mail($to, $subject, $body, $headers);

}


 ?>


 