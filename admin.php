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
       
    </style>
   
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="pull-left">Que voulez-vous effectuer comme action?</h2>  
                    </div>
						<a href="materiel.php" class="btn btn-success"> Gérer Matériel</a> 
						<a href="logiciel.php" class="btn btn-danger"> Gérer Logiciel</a>
						<a href="etudiant.php" class="btn btn-info"> Gérer Etudiant</a>
						<a href="user.php" class="btn btn-warning"> Gérer Compte Utilisateur</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
