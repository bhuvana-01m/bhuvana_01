<?php
      $dataPoints=array();
      $reads=array();
      
?>
<?php
$con=mysqli_connect('localhost','root','','reports');
$loc=$_GET['location'];
$sen=$_GET['sensors'];
$start=$_GET['startdate'];
$end=$_GET['enddate'];


$result = mysqli_query($con,"SELECT date,reading FROM report where date>='$start' and date<='$end'");
 while($row=mysqli_fetch_array($result))
 {
	$dataPoints[]=$row["date"];	
   $reads[]=$row["reading"];
 }

?>
<html>
   <head> 
      <title>report</title> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script> 
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>   
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
      <style>

         #bt{
            border:none; border-radius:4px;
            width:200px;
            height:34px;
            background-color:#1F2937;
            color:whitesmoke;
            font-size: 20px;
            margin-top:2%;
         }
        #bt:hover{
         color: #1F2937;
         border:#1F2937 solid 1px;
         background-color: whitesmoke;
        }
        </style>
      <script type="text/javascript">
      //console.log(document.reportings.startdate.value);
    window.onload=function(){
      
var chart_data = {
         labels:<?php echo json_encode($dataPoints); ?>,
         datasets: [
             {
                 fillColor: "whitesmoke",
                 strokeColor: "#1F2937",
                 pointColor: "#1F2937",
                 pointStrokeColor: "#1F2937",
                 pointHighlightFill: "#1F2937",
                 pointHighlightStroke: "#1F2937",
                 data: <?php echo json_encode($reads); ?>,
             }
         ]
}
//original canvas
var canvas = document.querySelector('#cool-canvas');
var context = canvas.getContext('2d');
new Chart(context).Line(chart_data);
//hidden canvas
var newCanvas = document.querySelector('#supercool-canvas');
newContext = newCanvas.getContext('2d');
var supercoolcanvas = new Chart(newContext).Line(chart_data);
supercoolcanvas.defaults.global = {
   scaleFontSize: 600
}
//add event listener to button
//donwload pdf from original canvas




    }
    function downloadPDF2() {
   var canvas = document.querySelector('#cool-canvas');
   var canvasImg = canvas.toDataURL("image/jpeg", 1.0);
   var doc = new jsPDF('landscape');
   doc.setFontSize(20);
   doc.text(15, 15, "Cool Chart");
   doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150 );
   doc.save('canvas.pdf');
 }
      </script> 
   </head> 
   
   <body>
   <a href="report.php" >
                    <i class="fa fa-angle-left shadow-lg rounded" id="bars" style="border-radius:5px;background-color:whitesmoke;padding:11px;width:35px;margin-left:20px;margin-top:20px;font-size:56px;color:#1F2937;"></i>
                </a> 
      <center>
   <div id="rep" style="margin-top:10%;">
      <div> 
         <canvas id="cool-canvas" width="600" height="300"></canvas> 
      </div> 
      <div style="height:0; width:0; overflow:hidden;"> 
         <canvas id="supercool-canvas" width="1200" height="600" style="background-color:white"></canvas> 
      </div> 
   </div>
      <input type="Submit"  value="Export" id="bt" class="shadow-lg rounded" onclick="downloadPDF2()"> 
   </center>
   </body>
</html>