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