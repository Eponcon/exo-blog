<?php


    $error = array( );



    if (empty($_POST["title"])) {


       $error['title'] = false; 

      
    }else{

      $error['title'] = true;


    }


    if (empty($_POST["contenu"])) {


      $error['contenu'] = false;


      
    }else{

      $error['contenu'] = true;
        

    }

if (empty($_POST["auteur"])) {


      $error['auteur'] = false;


      
    }else{

      $error['auteur'] = true;
        

    }

    if ($error['title'] == true && $error['contenu'] == true && $error['auteur'] == true){

        $servername = "localhost";
        $username = "pelodie";
        $password = "pelodie@2017";
        $dbname = "pelodie";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO billet (title, contenu, auteur) 
            VALUES (:title, :contenu, :auteur)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':auteur', $auteur);

            // insert a row
            $title = $_POST["title"];
            $contenu = $_POST["contenu"];
            $auteur = $_POST['auteur'];
            $stmt->execute();

             $error['bdd'] =  "New records created successfully";
            }
        
        catch(PDOException $e)
            {
            $error['bdd'] = "Error: " . $e->getMessage();
            }
        $conn = null; 
        
         


    echo json_encode($error);
  }
   
echo 'coucou';
?>
