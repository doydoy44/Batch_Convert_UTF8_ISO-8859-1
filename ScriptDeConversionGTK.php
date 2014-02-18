<?php
/*
 * 
utf8_encode — Convertit une chaîne ISO-8859-1 en UTF-8 : http://fr2.php.net/manual/fr/function.utf8-encode.php
utf8_decode — Convertit une chaîne UTF-8 en ISO-8859-1 : http://fr2.php.net/manual/fr/function.utf8-decode.php

http://forum.phpfrance.com/vos-contributions/utf8izer-pour-convertir-utf-tous-les-fichiers-iso-dossier-t244096.html
 */

/**
 * Conversion UTF8 <-> ISO-8859-1
 *
 * @brief	Outil de conversion d'un répertoire ISO-8859-1 en UTF8 et inbversement
 *
 * @author    DoyDoy
 * @version   1.0
 *
 */
// http://www.devshed.com/c/a/PHP/Building-Your-Own-Desktop-Notepad-Application-Using-PHPGTK/2/
// cd C:\tmp\php-gtk2
// php c:\tmp\test-phpGTK.php

  require_once 'GetChoix.php';
  require_once 'SetMessages.php';
  require_once 'OutilConvert.php';


  //phpinfo();
  
  $GetChoix     = new GetChoix();
  $SetMessages  = new SetMessages();
  $OutilConvert = new OutilConvert();
  
  $sens = $GetChoix->getSens();
  echo  $sens . "\n";
  if (10 == $sens)  // Conversion UTF8 en ISO-8859-1
      $convert = 'utf8_decode'; // utf8_decode — Convertit une chaîne UTF-8 en ISO-8859-1 : http://fr2.php.net/manual/fr/function.utf8-decode.php
  elseif (11 == $sens)  // Conversion ISO-8859-1 en UTF8
      $convert = 'utf8_encode'; // utf8_encode — Convertit une chaîne ISO-8859-1 en UTF-8 : http://fr2.php.net/manual/fr/function.utf8-encode.php
  else 
      die();
  
  echo $convert . "\n";
  
  $rep_init = $GetChoix->getRepInitial();
  if (is_null($rep_init)){
      $SetMessages->messageError('Vous n\'avez pas indiqué de répertoire à convertir');
      die();
  }
  $rep_init = str_replace("\\", "/", $rep_init);
  echo $rep_init . "\n";
  $rep_cible = $GetChoix->getRepCible();
  if (is_null($rep_cible)){
      $SetMessages->messageError('Vous n\'avez pas indiqué de répertoire cible');
      die();
  }
  $rep_cible = str_replace("\\", "/", $rep_cible);
  echo $rep_cible . "\n";
  
  $OutilConvert->convert_dir($convert, $rep_init, $rep_cible);
    
  $SetMessages->messageInfo('Fin de la convertion');
  
  