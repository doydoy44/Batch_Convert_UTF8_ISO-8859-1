<?php

class GetChoix{
  
  /**
   * @def UTF8_ISO		Conversion UTF8 en ISO-8859-1
   * 
   * @var const  
   */
  const UTF8_ISO = 10;
  /**
   * @def ISO_UTF8		Conversion ISO-8859-1 en UTF8 
   * 
   * @var const  
   */
  const ISO_UTF8 = 11;
  
  /**
  * @def LIB_UTF8_ISO		Libellé du bouton "Conversion UTF8 en ISO-8859-1"
  *
  * @var const
  */
  const LIB_UTF8_ISO = "Conversion UTF8 en ISO-8859-1";
  /**
  * @def LIB_ISO_UTF8		Libellé du bouton "Conversion ISO-8859-1 en UTF8"
  *
  * @var const
  */
  const LIB_ISO_UTF8 = "Conversion ISO-8859-1 en UTF8";
  
  /**
   * Récupération du du sens de la conversion
   */
  public function getSens(){
  
    // http://gtk.php.net/manual/en/gtk.gtkmessagedialog.constructor.php    
    $dialog = new GtkMessageDialog( null,//parent
                                    0,
                                    Gtk::MESSAGE_QUESTION,
                                    Gtk::BUTTONS_NONE,
                                    'Sens de la Conversion?'
                                );
    $dialog->add_button(self::LIB_UTF8_ISO, self::UTF8_ISO);
    $dialog->add_button(self::LIB_ISO_UTF8, self::ISO_UTF8);   
    $dialog->add_button(Gtk::STOCK_CANCEL, Gtk::BUTTONS_CANCEL);  
    $dialog->set_markup('Sens de la conversion?');
    
    $answerClient = $dialog->run();
    $dialog->destroy();
    return $answerClient;
  }
  
  
  /**
   * Récupération du chemin où se situe le dossier à convertir
   */
  public function getRepInitial(){
    $reponse = null;
    // Récupération du chemin du répertoire
    $dialog = new GtkFileChooserDialog("Où se trouve le répertoire à convertir?", 
                                        null, 
                                        Gtk::FILE_CHOOSER_ACTION_SELECT_FOLDER, 
                                        array(Gtk::STOCK_OK, Gtk::RESPONSE_OK, Gtk::STOCK_CANCEL, Gtk::RESPONSE_CANCEL), 
                                        null);
    //$dialog->set_filename("c:/tmp");                                        
    
    if ($dialog->run() == Gtk::RESPONSE_OK) {
        //var_dump($dialog);
        $reponse = $dialog->get_filename();
        chdir($reponse);
    }
    else exit;
    $dialog->destroy();
    return $reponse;
  }   

  /**
   * Indique où se va se trouver le réprtoire cible (converti)  
   */
  public function getRepCible(){
    $reponse = null;
    $dialog = new GtkFileChooserDialog("Où se trouve le répertoire cible?", 
                                        null, 
                                        Gtk::FILE_CHOOSER_ACTION_SELECT_FOLDER, 
                                        array(Gtk::STOCK_OK, Gtk::RESPONSE_OK, Gtk::STOCK_CANCEL, Gtk::RESPONSE_CANCEL), 
                                        null);
    
    if ($dialog->run() == Gtk::RESPONSE_OK) {
        //var_dump($dialog);
        $reponse = $dialog->get_filename();
        chdir($reponse);
    }
    else exit;
    $dialog->destroy();
    return $reponse;
  }
}