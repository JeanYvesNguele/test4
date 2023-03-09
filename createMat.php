<?php
// Inclure le fichier config
require_once "config.php";
 
// Definir les variables
$nom = $type = $noserie = "";
$name_err = $type_err = $noserie_err = "";
 
// Traitement
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validation du nom
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veillez entrez un nom valide!.";
    } else{
        $nom = $input_name;
    }
    
    // Validation du type
    $input_type = trim($_POST["type"]);
    if(empty($input_type)){
        $type_err = "Veillez entrez le type du matériel!.";     
    } else{
        $type = $input_type;
    }
	
	// Validation du Numéro de Série
    $input_noserie = trim($_POST["noserie"]);
    if(empty($input_noserie)){
        $noserie_err = "Veillez entrez un numéro de série valide!.";     
    } else{
        $noserie = $input_noserie;
    }
    
    
    // verifiez les erreurs avant enregistrement
    if(empty($name_err) && empty($type_err) && empty($noserie_err) ){
        // Requête préparée
        $sql = "INSERT INTO materiel (nom, type, noserie) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind les variables à la requette preparée
            mysqli_stmt_bind_param($stmt, "ssd", $param_nom, $param_type, $param_noserie);
            
            // définir paramètres
            $param_nom = $nom;
            $param_type = $type;
            $param_noserie = $noserie;
            
            // executer la requette
            if(mysqli_stmt_execute($stmt)){
                // opération effectuée, retour
                header("location: materiel.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Créer un enregistrement</h2>
                    <p>Remplir le formulaire pour enregistrer le nouveau matériel dans la base de données</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $type; ?>">
                            <span class="invalid-feedback"><?php echo $type_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Numéro de Série</label>
                            <input type="text" name="noserie" class="form-control <?php echo (!empty($noserie_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $noserie; ?>">
                            <span class="invalid-feedback"><?php echo $noserie_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="materiel.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>