<?php
 
require_once 'SetMessages.php';
  
class OutilConvert{
  
  protected $set_messages = null;
    
  public function __construct(){
    $this->set_messages = new SetMessages();
  }
 
 /**************************************************
  **
  ** 	[ FONCTION convert_dir ]
  **
  ** 	Par Jérémy Dombier - Utilisation libre
  **
  ** 	Copie un dossier vers un autre 
  **		
  **	http://www.comscripts.com/sources/php.copier-un-dossier-recursif.294.html
  **
  ** 	DoyDoy : Rajout d'un paramètre d'exception ($sauf) 
  **************************************************/
  /**
   * Conversion d'un répertoire
   * @param string $methode	'utf8_encode' ou 'utf8_decode'
   * @param string $dir_init
   * @param string $dir_cible
   * @param array|null $sauf
   */
  public function convert_dir($methode, $dir_init, $dir_cible, array $sauf = null) {
   /* 
    echo '-----------------------------' . "\n";
    echo '$methode : ' . $methode . "\n";
    echo '$dir_init : ' . $dir_init . "\n";
    echo '$dir_cible : ' . $dir_cible . "\n";
    */
    $dir_init = $dir_init . '/';
    $dir_cible = $dir_cible . '/';
    $dir_init = str_replace('//', '/', $dir_init);
    $dir_cible = str_replace('//', '/', $dir_cible);

    // On vérifie si $dir_init est un dossier
    if (is_dir($dir_init)) {
      
      // Si oui, on l'ouvre
      if ($dh = opendir($dir_init)) {     
        
        // On liste les dossiers et fichiers de $dir_init
        while (($file = readdir($dh)) !== false) {
          
          // Si le dossier dans lequel on veut coller n'existe pas, on le crée
          if (!is_dir($dir_cible)) mkdir ($dir_cible, 0777);
        
          if (!is_null($sauf)){
            if (in_array($file, $sauf)) {
              continue;
            }
          }
          
          // S'il s'agit d'un dossier, on relance la fonction récursive
          if(is_dir($dir_init.$file) && $file != '..'  && $file != '.') 
            $this->convert_dir($methode, $dir_init.$file.'/', $dir_cible.$file.'/', $sauf);     
          // S'il sagit d'un fichier, on le copie simplement
          elseif($file != '..'  && $file != '.'){ 
              
            $contenu = file_get_contents($dir_init.$file);
            if ($contenu)
              { $contenu_new = $contenu;
                $contenu_new = $methode($contenu);
                $conversion = file_put_contents($dir_cible.$file, $contenu_new);
                if (!$conversion){
                  $this->set_messages->messageError('La conversion du fichier ' . $dir_init . $file . ' a échoué...');
                  exit;
                }
                //else echo 'Conversion effectuée pour le fichier ' . $dir_init . $file ."\n";
            }
            else {
                echo 'Conversion non effectuée pour le fichier ' . $dir_init . $file . "\n";
                
                if (!copy($dir_init.$file, $dir_cible.$file )){
                    $this->set_messages->messageError("La copie du fichier " . $dir2copy . $fil . " a échoué...");
                    exit;
                }
            }
          }
        }
        
        // On ferme $dir_init
        closedir($dh);
      }
    }
    //echo '-----------------------------' . "\n";
    return;       
  }
  
}
