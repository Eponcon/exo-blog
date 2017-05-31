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
   


    if ($error['title'] == true  && $error['contenu'] == true && $error['auteur'] == true ){
        
         
        $servername = "localhost";
        $username = "pelodie";
        $password = "pelodie@2017";
        $dbname = "pelodie";
        
        
      

   
            
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT MAX(id) as id FROM billet"); 
            $stmt->execute();
            $result = $stmt->fetch();
            $idfuturpost = $result["id"]+1;
        
            
            
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO billet (title, contenu, auteur, image) 
            VALUES (:title, :contenu, :auteur, :image)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->bindParam(':image', $image);
            
            // insert a row
           
            $title = $_POST["title"];
            $contenu = strip_tags(htmlspecialchars($_POST["contenu"]));
            $auteur = $_POST["auteur"];
            $image = "image/".$idfuturpost."-".$_FILES["image"]["name"];
            $stmt->execute();

            
                 if ($_FILES['image']['error'] == 0){
                    move_uploaded_file ( $_FILES["image"]["tmp_name"], "../image/".$idfuturpost."-".$_FILES["image"]["name"]);
                 }
            
             $error['bdd'] =  "New records created successfully";
            }
        
        catch(PDOException $e)
            {
            $error['bdd'] = "Error: " . $e->getMessage();
            }
        $conn = null; 
        
     }
        

    echo json_encode($_FILES);
    
?>
