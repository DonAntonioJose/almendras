 <?php
    
    // Con esta línea mostramos los posibles errores:
    ini_set("display_errors", "on");

    // ----------------------------------------------

    function connect_PostgreSQL( $host, $bd, $user, $password )
    {
        $connection = pg_connect( "host=".$host." "."dbname=".$bd." "."user=".$user." "."password=".$password) or die( "Error in the conection: ".pg_last_error() );

        return $connection;
    }

    // ----------------------------------------------

    function insert( $connection, $id, $name, $email, $comments )
    {

        $sql = "INSERT INTO contacts VALUES (".$id.", '".$name."', '".$email."', '".$comments."')";

        // Ejecutamos la consulta (se devolverá true o false):
        return pg_query( $connection, $sql );
    }

 <html> 
    <body> 
        $db = connect_PostgreSQL('host=localhost dbname=contacts user=jcepas password=13579'); 
     

        $id = pg_escape_string($_POST['id']);   
        $name = pg_escape_string($_POST['name']); 
        $email = pg_escape_string($_POST['email']); 
        $comments = pg_escape_string($_POST['comments']);   

        $ok = insert( $connection, $id, $name, $email, $comments );

        if( $ok == false )
            echo "Something not work, please try again. <br/>";
        else
            echo "The comments was store..<br/>";
        
        pg_close(); 

    </body> 
</html> 

?>