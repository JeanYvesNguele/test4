<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
   
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="pull-left">Liste de Matériel</h2>
                        <a href="createMat.php" class="btn btn-success"><i class="bi bi-plus"></i> Nouveau Matériel</a>
                    </div>
                    <?php 
/* Inclure le fichier config */
require_once "config.php";
                    
                    /* Afficher la liste complète du matériel */
                    $sql = "SELECT * FROM materiel";
                    
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Id_Matériel</th>";
                                        echo "<th>Nom</th>";
                                        echo "<th>Type</th>";
                                        echo "<th>Numéro de Série</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_mat'] . "</td>";
                                        echo "<td>" . $row['nom'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . $row['noserie'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="readMat.php?id_mat='. $row['id_mat'] .'" class="me-3" ><span class="bi bi-eye"></span></a>';
                                            echo '<a href="updateMat.php?id_mat='. $row['id_mat'] .'" class="me-3" ><span class="bi bi-pencil"></span></a>';
                                            echo '<a href="delMat.php?id_mat='. $row['id_mat'] .'" ><span class="bi bi-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            /* Free result set */
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
                        }
                    } else{
                        echo "Oops! Une erreur est survenue";
                    }
 
                    /* Fermer connection */
                    mysqli_close($link);
                    ?>
					<p><a href="admin.php" class="btn btn-primary">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>