<html>
<head>
	<meta http-equiv="refresh" content="5">
	<title>eLearning Messaging App - 2016</title>
	
</head>
<body>
			<?php
			session_start();
			ini_set('display_errors', '1');
			ini_set('display_startup_errors', '1');
			error_reporting(E_ALL);
				include("connect.php");

				
				$userid = $_SESSION["userid"];
				//echo $userid;
				$showq = "SELECT userstb.fname,chattb.chatbody,chattb.chatdate,userstb.username FROM userstb INNER JOIN chattb ON userstb.userID = chattb.userID ORDER BY chattb.chatid desc LIMIT 50";
				//echo $showq."<br>";
				$show = mysqli_query($conn, $showq);
				
				$show2q = "SELECT userstb.fname,chattb.chatbody,chattb.chatdate,userstb.username,chattb.chatid FROM userstb INNER JOIN chattb ON userstb.userID = chattb.userID WHERE status=0 and chattb.userID<>'$userid'  ORDER BY chattb.chatid DESC LIMIT 1";
				//echo $show2q."<br>";
				$show2 = mysqli_query($conn,$show2q);
				$cur_bg = "skyblue";
				$cur_txt = "white";
				$r = mysqli_fetch_array($show2);
				$ci=$r['chatid'];
					$s=$r[1];
					
				
				
			    ?>
				
					<script>
    				var s2 = "<?php echo $s; ?>";
					let msg = s2;
						let speech = new SpeechSynthesisUtterance();
         				speech.lang = "en-US";
						               
						speech.text = msg;
						speech.volume = 33;
						speech.rate = 33;
						speech.pitch = 33;
						window.speechSynthesis.speak(speech);
											
					</script>
				
				<?php
				mysqli_query($conn,"UPDATE chattb set status=1 where chatid='$ci'");
				while($row = mysqli_fetch_array($show))
				{

					$cur_user = $row[3];
					

					//$getclr = mysqli_query($conn,"SELECT colortb.colorbg,colortb.colortxt FROM colortb INNER JOIN userstb ON colortb.username = colortb.username WHERE userstb.username = '$cur_user' ORDER BY colortb.colorid DESC");
					$getclr = mysqli_query($conn,"SELECT colortb.colorbg,colortb.colortxt FROM colortb WHERE colortb.username = '$cur_user' ");

					while($val = mysqli_fetch_array($getclr))
					{
						$cur_bg = $val[0];
						$cur_txt = $val[1];
					}
				if($row[0] == $_SESSION['fname'])
					{
						
						echo "
						<br/>
						<table style=' width:80%;' align='right'>
							<tr>
								<td width='10%' style='text-align:left; font-size:9px;'>".$row[2]."</td>
								<td width='75%'><div class='item-x' style='font-family:Comic Sans MS; color:".$cur_txt."; background: ".$cur_bg."'><p>".$row[1]."</p></div></td>
								<td class='names' width='15%' style='text-align:left; font-family:Comic Sans MS; color:".$cur_txt."; '>".$row[0]."</td>
							</tr>
						</table>
						";
					}
					
					else
					{

					echo "
						
						<table style=' width:80%;' align='left'>
							<tr>
								<td class='names' width='15%' style='text-align:right; font-family:Comic Sans MS; color:".$cur_txt."; '>".$row[0].":</td>
								<td width='75%'><div class='item' style='font-family:Comic Sans MS; color:".$cur_txt."; background: ".$cur_bg."'>&nbsp;".$row[1]."</div></td>
								<td width='10%' style='text-align:right; font-size:9px;'>".$row[2]."</td>
							</tr>
						</table>
						";

					}

				}
			?>

</body>
</html>

<style>
.names
{
	padding-top:5px;
}

body
{
	background:blue;
	color:white;
}

.item
{
	
	text-align:left;
	
	max-width:95%;
	min-width:95%;
	min-height:30px;
	margin-top:17px;
	padding:5px;
	padding-top:-10px;
	border-radius:5px;
}

.item-x
{
	
	text-align:right;
	position:right;
	max-width:95%;
	min-width:95%;
	min-height:30px;
	margin-top:17px;
	padding:5px;
	padding-top:-10px;
	border-radius:5px;
}

.item2
{
	color:white;
	text-align:left;
	background:purple;
	max-width:95%;
	min-width:95%;
	min-height:30px;
	margin-top:17px;
	padding:5px;
	border-radius:5px;
}
</style>