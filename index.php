<?php
$f = "visit.php";
if(!file_exists($f)){
	touch($f);
	$handle =  fopen($f, "w" ) ;
	fwrite($handle,0) ;
	fclose ($handle);
}
 
include('libs/phpqrcode/qrlib.php'); 

function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}
$name = "";
$position = "";
$phone = "";
$email = "";
$address = "";
$tempDir = 'temp/';
$filename = 'author';



if(isset($_POST['submit']) ) {
	$tempDir = 'temp/'; 
	$name = $_POST['name'];
	$position = $_POST['position'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	//$subject =  $_POST['subject'];
	$filename = getUsernameFromEmail($email);
	// $body =  $_POST['msg'];
	// $codeContents = 'mailto:'.$email.'?subject='.urlencode($subject).'&body='.urlencode($body); 
	// QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);

    // we building raw data
    $codeContents  = 'BEGIN:VCARD'."\n";
    $codeContents .= 'VERSION:2.1'."\n";
    $codeContents .= 'FN:'.$name."\n";
    $codeContents .= 'TEL;WORK;VOICE:'.$phone."\n";
    // $codeContents .= 'ADR;TYPE=work;'.
    //         'LABEL="'.$address."\n";
    $codeContents .= 'ADR;TYPE=work;'.
            'Address="HOME":'
            .$address.';'
        ."\n";       
    $codeContents .= 'EMAIL:'.$email."\n";
    $codeContents .= 'END:VCARD';
    // generating
	QRcode::png($codeContents, $tempDir.$filename.'.png', QR_ECLEVEL_L, 3);


}
	    
	    
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
	<title>E-BUSINESS CARD SYSTEM</title>
	<link rel="icon" href="img/favicon-32x32.png" type="image/png">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/style.css">
	<script src="libs/navbarclock.js"></script>
	</head>
	<body onload="startTime()">
		<nav class="navbar-inverse" role="navigation">
			<a href=# class="logo">
				Tj Thouhid Qrcode Generator
			</a>
			<div id="clockdate">
				<div class="clockdate-wrapper">
					<div id="clock"></div>
					<div id="date"><?php echo date('l, F j, Y'); ?></div>
				</div>
			</div>
			
		</nav>
		<div class="myoutput">
			<h3><strong>E-BUSINESS CARD SYSTEM</strong></h3>
			<div class="input-field">
				<h3>Contact Details</h3>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" placeholder="Enter your Name" value="<?php echo $name; ?>"/>
					</div>
					<div class="form-group">
						<label>Position</label>
						<input type="text" class="form-control" name="position" placeholder="Enter your Position" value="<?php echo $position; ?>"/>
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input type="number" class="form-control" name="phone" placeholder="Enter your Phone Number" value="<?php echo $phone; ?>"/>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" placeholder="Enter your Email" value="<?php echo $email; ?>" required />
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" name="address" value="<?php echo @$address; ?>" required placeholder="Enter your address">
					</div>
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />
					</div>
				</form>
			</div>
			
			<div class="qr-field">
				<h2 style="text-align:center">SCAN ME ! </h2>
				<center>
					<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
							<?php echo '<img src="temp/'. $filename.'.png" style="width:200px; height:200px;"><br>'; ?>
					</div>
					<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
						<h2 class="gb-head-text">Generate Business Card</h2>
						<ul class="card-list">
							<li><a class="blue" href="vcard.php?color=blue&file=<?php echo $filename; ?>&name=<?php echo $name; ?>&phone=<?php echo $phone; ?>&email=<?php echo $email; ?>&address=<?php echo $address; ?>&position=<?php echo $position; ?>" target="_blank">Blue</a></li>
							<li><a class="purple" href="vcard.php?color=purple&file=<?php echo $filename; ?>&name=<?php echo $name; ?>&phone=<?php echo $phone; ?>&email=<?php echo $email; ?>&address=<?php echo $address; ?>&position=<?php echo $position; ?>" target="_blank">Purple</a></li>
							<li><a class="red" href="vcard.php?color=red&file=<?php echo $filename; ?>&name=<?php echo $name; ?>&phone=<?php echo $phone; ?>&email=<?php echo $email; ?>&address=<?php echo $address; ?>&position=<?php echo $position; ?>" target="_blank">Red</a></li>
							<li><a class="yellow" href="vcard.php?color=yellow&file=<?php echo $filename; ?>&name=<?php echo $name; ?>&phone=<?php echo $phone; ?>&email=<?php echo $email; ?>&address=<?php echo $address; ?>&position=<?php echo $position; ?>" target="_blank">Yellow</a></li>
						</ul>
					
				</center>
			</div>
			<div class="clearfix"></div>
			<div class = "dllink">
				<h4>Copyrights 2021, Tj Thouhid (PMJ) </h4>
			</div>
		</div>
	</body>
</html>