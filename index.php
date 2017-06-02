<?php
// afficher la date de manière plus littérale
function dt($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'année',
        'm' => 'mois',
        'w' => 'semaine',
        'd' => 'jour',
        'h' => 'heure',
        'i' => 'minute',
        's' => 'seconde',
    );
    
    foreach ($string as $k => &$v) {
        
            if ($diff->$k) {
                if($k=="m"){
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
                }else{
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                }
            } else {
                unset($string[$k]);
            }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? "il y a ".implode(', ', $string) : 'just now';
}            


// connection base de données

$servername = "localhost";
$username = "pelodie";
$password = "pelodie@2017";

try {
    $conn = new PDO("mysql:host=$servername;dbname=pelodie", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->query("SELECT * FROM billet ORDER BY id DESC LIMIT 9");   
    }

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>


<!DOCTYPE html>
<html lang="fr_FR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog de jardinage et déco.">
    <meta name="author" content="">

    <title>Garden Party</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

     <!-- Theme CSS -->
    <link href="css/clean-blog.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet"  >

</head>


<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">Garden Party</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- HEADER -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.png')">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Garden Party</h1>
                        <hr class="small">
                        <span class="subheading">Plante &amp; Lifestyle</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
       
               
    <!-- GALLERIE IMAGE GÉNÉRER PAR LE FORMULAIRE DE POST    -->
    
                              
     <div class="container-fluid">
            <div class="row">
                <div class=" col-md-10 col-md-offset-1">
                    
                    
                                                                                         
    <?php   
                
        while($article = $stmt->fetch()) {
        
        $adr_img = $article['image'];
            
       
        echo "<a  href='post.php?id=".$article['id']."'>";
        echo "<img class='image-post-accueil col-lg-4 col-xs-12 ' src='".$adr_img."'>";
        echo "<div class='hover-image-accueil'>";
        echo "</div></img></a>";
        

        }       
    ?>  
     
                    
                    
                </div>
            </div>
        </div> 
      
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Précédent&rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                  
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
