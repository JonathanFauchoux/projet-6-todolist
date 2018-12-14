<?php
error_reporting(E_ERROR | E_PARSE);
$tache = " ";
$tacheErr= " ";
$fini = " ";
$options = array(
    'tache' => FILTER_SANITIZE_STRING,);

   $result = filter_input_array(INPUT_POST, $options);

if (empty($_POST["tache"])) {
    $tacheErr = "Votre tâche est requise";
  } else {
        $url = 'todo.json'; // path to your JSON file
        $data = file_get_contents($url); // put the contents of the file into a variable // decode the JSON feed
        $arrayJson = json_decode($data, true);
 
  
        $Datatodo = array('tache' => $result['tache'], 'archived' => false);
        array_push($arrayJson, $Datatodo);

        $fini = json_encode($arrayJson, JSON_FORCE_OBJECT );
        file_put_contents($url, $fini);
    }


//*
if (!empty($_POST["check"])){
    $keys = $_POST["check"];
    //changer la valeure archive true.
    // $values = array_values($keys); //id
    $url = 'todo.json'; // path to your JSON file
    $data = file_get_contents($url); // put the contents of the file into a variable // decode the JSON feed
    $arrayJson = json_decode($data, true);
    
    
    $arrayJson[$keys]["archived"] = true;
    $encode = json_encode($arrayJson, JSON_FORCE_OBJECT);
    file_put_contents($url, $encode);
}   



//*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>TodoListe</title>
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
</head>
<body>
<div class =" form_global"> 
    <img src="hackers-poulette-logo-form.PNG" alt="logo">
    <form method="post" action=" index.php" class ="container aFaire col-md-4">
        <h2 class =" titre">To Do</h2>
        <div>
            <?php 
            /*
                for($i =0; $i<count($arrayJson); $i++){
                    if($arrayJson[$values]["archived"]  == false){
                    echo '<input type = "checkbox" name = "check" value ='."$arrayJson[$i]".'>'.$arrayJson[$i]['tache']."<br/>";
                    }
                }  
            */?>

            <?php 
            //*
            foreach($arrayJson as $keys => $values){
                if($arrayJson[$keys]["archived"]  == false){
                 echo '<input type = "checkbox" name = "check" value ='."$keys".'>'." ".$arrayJson[$keys]['tache']."<br/>";
                }
            } 
            //*/
             ?>
            <button type="submit" class="btn btn-primary btn_archive">Archiver</button>
        </div>
    </form>
    <section class ="container col-md-4 archived">
        <h2 class =" titre">Archived</h2>
        <div>
            <?php 
                /*
                for($i =0; $i<count($arrayJson); $i++){
                    if($arrayJson[$values]["archived"]  == true){
                    echo '<input type = "checkbox" name = "check" value ='."$arrayJson[$i]".'>'.$arrayJson[$i]['tache']."<br/>";
                    } 
                }
                */
            ?>

            <?php 
            // /*
                foreach($arrayJson as $keys => $values){
                    if($arrayJson[$keys]["archived"]  == true){
                        echo '<input type="checkbox" name="check" value="'.$keys.'" checked> <del>'.$arrayJson[$keys]['tache']."</del>"."<br/>";
                    }
                }
            //*/
            ?>
        </div>
    </section>
    <form method="post" action="index.php" class = "container col-md-12 addTache" >
            <h2 class =" titre">Ajouter une tâche</h2>  
        <div class="form-group col-md-4">
            <label for="inputtextaraea">Nouvelle tâche à éffectuer</label>
            <span class="error">* <?php echo $tacheErr;?></span>
            <textarea name = "tache" class="form-control textarea"  id="tache" placeholder="Votre nouvelle tâche ici."></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn_addTache">Ajouter</button>
    </form>  
</div>  
</body>
</html>