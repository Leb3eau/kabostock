<?php

require_once 'core.php';

$orderId = $_POST['orderId'];

$valid = "<thead>
            <th>Date paiement</th>
             <th>Montant</th>
        </thead>
         <tbody>";

$sql = "SELECT * FROM order_payment WHERE order_id = {$orderId}";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $valid .='<tr>
                    <td>'. date('d-m-Y', strtotime($row[3])).'</td>
                    <td>'.$row[2].'</td>
                 </tr>';
    }
}
$valid .= "</tbody>";

$connect->close();

echo $valid;
