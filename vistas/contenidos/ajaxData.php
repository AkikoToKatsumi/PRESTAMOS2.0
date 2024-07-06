
<?php
//Include database configuration file
include('dbConfig.php');

if(isset($_POST["id_ciudad"]) && !empty($_POST["id_ciudad"])){
    //Get all state data
    $query = $db->query("SELECT * FROM sector WHERE id_ciudad = ".$_POST['id_ciudad']." ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Seleccione un sector</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['id_sector'].'">'.$row['nombre_sector'].'</option>';
        }
    }else{
        echo '<option value="">Sector no disponible</option>';
    }
}

if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"])){
    //Get all city data
    $query = $db->query("SELECT * FROM calle WHERE id_sector = ".$_POST['id_sector']."");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Seleccione una calle</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['id_calle'].'">'.$row['nombre_calle'].'</option>';
        }
    }else{
        echo '<option value="">Calle no disponible</option>';
    }
}
?>