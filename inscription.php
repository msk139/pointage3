<?php 
    session_start();
    $error="";
    $error_email="";
    $error_poste="";
    $error_prenom="";
    $error_agence="";
    $error_mdp="";
    $error_nom="";
    $error_mdpconf="";
    $verifier="";
    if(isset($_POST['submit'])){
        $nom=$_POST["nom"];
        $prenom=$_POST["prenom"];
        $email=$_POST["email"];
        $poste=$_POST["poste"];
        $agence=$_POST["agence"];
        $mdp=$_POST["mdp"];
        $mdpconf=$_POST["mdpconf"];
        if(isset($_POST['numtel']) and !empty($_POST['numtel'])){
            $num_tel=$_POST['numtel'];
        }else{
            $num_tel="NULL";
        }
        

        // email
        if(empty($email)){
            $error_email="Vous devez renseigner votre email !";
        }

        //Nom
        if(empty($nom)){
            $error_nom="Vous devez renseigner votre nom !";
        }

        //Prénom
        if(empty($prenom)){
            $error_prenom="Vous devez renseigner votre prénom !";
        }

        //poste
        if(empty($poste)){
            $error_poste="Vous devez renseigner votre poste";
        }

        //agence
        if(empty($agence)){
            $error_agence="Vous devez renseigner votre agence";
        }

        //mot de passe
        if($mdp!=$mdpconf){
            $error_mdp="Les deux mots de passe ne sont pas conformes";
        }

        if(empty($mdp)){
            $error_mdp="Vous devez créer un mot de passe";
        }
        if(empty($mdpconf)){
            $error_mdpconf="Vous devez confirmer votre mot de passe";
        }
        

        if(!empty($prenom) and !empty($poste) and !empty($nom) and !empty($agence) and !empty($email) and !empty($mdp) and !empty($mdpconf)){
            include 'database.php';
            $ver="SELECT email FROM Users WHERE email='".$email."'";
            $ver=$db->query(($ver));
            $ver=$ver->fetch(PDO::FETCH_OBJ);
            if($ver){
                if($ver->email==$email){
                    $error="Ce compte existe déjà";
                    $error_email="";
                    $error_poste="";
                    $error_prenom="";
                    $error_agence="";
                    $error_mdp="";
                    $error_nom="";
                    $error_mdpconf="";
                }
            }else{
                $sql="INSERT INTO Users(email,nom,prenom,poste,agence,mot_de_passe,) VALUES('".$email."','".$nom."','".$prenom."','".$agence."',".$poste."','".password_hash($mdp,PASSWORD_BCRYPT)."')";
                $s=$db->query($sql);
                $verifier=1;
            }
        }

    }
?>    
<!doctype html>
<html class="no-js" lang="fr"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inscription | Pointage</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <h1 style="font-size: 50px; color: white; text-transform: uppercase;">POINTAGE</h1>
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" class="form-control" placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <label>Prénom(s)</label>
                            <input type="text" class="form-control" placeholder="Prénom(s)">
                        </div>
                        <div class="form-group">
                            <label>Adresse email</label>
                            <input type="email" class="form-control" placeholder="Adresse email">
                        </div>
                         <div class="form-group">
                            <label>Poste</label>
                            <input type="text" class="form-control" placeholder="Poste">
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" placeholder="Mot de passe">
                        </div>
                        <div class="form-group">
                            <label>Confirmez votre mot de passe</label>
                            <input type="password" class="form-control" placeholder="Confirmez votre mot de passe">
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
