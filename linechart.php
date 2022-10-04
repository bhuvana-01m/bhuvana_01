
<?php
$con=mysqli_connect('localhost','root','','reports');
$start="2022-09-09";
$end="2022-10-11";
$result = mysqli_query($con,"SELECT date,reading FROM report where date>='$start' and date<='$end'");
$dataPoints = array(array());
 while($row=mysqli_fetch_array($result))
 {
	$dataPoints[]=array("y" => $row["reading"], "label" => $row["date"]);	

	?>
	
<?php
 }

?>
<!DOCTYPE HTML>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

	<script>
        function CreatePDFfromHTML() {
    var HTML_Width = $(".charts").width();
    var HTML_Height = $(".charts").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".charts")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("report.pdf");
    
    });
}


  // create new pdf and add our new canvas as an image
 
  function pdf()
    {
    var doc=new jsPDF();
    var res=document.querySelector('#chartContainer');
    await CreatePDF({doc,res});
    doc.save("Report.pdf");
   
    console.log("jkasdfhjk");
    }

	</script>
<script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text:"Nellai Neervalam"
	},
	axisY: {
		title: "Values"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints,JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>       

</head>
<body>
<a href="report.php" >
                    <i class="fa fa-angle-left shadow-lg rounded" id="bars" style="border-radius:3px;background-color:whitesmoke;padding:11px;width:35px;margin-left:20px;margin-top:20px;font-size:56px;color:#1F2937;"></i>
                </a>

	<center>
<div id="chartContainer" class="charts" style="height: 370px; width: 350px;margin-top:5%"></div>
         <div style="margin-top:5%">
            <input type="Submit" onclick="pdf()" id="submit" class="shadow-lg rounded"  value="Export" style="border-radius:3px;width:100px;border:none;height:30px;background-color:#1F2937;color:whitesmoke">
        </div>
</center>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>            
  