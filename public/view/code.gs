function doGet() {
    return HtmlService.createHtmlOutputFromFile("index");
}
function getLoc(value) {
  var destId = FormApp.getActiveForm().getDestinationId() ;
  var ss = SpreadsheetApp.openById(destId) ;
  var respSheet = ss.getSheets()[0] ;
  var data = respSheet.getDataRange().getValues() ;
  var headers = data[0] ;
  var numColumns = headers.length ;
  var numResponses = data.length;
  var c=0; var d=0;
  
  var e=c + "," + d ;
   if (respSheet.getRange(1, numColumns).getValue()=="GeoAddress") {    
       respSheet.getRange(numResponses,numColumns-2).setValue(Utilities.formatDate(new Date(), "GMT-3", "dd/MM/yyyy HH:mm:ss"));
       respSheet.getRange(numResponses,numColumns-1).setValue(e);
       var response = Maps.newGeocoder().reverseGeocode(value[0], value[1]);
       f= response.results[0].formatted_address;
       respSheet.getRange(numResponses,numColumns).setValue(f);
     }
   else if (respSheet.getRange(1,numColumns).getValue()!="GeoAddress") {
       respSheet.getRange(1,numColumns+1).setValue("GeoStamp");
       respSheet.getRange(1,numColumns+2).setValue("GeoCode");
       respSheet.getRange(1,numColumns+3).setValue("GeoAddress");
  }
}