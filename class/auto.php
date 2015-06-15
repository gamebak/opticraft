<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">


<table id="myTable">
	<thead>
            <tr>
                <th>User</th>
                <th>Gain</th>
                <th>Downtime</th>
                <th>Max profit</th>
                <th>Max Increase</th>
            </tr>
    </thead>
</table>
<?php
require_once("class/request.php");

$r = new Request;
if(file_exists('data.html'))
{
	$str = file_get_contents('data.html');
}
else
{
	$str = $r->fetch("http://www.myfxbook.com/autotrade");
	file_put_contents('data.html', $str);
}
//<td><span class=\'green\'>\+(.*?)%</span></td>.*?<td><span class=\'green\'>\+(.*?)%</span></td>(.*?)<td>(.*?)</td>#s'
preg_match_all('#<tr .*?a id="systemLink.*?" class="underline" href="(.*?)" target="_blank">(.*?)</a>.*?</tr>#s', $str, $findAll);

// 10, 11,12
//var_dump($findAll);

$tmp = array();
$total_profit = 1;
for($i=0;$i<count($findAll[1]);$i++)
{
	preg_match_all('#<span class=\'green\'>\+(.*?)\%</span></td>#', $findAll[0][$i], $findMonthly);
	
	preg_match('#<td>(\d+)\.(.*?)</td>.*?<td>(Technical|\-|Fundamental)</td>#s', $findAll[0][$i], $findDowntime);

	// username [monthly] = monthly
	// username [downtime] = downtime
	$tmp[ $findAll[2][$i] ]['gain'] = $findMonthly[1][0];
	$tmp[ $findAll[2][$i] ]['monthly'] = $findMonthly[1][2];
	$tmp[ $findAll[2][$i] ]['downtime'] = floatval($findDowntime[1].'.'.$findDowntime[2]);
	if( $tmp[ $findAll[2][$i] ]['downtime'] == 0 )
		$tmp[ $findAll[2][$i] ]['max_increase'] = 1;
	else 
		$tmp[ $findAll[2][$i] ]['max_increase'] = round( 99.9/$tmp[ $findAll[2][$i] ]['downtime'], 1 );
	$tmp[ $findAll[2][$i] ]['max_profit'] = $tmp[ $findAll[2][$i] ]['max_increase'] * $tmp[ $findAll[2][$i] ]['monthly'];

	if( $tmp[ $findAll[2][$i] ]['max_profit'] > 0 )
		$total_profit += $findMonthly[1][0];
}

echo "<script>var t = $('#myTable').DataTable();";
foreach( $tmp as $user => $val )
{
	
	echo 't.row.add( ["'.$user.'","'.$val['gain'].'","'.$val['downtime'].'","'.$val['max_profit'].'","'.$val['max_increase'].'"]).draw();';
}
echo "</script>";

echo "<h1>Total profit:".$total_profit."</h1>";
/*
for( $i=10;$i<count($findAll[2]);$i++)
{
	echo $findAll[1][$i].' luna '.$findRes[1][$i+2].PHP_EOL;

}

*/

?>