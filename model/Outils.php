<?php 


class Outils
{
    static function checkImage(){
        if (isset($_FILES['avatar']) && $_FILES['avatar']['size']  > 0) {
          
            $nameFile = $_FILES['avatar']['name'];
            $typeFile = $_FILES['avatar']['type'];
            $sizeFile = $_FILES['avatar']['size'];
            $tmpFile = $_FILES['avatar']['tmp_name'];
            $errFile = $_FILES['avatar']['error'];
          
            $extensions = ['png', 'jpg', 'jpeg', 'gif'];   // Extensions - valide les extensions utilisés 
       
            $type = ['img/png', 'img/jpg', 'img/jpeg', 'img/gif'];  // Type d'image - comparer des valeures pour savoir qi limage est deja presente dans le dossiers ou non 
          
            $extension = explode('.', $nameFile);   // On récupère l'extension
           
            $max_size = 200000;  // Max size - on limite la taille de limage
    
           
                // On vérifie que il n'y a que deux extensions
                if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                   
                    // On vérifie le poids de l'image
                    if ($sizeFile < $max_size) {
    
                        // On bouge l'image uploadé dans le dossier upload
                        if (move_uploaded_file($tmpFile, 'public/img/' .$nameFile)) {
                            // 
                            echo "This is uploaded!";
                            return 'public/img/' .$nameFile;
    
                        }
                        else {
                            return $errorMsg = "failed";
                  
                        }
                    } else {
    
                        return $errorMsg =  "Fichier trop lourd ou format incorrect";
                  
                    }
                } else {
                    return $errorMsg =  "Extension failed";
               
                }
    
        } else {
            return false;
        }
    }
}