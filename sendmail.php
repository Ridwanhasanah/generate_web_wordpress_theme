<?php 
/*
* Template Name: sendemailtest
*/
get_header();
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="#" method="post">
           <label>Masukan Email</label>
           <input type="text" name="email"><br>
           <input type="submit" name="submit">
       </form>

<?php
if (isset($_POST['submit']))  {
    global $wpdb;

    $random = substr( md5(rand()), 0, 10);
    
    $to=$_POST['email'];
    $token=$random;

    global $wpdb;
    $table = $wpdb->prefix."email";

    $wpdb->query("INSERT INTO $table (email,token) VALUES ('$to','$token');");

    $to =  $_POST['email'];
    $subject = "Selamat datang di Qilata";
    $body = "

    Untuk Registrasi web gratis kami telah memberi link ini. Silakan menuju alamat berikut:

    http://localhost/https:/demo1/registration?email=".$to."&token=".$token."

    Salam sukses, Qilata Team.";

    $headers = 'Billing@qilata.com <qilata@gmail.com>';

    wp_mail($to, $subject, $body, $headers);

    ?>
    <h1>
    <strong>Silakan periksa email anda, kami telah mengirim link registrasi di email anda.</strong>
    </h1>
     </div>
</div><?php

}


/*Create Database*/


 ?>


 