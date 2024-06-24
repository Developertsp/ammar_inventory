<?php 
try {
    $db = mysqli_connect('localhost', 'techsolutionspro_3','*P+!o*g_EOs~', 'techsolutionspro_3');
    
    if ($db) {
        // echo("Database connection Created: ");
    }
    

    
} catch (Exception $e) {
    // Handle the exception
    // echo "Error: " . $e->getMessage();
}

?>