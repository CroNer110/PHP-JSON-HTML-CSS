<?php
header('Content-type: text/plain; charset=utf-8');

$json = file_get_contents("../assets/lige.json");
$data = json_decode($json,true);

$json2 = file_get_contents("../assets/ponude.json");
$data2 = json_decode($json2,true);

setlocale(LC_ALL, 'hr_HR','hrv_HRV', 'hr', 'hrv', 'croatian', 'hrvatski', 'Croatian', 'Hrvatski', 'hr_HR.utf8');
date_default_timezone_set('UTC');


foreach ($data["lige"] as $key => $jsons) {
    echo "<table  cellpadding='0' cellspacing='0' class='liga'>";
        echo "<thead class='ligaHeader' >";
            echo "<tr>";
            echo "<th class='nazivSporta' width='100px'></th>";
            echo "<th class='nazivLige' width='460px'>";
                echo "<div class='liga-name'>".$jsons["naziv"]."</div>";              
            echo "</th>";
           echo "</tr>";
        echo "</thead>";
        
    echo "<tbody>";
    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<table class='razrada' cellpadding='0' cellspacing='1'>";
    
    echo "<thead>";
    
     echo "<tr>";  
    
    echo "<td width='35px'></td>";
    echo "<td width='208px'></td>";
    echo "<td width='20px'></td>";
    echo "<td width='60px'></td>";                                             
  
    $brTip=count($jsons["razrade"][0]["tipovi"]);
  
    do{
        echo "<td width='35px'></td>"; 
        $brTip--;
    }while($brTip>0);
   
     
  
    
    echo "</tr>";
    
    echo "<tr>"; 
    echo "<th colspan='4' class='razradaKolona'>";
    echo "<div class='tip_wrapper'>";
    echo "<div class='razrada_naziv'></div>";
    echo "</div>";
    echo "</th>";
    foreach ($jsons["razrade"] as $key => $value) { 
           
    
       
            foreach($value["tipovi"] as $key => $jsons2){
        
        
            echo "<th class='tip'>".$jsons2["naziv"]."</th>";
            
        
           
        
            
            } 
    echo "</tr>";
    echo "</thead>";
    
    echo "<tbody>";
    echo "<tr onmouseover='Web.Common.Ponuda.handlePonudaMouseOver(this);'
  onmouseout='Web.Common.Ponuda.handlePonudaMouseOut(this);'>";
    
    
      
              
         
      
        foreach ($value["ponude"] as $key => $valuep) {
                
        
           
        foreach ($data2 as $key => $jsonsp){
         
        if($valuep==$jsonsp["id"]){
          
             echo "<td class='brojPonude'>".$jsonsp["broj"]."</td>";
             if(isset($jsonsp["tv_kanal"])){
                 $tv="<div class='utakmica_tv_channel'><i class='ico_tv_channel'></i>".$jsonsp["tv_kanal"]."</div>";
             }
             else{
                $tv=null; 
             }
             
            
             if(isset($jsonsp["ima_statistiku"])){
               echo "<td class='nazivPonude'>".$jsonsp["naziv"];
               echo $tv;
               echo "</td>";
               echo "<td class='statistikaUtakmice'></td>";  
               
             }else{
               echo "<td class='nazivPonude' colspan='2' >".$jsonsp["naziv"];
               echo $tv;
               echo "</td>";
             }
             
             
             
             

            
             $got=date('D G:i', strtotime($jsonsp["vrijeme"]));
           
             echo "<td class='datumPonude'>".$got."</td>";
            
            
             
            
             
             $i=0;
             
             foreach ($value["tipovi"] as $key => $jsons2){
             if($i < count($jsonsp["tecajevi"])){
                 
             if( ($jsonsp["tecajevi"][$i]["naziv"] == $jsons2["naziv"])){
             echo "<td>".$jsonsp["tecajevi"][$i]["tecaj"]."</td>";
             $i++;
             }
             else{
                 echo "<td>"."-"."</td>";
             }
             
             }
             
             elseif(count($value["tipovi"])>$i){
                 echo "<td>"."-"."</td>";
                 $i++;
             }
           
             }
             
           
        }
       
        
    }
                            echo "</tr>";
    
 
    }
    



}
echo "</tbody>";
echo "</table>";
echo "</td>";
echo "</tr>";
echo "</tbody>";
echo "</table>"; 
}




?>
