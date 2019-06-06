<?php include 'tablenav.php';?>
<?php 
$elementCount = count($data['thead']);
$sales_details = array();
$z=0;
$y=0; 
$details = array();
$record_types = array("A" => "ADJUSTMENT", "S" => "SALE", "R" => "RECEIVING");
$record_classes = array("A" => "adjustment", "S" => "sales", "R" => "receiving");

 
if(!empty($data['report']) && $data['report'] != null && $data['report'] != false && count($data['report']) != 0)
{
    echo "<thead class='thead_position'><tr>";
    for($j = 0; $j < $elementCount; $j++)
    {
        echo "<th>" . $data['thead'][$j] . "</th>";
    }
    echo "</tr></thead><tbody>";
	for ($i = 0; $i < count($data['report']); $i++) 
    {

    $new_sales_details = array($data['report'][$i]['sales_units'], $data['report'][$i]['sales_date']);

    $new_details = array($data['report'][$i]['units'], $data['report'][$i]['record_type'], $data['report'][$i]['date']);

    if(in_array($new_details, $details)){
        // ne rien faire
    }else{
        $onhandClass = "positive"; 
        if(!empty($data['report'][$i]["onhand"]))
        {
            if(floor($data['report'][$i]["onhand"] < 0))
            {
                $onhandClass = "negative";
            }
            $data['report'][$i]["onhand"] = floor($data['report'][$i]["onhand"]);
        }
        if(!empty($data['report'][$i]["lastReceiving"]))
        {
            $data['report'][$i]["lastReceiving"] = abs($data['report'][$i]["lastReceiving"]);
        }
        if(!empty($data['report'][$i]["unitPrice"]))
        {
            $data['report'][$i]["unitPrice"] = number_format($data['report'][$i]["unitPrice"], 2, ".", "");
        }
        if(!empty($data['report'][$i]["CaseCost"]))
        {
            $data['report'][$i]["CaseCost"] = number_format($data['report'][$i]["CaseCost"], 2, ".", "");
        }
        if(!empty($data['report'][$i]["sales"]))
        {
            $data['report'][$i]["sales"] = abs(floor($data['report'][$i]["sales"]));
        }
        echo "<tr>";
        for($l=0; $l < count($data['qt']); $l++)
        {
            if($data["qt"][$l] == "Retail")
            {
                echo "<td class='" . $data["qt"][$l] . "'>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
            }
            else
            {
                if($data["qt"][$l] == "onhand")
                {
                    echo "<td class='" . $data["qt"][$l] . " " . $onhandClass . "'>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                }
                else
                {
                    if($data["qt"][$l] == "lastReceiving" && empty($data['report'][$i]["lastReceivingDate"]) )
                    {
                        echo "<td class='" . $data["qt"][$l] . "'></td>";
                    }
                    else
                    {
                        if($data["qt"][$l] == "UPC")
                        {
                            echo "<td class='" . $data["qt"][$l] . " " . $onhandClass . "'>
                            <a href = '/csm/public/home/UPCPriceCompare_url/" . $data['report'][$i][$data["qt"][$l]] . "'>" . $data['report'][$i][$data["qt"][$l]] . "
                            </a></td>";
                        }
                        else
                        {
                            if($data["qt"][$l] == "CertCode")
                            {
                                echo "<td class='" . $data["qt"][$l] . "'>
                                <a href = '/csm/public/home/vendorItemCode_url/" . str_replace(' ', '', $data['report'][$i][$data["qt"][$l]]) . "'>" . str_replace(' ', '', $data['report'][$i][$data["qt"][$l]]) . "</a></td>";
                            }
                            else
                            {
                                if($data['qt'][$l] == "units"){
                                    echo "<td class='" . $data["qt"][$l] . " ".$record_classes[$data['report'][$i]['record_type']]." '>" . number_format($data['report'][$i]["units"], 0) . "</td>";
                                   }else{
                                    if($data['qt'][$l] == 'record_type'){
                                        echo "<td class='" . $data["qt"][$l] . " ".$record_classes[$data['report'][$i][$data["qt"][$l]]]." '>" . $record_types[$data['report'][$i][$data["qt"][$l]]] . "</td>";
                                    }else{
                                        if($data['qt'][$l] == 'unitPrice'){
                                            echo "<td class='" . $data["qt"][$l] . "' style='color:blue'>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                                        }else{
                                            if($data['qt'][$l] == 'date'){
                                                echo "<td class='" . $data["qt"][$l] . " ".$record_classes[$data['report'][$i]['record_type']]." '>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                                            }else{
                                                echo "<td>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                                            }
                                            
                                        }
                                        
                                        
                                      }
                                   }
                                
                            }
                        }
                    }
                }
            }
        }
        $details[$y] = $new_details;
        $y = $y + 1;
    }

    if(in_array($new_sales_details, $sales_details)){
        // ne rien faire 
    }else{
        // afficher une ligne
        $onhandClass = "positive"; 
        if(!empty($data['report'][$i]["onhand"]))
        {
            if(floor($data['report'][$i]["onhand"] < 0))
            {
                $onhandClass = "negative";
            }
            $data['report'][$i]["onhand"] = floor($data['report'][$i]["onhand"]);
        }
        if(!empty($data['report'][$i]["lastReceiving"]))
        {
            $data['report'][$i]["lastReceiving"] = abs($data['report'][$i]["lastReceiving"]);
        }
        if(!empty($data['report'][$i]["unitPrice"]))
        {
            $data['report'][$i]["unitPrice"] = number_format($data['report'][$i]["unitPrice"], 2, ".", "");
        }
        if(!empty($data['report'][$i]["CaseCost"]))
        {
            $data['report'][$i]["CaseCost"] = number_format($data['report'][$i]["CaseCost"], 2, ".", "");
        }
        if(!empty($data['report'][$i]["sales"]))
        {
            $data['report'][$i]["sales"] = abs(floor($data['report'][$i]["sales"]));
        }
        echo "<tr>";
        for($l=0; $l < count($data['qt']); $l++)
        {
            if($data["qt"][$l] == "Retail")
            {
                echo "<td class='" . $data["qt"][$l] . "'>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
            }
            else
            {
                if($data["qt"][$l] == "onhand")
                {
                    echo "<td class='" . $data["qt"][$l] . " " . $onhandClass . "'>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                }
                else
                {
                    if($data["qt"][$l] == "lastReceiving" && empty($data['report'][$i]["lastReceivingDate"]) )
                    {
                        echo "<td class='" . $data["qt"][$l] . "'></td>";
                    }
                    else
                    {
                        if($data["qt"][$l] == "UPC")
                        {
                            echo "<td class='" . $data["qt"][$l] . " " . $onhandClass . "'>
                            <a href = '/csm/public/home/UPCPriceCompare_url/" . $data['report'][$i][$data["qt"][$l]] . "'>" . $data['report'][$i][$data["qt"][$l]] . "
                            </a></td>";
                        }
                        else
                        {
                            if($data["qt"][$l] == "CertCode")
                            {
                                echo "<td class='" . $data["qt"][$l] . "'>
                                <a href = '/csm/public/home/vendorItemCode_url/" . str_replace(' ', '', $data['report'][$i][$data["qt"][$l]]) . "'>" . str_replace(' ', '', $data['report'][$i][$data["qt"][$l]]) . "</a></td>";
                            }
                            else
                            {
                                if($data['qt'][$l] == "record_type"){
                                    echo "<td class='" . $data["qt"][$l] . " sales'> SALE </td>";
                                }else{
                                   if($data['qt'][$l] == "units"){
                                    echo "<td class='" . $data["qt"][$l] . " sales'>" . number_format($data['report'][$i]["sales_units"], 0) . "</td>";
                                   }else{
                                       if($data['qt'][$l] == "date"){
                                           echo "<td class='" . $data["qt"][$l] . " sales'>" . $data['report'][$i]["sales_date"] . "</td>";
                                       }else{
                                        if($data['qt'][$l] == 'unitPrice'){
                                            echo "<td class='" . $data["qt"][$l] . "' style='color:blue'>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                                        }else{
                                            echo "<td>" . $data['report'][$i][$data["qt"][$l]] . "</td>";
                                        }
                                       }
                                   }
                                }
                            }
                        }
                    }
                }
            }
        }
        $sales_details[$z] = $new_sales_details;
        $z = $z + 1;
    }





        
    }
}
else
{
	echo "<a href='/csm/public/home/'><p class='text-warning errortext'>THE REPORT DID NOT GENERATE ANY RESULTS. PLEASE CHECK THE UPC NUMBER. DID YOU ENTER THE RIGHT SALES DATES ?</p></a>";
}
?>
</tbody>
</table>
</div>
</div>
</div>

<style type="text/css">
    .ItemDescription{
        text-align:center!important;
    }

    .adjustment{
        color:#EC981D;
    }

    .receiving{
        color:#47A440;
    }

    .sales{
        color:#970ECB;
    }
</style>