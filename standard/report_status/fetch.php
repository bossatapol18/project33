<?php

//fetch.php

include '../../connection/connection.php' ;

if($_POST["query"] != '')
{
	$search_array = explode(",", $_POST["query"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query = "SELECT * ,a.status_name,b.id_statuss,b.statuss_name AS name_status 
	FROM main_std aa 
	JOIN doc_status a ON aa.standard_idtb = a.standard_idtb 
	JOIN select_status b  ON a.status_name = b.id_statuss  
	WHERE a.status_name IN (".$search_text.")  ";
}
else
{
	$query = "SELECT * ,a.status_name,b.id_statuss,b.statuss_name AS name_status 
	FROM main_std aa 
	JOIN doc_status a ON aa.standard_idtb = a.standard_idtb 
	JOIN select_status b  ON a.status_name = b.id_statuss  ";
}

$result = sqlsrv_query($conn,$query);
$total_row = sqlsrv_num_rows($result);
$i = 1;
$output = '';


	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
	{
		$output .= '
		<tr>
		<td>'.$i++.'</td>
		// <td>'.$row["standard_number"].'</td>
		// <td>'.$row["standard_detail"].'</td>
		<td>'.$row["name_status"].'</td>
		<td>'.$row["status_date"].'</td>
		</tr>
		';
	}

echo $output;


?>