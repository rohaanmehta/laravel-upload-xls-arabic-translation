<?php  
//download direct csv without downloading on server ( no ajax on href )

$csv2 = 'Id,Name,Address';
   foreach($excel as $row){
       $csv2 = $csv2.'
'.$row['id'].','.$row['name'].','.$row['address'];
   }
   
   header("Content-type: text/x-csv");
   header("Content-Disposition: attachment; filename=Arabic_".Date('d-M').'.csv');
   echo $csv2;
   exit;
?>