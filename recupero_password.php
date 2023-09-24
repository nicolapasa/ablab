<?php
include('./autoloader.php');//autoloader


//* ricevo i dati dal form *//
//* dati login *//
$email   = $_POST['e-mail'];


$aut =new Auth();



if ($row=$aut->check_email($email))

{
	foreach ($row as $r) {

        $nome=$r['nome'];
				$username=$r['username'];
				$password=$r['password'];

				$email=explode(';', $r['email']);

	}

	$oggetto ="Recupero credenziali accesso ad Ablab";


	include('head_template.php');
		$body=$p;

		include('email_rec_pass_tmpl.php');
		$body.=$e;


		$body.='
	</body>
	</html>';

	foreach($email as $e){


//Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $body);
Utility::inviaMail(trim($e), $oggetto, $body);
}


Header("Location:  ./lost_password.php?mail=ok");
}
else
{
Header("Location:  ./lost_password.php?err=si");
}
