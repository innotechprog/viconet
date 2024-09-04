<?php 
include "include/connect.php";
include "head.php";
include "include/functions.php";
$webinar = new Webinars($db);
$output ="";
$query3 = $webinar->getContent($_POST['id']);
		for ($i=0; $rww = $query3->fetch() ; $i++) { 
		
		$output .='<h5 class="text-center">'.$rww["author_name"].'</h5>
		<h5 class="text-center">Presentation & Recordings</h5>
		<div class="webinar-article">
			<div class="webinar-title text-center">
				<label class="l-14 " title="Title">Lessons learned during the COVID-19 crisis</label>
			</div>
			<hr>
			<div class="webinar-downloads">
				<div class="webinar-rec">
					<a href="audio?id='.$rww["rec_file"].'"><img src="img/pdf-pic.svg"></a>
				</div>
				<div class="webinar-pdf">
					<a  href="portal/webinars/pdf/'.$rww["pdf_file"].'"><img src="img/audio-pic.svg"></a>
				</div>
			</div>
		</div>';
	
		}

echo $output;

?>