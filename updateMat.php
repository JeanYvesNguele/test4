<?php
/* Inclure le fichier */
require_once "config.php";
 
/* Definir les variables */
$nom = $type = $noserie = "";
$name_err = $type_err = $noserie_err = "";
 
/* verifier la valeur id dans le post pour la mise à jour */
if(isset($_POST["id_mat"]) && !empty($_POST["id_mat"])){
    /* recuperation du champ caché */
    $id = $_POST["id_mat"];
    
    /* Validate name */
    $input_name = trim($_POST["nom"]);
    if(empty($input_name)){
        $name_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Veillez entrer un nom valide.";
    } else{
        $nom = $input_name;
    }
    
    /* Validate type */
    $input_type = trim($_POST["type"]);
    if(empty($input_type)){
        $type_err = "Veillez le type du matériel!.";     
    } else{
        $type = $input_type;
    }
    
    /* Validate no serie */
    $input_noserie = trim($_POST["noserie"]);
    if(empty($input_noserie)){
        $noserie_err = "Ce champ ne peut rester vide!.";     
    } else{
        $noserie = $input_noserie;
    }
    
    /* verifier les erreurs avant modification */
    if(empty($name_err) && empty($type_err) && empty($noserie_err)){
        
        $sql = "UPDATE materiel SET nom=?, type=?, noserie=? WHERE id_mat=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssi", $param_nom, $param_type, $param_noserie, $param_id);
            
           
            $param_nom = $nom;
            $param_type = $type;
            $param_noserie = $noserie;
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                /* enregistremnt modifié, retourne */
                header("location: materiel.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    /* si il existe un paramettre id */
    if(isset($_GET["id_mat"]) && !empty(trim($_GET["id_mat"]))){
        
        $id =  trim($_GET["id_mat"]);
        
       
        $sql = "SELECT * FROM materiel WHERE id_mat = ?";


        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    /* recupere les champs */
                    $nom = $row["nom"];
                    $type = $row["type"];
                    $noserie = $row["noserie"];
                } else{
                    
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
        
        /* Close statement */
        mysqli_stmt_close($stmt);
        
        /* Close connection */
        mysqli_close($link);
    }  else{
        /* pas de id parametter valid, retourne erreur */
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'enregistremnt</title>
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
                    <h2 class="mt-5">Mise à jour de l'enregistremnt</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="id_mat" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="materiel.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>