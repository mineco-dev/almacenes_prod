function ajax_request(url,target,show) {  
  document.getElementById(target).innerHTML = 'Loading...';
  if (window.XMLHttpRequest) {
    req = new XMLHttpRequest();
    req.onreadystatechange = function() {ajaxDone(target,show);};
    req.open("GET", url, true);
    req.send(null);
    // IE/Windows ActiveX version
  } else if (window.ActiveXObject) {
    req = new ActiveXObject("Microsoft.XMLDOM");
    if (req) {
      req.onreadystatechange = function() {ajaxDone(target,show);};
      req.open("GET", url, true);
      req.send(null);
    }
  }
}
function ajaxDone(target,show) {
  if (req.readyState == 4) {
    if (req.status == 200 || req.status == 304) {
      results = req.responseText;
        if (show==true){
            document.getElementById(target).innerHTML = results;
        }else{
            document.getElementById(target).innerHTML = "";
         }
    } else {
      document.getElementById(target).innerHTML="ajax error:\n" + req.statusText;
    }
  }
}

function hide(idX) {
    var browserType;
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }

  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("'+idX+'")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("'+idX+'")');
  else
     document.poppedLayer =   
        eval('document.layers["'+idX+'"]');
  document.poppedLayer.style.visibility = "hidden";
}

function show(idX) {
    var browserType;
    
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }

  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("'+idX+'")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("'+idX+'")');
  else
     document.poppedLayer = 
         eval('document.layers["'+idX+'"]');
  document.poppedLayer.style.visibility = "visible";
}

function bgr_color(obj, color) {
    obj.style.backgroundColor=color
}  
