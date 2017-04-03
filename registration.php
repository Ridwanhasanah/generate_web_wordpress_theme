<?php
/*
* Template Name: Registration
*/

//require_once(pfile . 'functions.php');
get_header(); 
?>
<div class="container">
	    	<div class="row">
	    		<div class="col-md-6 col-md-offset-3">
<?php

if (isset($_GET['token'])){ /*JIka Token salah */
	$token = $_GET['token'];
	$to = $_GET['email'];

	global $wpdb;
	$table = $wpdb->prefix."email";
    $user = $wpdb->get_results("SELECT * FROM $table WHERE token = '$token' and email = '$to';");
    if(!empty($user)){ /*Untuk chek Token, JIka TOken benar*/

    	$emails = $user[0]->email;
	    //echo '<pre>';
	    // print_r($token);
	    /*print_r($user);
	    print_r($emails);
	    echo '</pre>';*/

	    ?>
	    
	    			<div class="col-md-6 col-md-offset-3">
	    				<h3><strong> Registrasi Sekarang</strong></h3>
	    			</div><br><br>
	    			<form method="post" action="#" >
	    				<label>User Name (Required)</label>
	    				<input type="text" name="user_name" value="<?php echo tampil('user_name'); ?>"><br>
	    				<label>Store Name (Required)</label>
	    				<input type="text" name="domain" value="<?php echo tampil('domain'); ?>"><br>
	    				<label>Phone Number</label>
	    				<input type="Number" name="hp"><br>
	    				<label>Email</label><?= $emails; ?></label><br>
	    				<label>Password</label>
	    				<input type="password" name="user_pass" value="<?php echo tampil('user_pass'); ?>"><br>
	    				<label>re-Entry Password</label>
	    				<input type="password" name="user_pass2"><br>
	    				<input type="submit" name="submit"><br><br>
	    			</form>
	    			<?php 




	    			if (isset($_POST['submit'])){
					$title     = $_POST['domain'];
					$path      = '/https:/demo1/' . $title;
					//$domain = $title.'.qinota.com';
					//$path   = '';
					$user_name = $_POST['user_name'];
					$email     = $emails;//$_POST['user_email'];
					$password  = $_POST['user_pass'];
					$password2 = $_POST['user_pass2'];
					$hp 	   = $_POST['hp'];	
					

					

					/*Chek Domain*/

					if (strlen($user_name) < 4 ) {
						echo '<h4>Maaf Nama User Minimal 4 karakter</h4>';
					} elseif (strpos($user_name, ' ') ) {
						echo '<h4>Maaf Username dilarang menggunakan spasi</h4>';
					} elseif (username_exists( $user_name )){
						echo '<h4>Maaf User Sudah Terpakai</h4>';
					} elseif (strlen($title) == 0) {
						echo "<h4>Maaf Store Name belum di isi";
					} elseif (strlen($hp) == 0) {
						echo "<h4>Maaf No handphone belum di isi";
					} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo '<h4>Maaf Email tidak vallid</h4>';
					} elseif (email_exists( $email )) {
						echo '<h4>Maaf Email Sudah Terpakai</h4>';
					} elseif (domain_exists($domain, $path) ){
						echo '<h4>Maaf Domain Sudah Terpakai</h4>';
					} elseif (strlen($password) <= 5) {
						echo "<h4>Maaf Password Minimal 6 Karakter";
					} elseif ($password != $password2) {
						echo "<h4>Maaf Password Tidak Sesuai Tolong Periksa Kembali";
					}
					else{
						/*Create User*/
						wpmu_create_user($user_name, $password, $email);

						$user = get_user_by('email', $email);
						$user_id = $user->ID;

						$table = $wpdb->prefix . "datareg";

						$wpdb->query("INSERT INTO $table (nmuser,nmtoko,phone,email,pass) VALUES ('$user_name','$title','$hp','$email',$password);");



						wpmu_create_blog( $domain ,$path ,$title, $user_id, $site_id); 
						?>
						<script type="text/javascript">
							window.location ="<?= $path.'/wp-admin/'; ?>"
						</script>

						<h4>Berhasil !!</h4>
						<?php
					}
				} 




    }else{
    	?>
		<h1><strong> Your Token is not Valid ...</strong></h1>
		<?php
    	$emails = '';
    }
}else{
	?>
	<h1><strong> Your Link is not Valid ...</strong></h1>
	<?php
}
	
?>
		</div>
	</div>
</div>
<?php			
function tampil($w){

	if(!empty($_POST[$w]
		))
		$w = $_POST[$w];
	else
		$w = '';

	return $w;
}				
				
get_footer();


// echo "<pre>";
					// print_r(domain_exists($domain, $path));
					// print_r($_POST);
					// print_r($path);
					// print_r($domain);
					// echo "</pre>";
					// if(domain_exists($domain, $path)){
					// 	echo "already exist";
					// }else{
					// 	echo "continue";
					// }
					// exit();

/*Validation User*/
					/*$user = wpmu_validate_user_signup($user_name, $email);
                     echo '<pre>';
                     print_r($user);
                     echo "<pre>";
                     if (wpmu_validate_user_signup($user_name, $email) ) {
						echo $user['errors']->errors['user_email'][0];
						echo $user['errors']->errors['user_name'][0];*/


				     /*echo '<pre>';
				     print_r(username_exists( $user_name ));
				     echo "<pre>";*/
/*==============================================================*/

						/*echo "<pre>";
						print_r($user);
						print_r($user->ID);
						$user_id = $user->ID;
						echo "</pre>";*/
?>
