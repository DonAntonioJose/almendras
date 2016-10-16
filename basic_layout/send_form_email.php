
<?php
if(isset($_POST['email'])) {
 
    // Edita las dos líneas siguientes con tu dirección de correo y asunto personalizados

 
    $email_to = "afgfrias@gmail.com";
 
    $email_subject = "Email generado via pagina web usuario: ".$_POST['email']."\n";   
	
 
    function died($error) {
 
        // si hay algún error, el formulario puede desplegar su mensaje de aviso
 
        echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. ";
 
        echo "Detalle de los errores.<br /><br />";
        
        echo $error."<br /><br />";
 
        echo "Porfavor corrija estos errores e inténtelo de nuevo.<br /><br />";
        die();
    }
 
    // Se valida que los campos del formulairo estén llenos
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telephone']) ||
 
        !isset($_POST['message'])) {
 
        died('Lo sentimos pero parece haber un problema con los datos enviados.');       
 
    }
 //En esta parte el valor "name" nos sirve para crear las variables que recolectaran la información de cada campo
    
    $first_name = $_POST['first_name']; // requerido
 
    $last_name = $_POST['last_name']; // requerido
 
    $email_from = $_POST['email']; // requerido
 
    $telephone = $_POST['telephone']; // no requerido 

    $message = $_POST['message']; // requerido
 
    $error_message = "";

//En esta parte se verifica que la dirección de correo sea válida 
    
   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'La dirección de correo proporcionada no es válida.<br />';
 
  }

//En esta parte se validan las cadenas de texto

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'El formato del nombre no es válido<br />';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'el formato del apellido no es válido.<br />';
 
  }
 
  if(strlen($message) < 2) {
 
    $error_message .= 'El formato del texto no es válido.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
//A partir de aqui se contruye el cuerpo del mensaje tal y como llegará al correo

    $email_message = "<br><br>";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."<br>";
 
    $email_message .= "Apellido: ".clean_string($last_name)."<br>";
 
    $email_message .= "Email: ".clean_string($email_from)."<br>";
 
    $email_message .= "Telefono: ".clean_string($telephone)."<br>";
 
    $email_message .= "".clean_string($message)."<br>";
  
 
//Se crean los encabezados del correo
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
mail("$email_to","$email_subject","$email_message","From: $headers \nMime-Version: 1.0\nContent-Type: text/html; charset=ISO-8859-1\nContent-Transfer-Encoding: 7bit");
//@mail($email_to, $email_subject, $email_message, $headers);  
 

/* // Javi Cepas 16/10/16 12:56
// Creamos las funciones de conexión con PostgreSQL
    function connect_PostgreSQL( $host, $bd, $user, $password )
    {
        $connection = pg_connect( "host=".$host." "."dbname=".$bd." "."user=".$user." "."password=".$password) or die( "Error in the conection: ".pg_last_error() );

        return $connection;
    }

    // ----------------------------------------------

    function insert( $connection, $first_name, $last_name, $email_from, $telephone, $message )
    {



        $sql = "INSERT INTO contacts VALUES (".$first_name.", '".$last_name."', '".$email_from."', '".$telephone.",'".$message."')";

        // Ejecutamos la consulta (se devolverá true o false):
        return pg_query( $connection, $sql );
    }



    $db = connect_PostgreSQL('host=localhost dbname=contacts user=jcepas password=13579'); 

//  Interpreto que no habría que volver a definirlo, puesto que ya estarían definidas anteriormente,
//  no se si sería necesario que se pusiera delante PG_ESCAPE_STRING

    $first_name = pg_escape_string($_POST['first_name']); // requerido
    $last_name = pg_escape_string($_POST['last_name']); // requerido
    $email_from = pg_escape_string($_POST['email']); // requerido
    $telephone = pg_escape_string($_POST['telephone']); // no requerido 
    $message = pg_escape_string($_POST['message']); // requerido


    $ok = insert( $connection, $first_name, $last_name, $email_from, $telephone, $message );

        if( $ok == false )
            echo "Something not work, please try again. <br/>";
        else
            echo "The comments was store..<br/>";
        
        pg_close(); 

 Estoy probando que se lanza la conexión y se guarda el mensaje, ahora mismo no está funcionando. (16/10/16) */
//
    
    
?>
 
 
 
<!-- incluye aqui tu propio mensaje de Éxito-->
 
Gracias! Nos pondremos en contacto contigo con la mayor brevedad posible.
 
 
<?php
 
}
 
?>