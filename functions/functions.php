<?php
require_once('./sql/connect.php');
require_once('./sql/query.php');

function calification($id){

    $link = connect();
    $query=getCalifications($id);

    $result=mysqli_query($link, $query);
    //echo '<pre>'; var_dump($result); exit();   
    //echo '<pre>'; var_dump($row); exit();
    if ($result ) {
          $tot=0; $cant = 0;
          while ($row = mysqli_fetch_assoc($result)){
              $tot += $row['calificacion'];
              $cant ++;}
          //echo '<pre>'; var_dump($cant); exit();
           $calification=($tot / $cant);
           return $calification;
        }
     else{ return 0; }

}



function cleanInput($input) {

  $search = array(
    '@< [/!]*?[^<>]*?>@si'           // Strip out HTML tags
  );

    $output = preg_replace($search, '', $input);
    return $output;
}


function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysqli_real_escape_string($input);
    }
    return $output;
}
?>
