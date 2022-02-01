<?php

//fetch.php

include '../../connection/connection.php' ;

if($_POST["query"] != '')
{
	$search_array = explode(",", $_POST["query"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query = "SELECT * , b.department_id,c.department_id,c.department_name AS name_depart , d.status_name,f.id_statuss,f.statuss_name AS name_status
	FROM main_std a JOIN dimension_department b ON a.standard_idtb = b.standard_idtb JOIN department_tb c ON b.department_id = c.department_id 
	JOIN doc_status d ON a.standard_idtb  = d.standard_idtb JOIN select_status f ON d.status_name = f.id_statuss
	WHERE b.department_id IN (".$search_text.")  ";
}
else
{
	$query = "SELECT * , b.department_id,c.department_id,c.department_name AS name_depart , d.status_name,f.id_statuss,f.statuss_name AS name_status
	FROM main_std a JOIN dimension_department b ON a.standard_idtb = b.standard_idtb JOIN department_tb c ON b.department_id = c.department_id 
	JOIN doc_status d ON a.standard_idtb  = d.standard_idtb JOIN select_status f ON d.status_name = f.id_statuss";
}

$result = sqlsrv_query($conn,$query);
$total_row = sqlsrv_num_rows($result);
$i=1;
$output = '';


	while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
	{
		$output .= '
		<tr>
		<td>'.$i++.'</td>
		<td>'.$row["name_depart"].'</td>
		<td>'.$row["standard_number"].'</td>
		<td>'.$row["standard_detail"].'</td>
		<td>'.$row["name_status"].'</td>
		<td>'.$row["status_date"].'</td>
		</tr>
		';
	}

echo $output;


?>