<?php


    $error = array( );
    
    ob_start();



    if (empty($_GET["title"])) {


       $error['title'] = false; 

      
    }else{

      $error['title'] = true;


    }

    if (filter_var(($_GET["date"]), FILTER_VALIDATE_EMAIL)) {

      $error['date'] = true;

      
    }else{

      $error['date'] = false;


    }


    if (empty($_GET["contenu"])) {


      $error['contenu'] = false;


      
    }else{

      $error['contenu'] = true;
        

    }

if (empty($_GET["auteur"])) {


      $error['auteur'] = false;


      
    }else{

      $error['auteur'] = true;
        

    }

    if ($error['name'] == true && $error['email'] == true && $error['message'] == true){

        $servername = "localhost";
        $username = "pelodie";
        $password = "pelodie@2017";
        $dbname = "pelodie";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO contact (title, date, contenu, auteur) 
            VALUES (:title, :date, :contenu, :auteur)");
            $stmt->bindParam(':title', $name);
            $stmt->bindParam(':date', $email);
            $stmt->bindParam(':contenu', $message);
            $stmt->bindParam(':auteur', $category);

            // insert a row
            $name = $_GET["title"];
            $email = $_GET["date"];
            $message = $_GET["contenu"];
            $message = $_GET["auteur"];
            
            $stmt->execute();

             $error['bdd'] =  "New records created successfully";
            }
        catch(PDOException $e)
            {
            $error['bdd'] = "Error: " . $e->getMessage();
            }
        $conn = null; 

//        


    ob_clean();

    echo json_encode($error);
  

?>