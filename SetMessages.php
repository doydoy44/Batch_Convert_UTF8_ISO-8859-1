<?php 
class SetMessages{
  
  public function messageInfo($text){
    $this->_message(Gtk::MESSAGE_INFO,$text);
  }

  public function messageAlert($text){
    $this->_message(Gtk::MESSAGE_WARNING,$text);
  }
  public function messageError($text){
    $this->_message(Gtk::MESSAGE_ERROR,$text);
  }
  
  private function _message($typeMessage, $text){
    $dialog = new GtkMessageDialog( null,//parent
                                    0,
                                    $typeMessage,
                                    Gtk::BUTTONS_OK,
                                    $text
                                );
    $dialog->run();
    $dialog->destroy();
    return;
  }
}