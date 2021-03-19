<?php

function getAllReceiversByCustomerId($customerId){
    $result="";
    //$sql="select * from rxr_customer r where r.id in (select distinct o.rxr_id from orders o where o.sender_id=".$customerId." and o.scur='".$scurrency."' and o.rcur='".$rcurrency."' order by o.id desc)";
    $sql="select r.* from rxr_customer r, customer c where r.sender_id=c.id and c.id=".$customerId;
    //echo $sql;
    $rxrs=getFetchArray($sql);
    if($rxrs!=null){
        $result.= '<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Handy</th>
      <th scope="col">Bank</th>
      <th scope="col">Branch</th>
        <th scope="col">Country</th>
    </tr>
  </thead> <tbody>';
        
        foreach($rxrs as $row){
            $result.='<tr>
      <td scope="row"><input id="ex_receiver" type="checkbox" value="'.$row['id'].'"></td>
      <td>'.$row['rxr_first_name'].' '.$row['rxr_last_name'].'</td>
       <td>'.$row['rxr_address'].'</td>
      <td>'.$row['rxr_mobile_no'].'</td>
        <td>'.$row['rxr_bank_name'].'</td>
        <td>'.$row['rxr_bank_branch'].'</td>
        <td>'.$row['rxr_country'].'</td>
    </tr>';
        }
        $result.='</tbody></table>';
    }
    return $result.'<button class="btn btn-warning btn-sm float-right" title="Add New Receiver" data-url="receivers.php?id='.$customerId.'&action=showFormToAddReceiver" id="showFormToAddReceiver" type="button">Add New Receiver</button>';
}

function insertCustomerOrder(){
    $scurrency=$_POST['scurrency'];
    $rcurrency=$_POST['rcurrency'];
    $rate=$_POST['rate'];
    $sender_id=$_POST['sender'];
    //print("sender id ".$sender_id);
    $receiver=$_POST['receiver'];
    //print("sender ".$receiver);
    $receiver_id="";
    $tmp=explode("-", $receiver);
    if($tmp != null){
        if(is_numeric($tmp[0])){
            $receiver_id=$tmp[0];
        }
    }
    $samount=$_POST['samount'];
    $ramount=$_POST['ramount'];
    $orderType=$_POST['orderType'];
    $scharge=$_POST['scharge'];
    $total=$_POST['total'];
    $comments=$_POST['comments'];
    $ragent_id=$_POST['ragent_id'];
    $sagent_id=1;
    
    
    $sql="INSERT INTO orders(order_type, status, bookie_id, sender_id, rxr_id, sagent_id, ragent_id, scur, rcur, samount, ramount, er, xrate_action, scharge, total_samount, commission, total_ramount, comments, p_trans_id, cdate) 
            VALUES ('$orderType','Started',1,$sender_id,$receiver_id,$sagent_id,$ragent_id,'$scurrency','$rcurrency',$samount,$ramount,$rate,NULL,$scharge,$total,NULL,$total,'$comments',NULL, CURDATE())";
    //print($sql);
    return insertSQL($sql);

}

function markDone($id){
    $sql="update orders set status='Done' where id=".$id;
    executeSQL($sql);
}