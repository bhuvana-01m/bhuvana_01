
<?php 

session_start();
$value=$_SESSION['r'];
$head=$_SESSION['l'];
?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <style>
          .head{
            text-align: center;
            margin-top:60px;
          }
          .card{
            align-items:center;
            width: 500px;
            top: 15%;
            left: 33%;
            height: 300px;
            padding: 60px;
          }
            .gauge {
  width: 100%;
  max-width: 250px;
  font-family: "Roboto", sans-serif;
  font-size: 32px;
  color: #004033;
}

.gauge__body {
  width: 100%;
  height: 0;
  padding-bottom: 50%;
  background: #b4c0be;
  position: relative;
  border-top-left-radius: 100% 200%;
  border-top-right-radius: 100% 200%;
  overflow: hidden;
}
#bars{
                font-size: 30px;
                color:#1F2937;
                
            }
.gauge__fill {
  position: absolute;
  top: 100%;
  left: 0;
  width: inherit;
  height: 100%;
  background: #009578;
  transform-origin: center top;
  transform: rotate(0.25turn);
  transition: transform 0.2s ease-out;
}

.gauge__cover {
  width: 75%;
  height: 150%;
  background: #ffffff;
  border-radius: 50%;
  position: absolute;
  top: 25%;
  left: 50%;
  transform: translateX(-50%);

  /* Text */
  display: flex;
  align-items: center;
  justify-content: center;
  padding-bottom: 25%;
  box-sizing: border-box;
}

            </style>
    </head>
<body>
<a href="#" onclick="back()">
                    <i class="fa fa-angle-left shadow-lg" id="bars" style="padding:6px;width:38px;margin-left:20px;margin-top:20px;font-size:54px"></i>
                </a>

    <h1 class="head"><?=$head?></h1>
  <div class="card shadow rounded">
<div class="gauge">
    <div class="gauge__body">
      <div class="gauge__fill"></div>
      <div class="gauge__cover"></div>
    </div>
    <div class="val" style="text-align:center;margin-top:25px;">
  </div>
  </div>

</div>



<script> 
  
    var reads='<?=$value?>';
        console.log(reads);
        var value=parseFloat(reads); 
        const gaugeElement = document.querySelector(".gauge"); 

    if(value<=0.4)
      {
        gaugeElement.querySelector('.gauge__fill').style.backgroundColor="blue";
        gaugeElement.querySelector('.val').innerHTML="LOW";
      }
    else if(value>=0.5 && value<=0.7)
      {
        gaugeElement.querySelector('.gauge__fill').style.backgroundColor="orange";
        gaugeElement.querySelector('.val').innerHTML="MEDIUM";

      }
    else if(value>=0.8)
    {
      gaugeElement.querySelector('.gauge__fill').style.backgroundColor="green";
      gaugeElement.querySelector('.val').innerHTML="HIGH";

    }

    gaugeElement.querySelector('.gauge__fill').style.transform = `rotate(${
    value / 2
  }turn)`;
  gaugeElement.querySelector('.gauge__cover').textContent = `${Math.round(
    value * 100
  )}%`;       
</script>
    <script>
      function back()
      {
        window.history.go(-1);
      }
      </script>
</body>
    </html>
