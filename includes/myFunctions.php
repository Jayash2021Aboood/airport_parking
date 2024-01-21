<?php
  // session_start();
  function uploadImage($filedName, $dirctoryPath, $old_value = null)
  {
    if(!empty($_FILES[$filedName]['tmp_name']))
    {
      $file = basename( $_FILES[$filedName]['name']);
      $path = $dirctoryPath . $file;


      if(move_uploaded_file($_FILES[$filedName]['tmp_name'], $path)) 
      {
        return $file;
      }
      else
      {
        return null;
      }
    }
    else
    {
      if(isset($old_value) && !empty($old_value))
      {
        return $old_value;
      }
      else
      {
        return null;
      }
    }
    return null;
  }


  function getRateColor($rate)
  {
    if(!isset($rate)) return "danger";
    if($rate > 75){
      return "success";
    }
    else if($rate > 50){
      return "primary";
    }
    else if($rate > 25){
      return "warning";
    }
    else{
      return "danger";
    }
  }

  function displayAvailableCount($available_copies_count)
  {
    if(!isset($available_copies_count)){
      return '<span class="badge bg-danger"> '. lang("Available"). $available_copies_count.' </span>';
    } 
    if($available_copies_count > 0){
      return '<span class="badge bg-success"> '. lang("Available"). $available_copies_count . ' </span>';
    }
    // else if($available_copies_count > 50){
    //   return "primary";
    // }
    // else if($available_copies_count > 25){
    //   return "warning";
    // }
    else{
      return '<span class="badge bg-danger"> '. lang("Available"). $available_copies_count.' </span>';
    }
  }

  function lang($word) {

    if( !isset($_SESSION['words']) || is_null($_SESSION['words'])) {
      if(isset($_SESSION['lang'])){
        changeLanguage($_SESSION['lang']);
      }
      else{
        $_SESSION['lang'] = 'en';
        changeLanguage($_SESSION['lang']);
      }
    }

    if(is_null($_SESSION['words'])) {
      var_dump($_SESSION);
      exit;
      lang($word);
    }
    $translations = $_SESSION['words'];
    if(!array_key_exists($word, $translations)){
      if($_SESSION['lang'] == "ar"){

        // print('"'.$word.'" : "'.$word.'",');
        // print('</br>');
        // var_dump($translations);
        $filename = DIR_LANG . 'ar_noneTranslated.txt';
        $text = '"'.$word.'" : "'.$word.'",';
        $word_exists = false;

        // Read the contents of the file
        $file_contents = file_get_contents($filename);

        // Check if the word already exists in the file
        if(strpos($file_contents, $text)!== false){
          $word_exists = true;
        }

        if(!$word_exists){
          // // Append the new text to the end of the file
          // $file_contents.= "\n". $text;

          // // Write the modified contents back to the file
          // file_put_contents($filename, $file_contents, FILE_APPEND);



          // Open the file in read-write mode
          $file = fopen($filename, "r+");

          // Move the cursor to the end of the file
          fseek($file, 0, SEEK_END);

          // Write the new line to the end of the file
          fwrite($file, $text . "\n");

          // Close the file
          fclose($file);


        }
        
        // exit();
      }
    }

    // this code for adding non translated word to seprate file 
    //to let us found it and  translated quickly
    //$result = $translations[$word];
    // if($_SESSION['lang'] == "ar" && !isset($translations[$word])){
    //     $filename = 'lang/ar_noneTranslated.txt';
    //     $text = '"'.$word.'" : "'.$word.'",';

    //     // Read the contents of the file
    //     $file_contents = file_get_contents($filename);

    //     // Append the new text to the end of the file
    //     $file_contents.= "\n". $text;

    //     // Write the modified contents back to the file
    //     file_put_contents($filename, $file_contents, FILE_APPEND);
    // }
    return isset($translations[$word])? $translations[$word] : $word;
  }
  

  function changeLanguage($lang = 'en') 
  {
    try {
      //code...
      $_SESSION['lang'] = $lang ?? 'en';
      
      $lang = isset($_SESSION['lang'])? $_SESSION['lang'] : 'en';
      $_SESSION['words'] = json_decode(file_get_contents('lang/'.$lang.'.json'), true);
    } catch (\Throwable $th) {
      //throw $th;
      var_dump($th);
      exit();
    }
  }

  function getCurrentLanguage() 
  {
    try {
       return $_SESSION['lang'] ?? 'en';
    } catch (\Throwable $th) {
      //throw $th;
      var_dump($th);
      exit();
    }
  }
















  function redirectToReferer($error = null)
  {
    if(isset($error))
    {
      if(empty($_SESSION['fail']))
      {
        $_SESSION['fail'] = $error;
      }
      else{
        $_SESSION['fail'] .= $error;
      }
    }
     
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  function redirectToRefererSuccess($message = null)
  {
    if(isset($message))
    {
      if(empty($_SESSION['success']))
      {
        $_SESSION['success'] = $message;
      }
      else{
        $_SESSION['success'] .= $message;
      }
    }
     
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  }

  ?>