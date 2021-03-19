<?php

function getExchangeRates(){
    $result="";
    $sql="select * from xchange order by id";
    //echo $sql;
    $rxrs=getFetchArray($sql);
    if($rxrs!=null){
        $result.= '
<input type="hidden" name="action" value="update_rates">
<table class="table table-sm">
  <thead>
    <tr>
        <th scope="col">Sending Currency</th>
        <th scope="col">Amount</th>      
        <th scope="col">Receiving Currency</th>
        <th scope="col">Modified Date</th>
    </tr>
  </thead> <tbody>';
        
        foreach($rxrs as $row){
            $result.='<tr>
      <td scope="row">'.$row['scur'].'</td>
      <td scope="row"><input style="width:75px;" name="er_'.$row['id'].'" type="number" min="1" value="'.$row['transfer'].'"></td>
       <td scope="row">'.$row['rcur'].'</td>
      <td scope="row">'.$row['mdate'].'</td>
    </tr>';
        }
        $result.='</tbody></table>';
    }
    return $result;
}

function updateExchangeRates(){
    $er1=$_POST['er_1'];
    $er2=$_POST['er_2'];
    $er3=$_POST['er_3'];
    $er4=$_POST['er_4'];
    
    executeSQL("update xchange set transfer=".$er1." where id=1");
    executeSQL("update xchange set transfer=".$er2." where id=2");
    executeSQL("update xchange set transfer=".$er3." where id=3");
    executeSQL("update xchange set transfer=".$er4." where id=4");
}