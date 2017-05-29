<?php

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


$servername = "localhost";
$username = "pelodie";
$password = "pelodie@2017";

try {
    $conn = new PDO("mysql:host=$servername;dbname=pelodie", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM billet ORDER BY id DESC"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll();

    
    
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
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exo-Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet"  >
  

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
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
                    <li>
                        <a href="post.html">Post</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.png')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
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
    
    
             
    
    
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
               
               
               
    <?php   
                
        foreach($result as $article){
            
        echo  "<div class='post-preview'><a href='post.html'><h2 class='post-title'>";
        echo $article['title'];
        echo "</h2> </a>";
            
        echo  "<div class='post-preview'><a href='post.html'><h3 class='post-subtitle'>";
        echo $article['contenu'];
        echo "</h3></a> ";
            
        echo  "<div class='post-preview'><a href='post.html'><p class='post-meta'> Posted by ";
        echo $article['auteur'];
        echo "</p></a> ";
            
        echo  "<div class='post-preview'><a href='post.html'><p class='post-meta'>";
        echo  dt($article['date']);
        echo "</p></a> ";

    }       
  
    ?>  
                <hr>

               
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Précédents &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <hr>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
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
