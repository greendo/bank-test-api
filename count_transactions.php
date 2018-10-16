<?php
	$con = mysqli_connect("localhost","user","password","softbet");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con, "SELECT * FROM transactions WHERE created_at created_at BETWEEN subdate(CURDATE(), 1) and date (now())");

	$sum = 0;
	foreach($result as $r) {
		print_r($r);
		$sum += $r['amount'];
	}
	print_r($sum);

	mysqli_close($con);

	$file = fopen("stack.txt", "w") or die("Unable to open file!");
	$yesterday = date('d.m.Y',strtotime("-1 days"));
	$txt = "$yesterday: $sum\n";
	fwrite($myfile, $txt);
	fclose($myfile);
?>
