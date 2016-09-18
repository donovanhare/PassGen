<!DOCTYPE html>

<html>
<head>
	<title>Password Generator</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<style type="text/css">
		* {
			font-family: 'Roboto Slab', serif;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="page-header">
		  <h1>Password Generator <small> </small></h1>
		</div>

		<div class="well" style="margin-top:2em; border-radius:0px; background-color:transparent;">
			<center>
				<h1 id="large-result">Loading...</h1>
			</center>

		</div>

		<div class="well" style="border-radius:0px;">
			<center id="buttons">
				<strong>Password:</strong> <input id="result" disabled>
				</br>
				</br>
				<div id="generate" class="btn btn-primary">Generate</div>
				<div id="copy" class="btn btn-success">Copy</div>
				<div id="print" class="btn btn-warning">Print</div>
			</center>
			<center id="time-box" hidden>
				<p style="font-size:10px;">Generated at:</p> <span id="time" style="font-size:10px;"></span>
			</center>
		</div>

		
	</div>
</body>

<script type="text/javascript">
	$( document ).ready(function() {

		function updateTime() {
			var d = new Date();
	  		$("#time").html(d.getTime());
		}

		function updateResult(data) {
			$( "#result" ).val( data );
	  		$("#large-result").html( data );
		}

		function generatePassword() {
			console.log( "Generating Password..." );
			$.get( "generatePassword.php", function( data ) {
		  		updateResult(data);
	  			updateTime();
			});
		}

	    generatePassword();

		$("#generate").click(function() {
			generatePassword();
		});

		$("#copy").click(function() {
			console.log( "Copied to clipboard!" );
			$("#result").prop("disabled",false);
			$("#result").select();
			document.execCommand("copy"); 
			document.getSelection().removeAllRanges();
			 $("#result").prop("disabled",true);
		});

		$("#print").click(function() {
			console.log( "Sent to printer!" );
			$("#buttons").hide();
			$(".page-header").hide();
			$("#time-box").show();

			window.print();

			$("#time-box").hide();
			$("#buttons").show();
			$(".page-header").show();
		});

	});
	
</script>
</html>