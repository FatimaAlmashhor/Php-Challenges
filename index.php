<?php 
    $arr = array(1,5,2,5,1,3,2,4,5);
    echo "Original Array : \n";
    print_r($arr);
    $arr2 = array_flip($arr);
    echo '</br>';
    $arr2 = array_flip($arr2);
  
    // re-order the array keys
    $arr2= array_values($arr2);
  
    // print updated array
    echo "\nUpdated Array : \n ";
    print_r($arr2);

    $uniqueArry = array();
 
foreach($arr as $val) { //Loop1 
    
    foreach($uniqueArry as $uniqueValue) { //Loop2 

        if($val == $uniqueValue) {
            continue 2; // Referring Outer loop (Loop 1)
        }
    }
    $uniqueArry[] = $val;
}
echo "</br>";
echo "\nOther Slotion : \n ";
    print_r($arr);
    echo "</br>";
print_r($uniqueArry);
?>