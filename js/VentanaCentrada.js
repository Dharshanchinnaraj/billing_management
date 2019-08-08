function VentanaCentrada(theURL,winName,invoices, myWidth, myHeight, isCenter) { //v3.0
  if(window.screen)if(isCenter)if(isCenter=="true"){
    var myLeft = (screen.width-myWidth)/2;
    var myTop = (screen.height-myHeight)/2;
    invoices+=(invoices!='')?',':'';
    invoices+=',left='+myLeft+',top='+myTop;
  }
 
  window.open(theURL,'_blank',winName,invoices+((invoices!='')?',':'')+'width='+myWidth+',height='+myHeight);
  window.children.close();
}




function VentanaCentrada1(theURL,winName,invoices, myWidth, myHeight, isCenter) { //v3.0
alert('Data saved successfully');
  if(window.screen)if(isCenter)if(isCenter=="true"){
    var myLeft = (screen.width-myWidth)/2;
    var myTop = (screen.height-myHeight)/2;
    invoices+=(invoices!='')?',':'';
    invoices+=',left='+myLeft+',top='+myTop;
  }
 
  var win = window.open(theURL,'_blank',winName,invoices+((invoices!='')?',':'')+'width='+myWidth+',height='+myHeight);
  setTimeout(function () { win.close();}, 1000);
  //window.children.close();
}
