<?php
include conn.inc;
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
background-color: #F8F8FF;
}
.virsraksts {
  height: 48px;
  width: 226px;
  background-color: #DC143C;
  margin-left: 2cm;
  font-size: 14pt;
  color: #000000;
  padding:  0px 3px 0px 3px;
  border-style: solid;
  border-width: 0,2cm;
  border-color: #000000;
}
.info {
  height: 116px;
  width: 226px;
  background-color: #DC143C;
  margin-left: 2cm;
  font-size: 14pt;
  color: #000000;
  padding:  0px 3px 0px 3px;
  border-style: solid;
  border-width: 0,2cm;
  border-color: #000000;
}
.poga {
  width: 234px;
  background-color: #DC143C;
  font-size: 18pt;
  color: #000000;
  text-align: center;
  margin-left: 2cm;
  border-style: solid;
  border-width: 0,1cm;
  border-color: #000000;
  cursor: pointer;
}

</style>
</head>
<body>
<div class="virsraksts">Kop�got plnot�ju</div><br>
<div class="info">Tavs ID:<br><?php echo "uID"?><br>Kop�got ar:<br>
<input type="text" pattern="[0-9]{6}"></div><br>
<button class="poga" type="button">Meklet</button>
</html> 
<?php
//UPDATE plan_markuss SET uID = LPAD(FLOOR(RAND() * 999999.99), 6, '0');
?>