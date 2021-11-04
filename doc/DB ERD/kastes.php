<?php
include conn.inc;

import java.io.FileWriter;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
public class DataBaseToJson {
   public static ResultSet RetrieveData() throws Exception {
      //Registering the Driver
      DriverManager.registerDriver(new com.mysql.jdbc.Driver());
      //Creating the Statement
      Statement stmt = con.createStatement();
      //Retrieving the records
      ResultSet rs = stmt.executeQuery("Select * from plan_markuss");
      return rs;
   }
   public static void main(String args[]) throws Exception {
      //Creating a JSONObject object
      JSONObject jsonObject = new JSONObject();
      //Creating a json array
      JSONArray array = new JSONArray();
      ResultSet rs = RetrieveData();
      //Inserting ResutlSet data into the json object
      while(rs.next()) {
         JSONObject record = new JSONObject();
         //Inserting key-value pairs into the json object
         record.put("ID", rs.getInt("ID"));
         record.put("uID", rs.getString("uID"));
         record.put("lietotajs", rs.getString("lietotajs"));
         array.add(record);
      }
	}
}
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
<div class="virsraksts">Kopîgot plnotâju</div><br>
<div class="info">Tavs ID:<br><?php echo "uID"?><br>Kopîgot ar:<br>
<input type="text" pattern="[0-9]{6}"></div><br>
<button class="poga" type="button">Meklet</button>
</html> 
<?php
//UPDATE plan_markuss SET uID = LPAD(FLOOR(RAND() * 999999.99), 6, '0');
?>