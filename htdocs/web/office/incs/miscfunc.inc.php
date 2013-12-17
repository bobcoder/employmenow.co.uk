<?php
  function dumpDays($selected) {
    for($x=1;$x<32;$x++) echo "<option value=\"$x\"".($x==$selected?" selected":"").">$x</option>";
  }
  
  function dumpMonths($selected) {
    for($x=1;$x<13;$x++) echo "<option value=\"$x\"".($x==$selected?" selected":"").">".date("F",mktime(0, 0, 0, $x, 1, 2000))."</option>";
  }
  
  function dumpYears($range,$selected) {
    $thisYear = date('Y', strtotime('+1 year'));
    if($range > +1) $startYear = $thisYear - $range;
    else {
      $startYear = $thisYear;
    }
    for($x=$startYear;$x<$thisYear;$x++) echo "<option value=\"$x\"".($x==$selected?" selected":"").">$x</option>";
  }
  
  function dumpCounties($selected) {
    echo "    <select name=\"county\" id=\"county\">";
    echo "    <optgroup label=\"England\">";
    echo "    <option".($selected=="Bedfordshire"?" selected":"").">Bedfordshire</option>";
    echo "    <option".($selected=="Berkshire"?" selected":"").">Berkshire</option>";
    echo "    <option".($selected=="Bristol"?" selected":"").">Bristol</option>";
    echo "    <option".($selected=="Buckinghamshire"?" selected":"").">Buckinghamshire</option>";
    echo "    <option".($selected=="Cambridgeshire"?" selected":"").">Cambridgeshire</option>";
    echo "    <option".($selected=="Cheshire"?" selected":"").">Cheshire</option>";
    echo "    <option".($selected=="City of London"?" selected":"").">City of London</option>";
    echo "    <option".($selected=="Cornwall"?" selected":"").">Cornwall</option>";
    echo "    <option".($selected=="Cumbria"?" selected":"").">Cumbria</option>";
    echo "    <option".($selected=="Derbyshire"?" selected":"").">Derbyshire</option>";
    echo "    <option".($selected=="Devon"?" selected":"").">Devon</option>";
    echo "    <option".($selected=="Dorset"?" selected":"").">Dorset</option>";
    echo "    <option".($selected=="Durham"?" selected":"").">Durham</option>";
    echo "    <option".($selected=="East Riding of Yorkshire"?" selected":"").">East Riding of Yorkshire</option>";
    echo "    <option".($selected=="East Sussex"?" selected":"").">East Sussex</option>";
    echo "    <option".($selected=="Essex"?" selected":"").">Essex</option>";
    echo "    <option".($selected=="Gloucestershire"?" selected":"").">Gloucestershire</option>";
    echo "    <option".($selected=="Greater London"?" selected":"").">Greater London</option>";
    echo "    <option".($selected=="Greater Manchester"?" selected":"").">Greater Manchester</option>";
    echo "    <option".($selected=="Hampshire"?" selected":"").">Hampshire</option>";
    echo "    <option".($selected=="Herefordshire"?" selected":"").">Herefordshire</option>";
    echo "    <option".($selected=="Hertfordshire"?" selected":"").">Hertfordshire</option>";
    echo "    <option".($selected=="Isle of Wight"?" selected":"").">Isle of Wight</option>";
    echo "    <option".($selected=="Kent"?" selected":"").">Kent</option>";
    echo "    <option".($selected=="Lancashire"?" selected":"").">Lancashire</option>";
    echo "    <option".($selected=="Leicestershire"?" selected":"").">Leicestershire</option>";
    echo "    <option".($selected=="Lincolnshire"?" selected":"").">Lincolnshire</option>";
    echo "    <option".($selected=="Merseyside"?" selected":"").">Merseyside</option>";
    echo "    <option".($selected=="Norfolk"?" selected":"").">Norfolk</option>";
    echo "    <option".($selected=="North Yorkshire"?" selected":"").">North Yorkshire</option>";
    echo "    <option".($selected=="Northamptonshire"?" selected":"").">Northamptonshire</option>";
    echo "    <option".($selected=="Northumberland"?" selected":"").">Northumberland</option>";
    echo "    <option".($selected=="Nottinghamshire"?" selected":"").">Nottinghamshire</option>";
    echo "    <option".($selected=="Oxfordshire"?" selected":"").">Oxfordshire</option>";
    echo "    <option".($selected=="Rutland"?" selected":"").">Rutland</option>";
    echo "    <option".($selected=="Shropshire"?" selected":"").">Shropshire</option>";
    echo "    <option".($selected=="Somerset"?" selected":"").">Somerset</option>";
    echo "    <option".($selected=="South Yorkshire"?" selected":"").">South Yorkshire</option>";
    echo "    <option".($selected=="Staffordshire"?" selected":"").">Staffordshire</option>";
    echo "    <option".($selected=="Suffolk"?" selected":"").">Suffolk</option>";
    echo "    <option".($selected=="Surrey"?" selected":"").">Surrey</option>";
    echo "    <option".($selected=="Tyne and Wear"?" selected":"").">Tyne and Wear</option>";
    echo "    <option".($selected=="Warwickshire"?" selected":"").">Warwickshire</option>";
    echo "    <option".($selected=="West Midlands"?" selected":"").">West Midlands</option>";
    echo "    <option".($selected=="West Sussex"?" selected":"").">West Sussex</option>";
    echo "    <option".($selected=="West Yorkshire"?" selected":"").">West Yorkshire</option>";
    echo "    <option".($selected=="Wiltshire"?" selected":"").">Wiltshire</option>";
    echo "    <option".($selected=="Worcestershire"?" selected":"").">Worcestershire</option>";
    echo "    </optgroup>";
    echo "    <optgroup label=\"Wales\">";
    echo "    <option".($selected=="Anglesey"?" selected":"").">Anglesey</option>";
    echo "    <option".($selected=="Brecknockshire"?" selected":"").">Brecknockshire</option>";
    echo "    <option".($selected=="Caernarfonshire"?" selected":"").">Caernarfonshire</option>";
    echo "    <option".($selected=="Carmarthenshire"?" selected":"").">Carmarthenshire</option>";
    echo "    <option".($selected=="Cardiganshire"?" selected":"").">Cardiganshire</option>";
    echo "    <option".($selected=="Denbighshire"?" selected":"").">Denbighshire</option>";
    echo "    <option".($selected=="Flintshire"?" selected":"").">Flintshire</option>";
    echo "    <option".($selected=="Glamorgan"?" selected":"").">Glamorgan</option>";
    echo "    <option".($selected=="Merioneth"?" selected":"").">Merioneth</option>";
    echo "    <option".($selected=="Monmouthshire"?" selected":"").">Monmouthshire</option>";
    echo "    <option".($selected=="Montgomeryshire"?" selected":"").">Montgomeryshire</option>";
    echo "    <option".($selected=="Pembrokeshire"?" selected":"").">Pembrokeshire</option>";
    echo "    <option".($selected=="Radnorshire"?" selected":"").">Radnorshire</option>";
    echo "    </optgroup>";
    echo "    <optgroup label=\"Scotland\">";
    echo "    <option".($selected=="Aberdeenshire"?" selected":"").">Aberdeenshire</option>";
    echo "    <option".($selected=="Angus"?" selected":"").">Angus</option>";
    echo "    <option".($selected=="Argyllshire"?" selected":"").">Argyllshire</option>";
    echo "    <option".($selected=="Ayrshire"?" selected":"").">Ayrshire</option>";
    echo "    <option".($selected=="Banffshire"?" selected":"").">Banffshire</option>";
    echo "    <option".($selected=="Berwickshire"?" selected":"").">Berwickshire</option>";
    echo "    <option".($selected=="Buteshire"?" selected":"").">Buteshire</option>";
    echo "    <option".($selected=="Cromartyshire"?" selected":"").">Cromartyshire</option>";
    echo "    <option".($selected=="Caithness"?" selected":"").">Caithness</option>";
    echo "    <option".($selected=="Clackmannanshire"?" selected":"").">Clackmannanshire</option>";
    echo "    <option".($selected=="Dumfriesshire"?" selected":"").">Dumfriesshire</option>";
    echo "    <option".($selected=="Dunbartonshire"?" selected":"").">Dunbartonshire</option>";
    echo "    <option".($selected=="East Lothian"?" selected":"").">East Lothian</option>";
    echo "    <option".($selected=="Fife"?" selected":"").">Fife</option>";
    echo "    <option".($selected=="Inverness-shire"?" selected":"").">Inverness-shire</option>";
    echo "    <option".($selected=="Kincardineshire"?" selected":"").">Kincardineshire</option>";
    echo "    <option".($selected=="Kinross"?" selected":"").">Kinross</option>";
    echo "    <option".($selected=="Kirkcudbrightshire"?" selected":"").">Kirkcudbrightshire</option>";
    echo "    <option".($selected=="Lanarkshire"?" selected":"").">Lanarkshire</option>";
    echo "    <option".($selected=="Midlothian"?" selected":"").">Midlothian</option>";
    echo "    <option".($selected=="Morayshire"?" selected":"").">Morayshire</option>";
    echo "    <option".($selected=="Nairnshire"?" selected":"").">Nairnshire</option>";
    echo "    <option".($selected=="Orkney"?" selected":"").">Orkney</option>";
    echo "    <option".($selected=="Peeblesshire"?" selected":"").">Peeblesshire</option>";
    echo "    <option".($selected=="Perthshire"?" selected":"").">Perthshire</option>";
    echo "    <option".($selected=="Renfrewshire"?" selected":"").">Renfrewshire</option>";
    echo "    <option".($selected=="Ross-shire"?" selected":"").">Ross-shire</option>";
    echo "    <option".($selected=="Roxburghshire"?" selected":"").">Roxburghshire</option>";
    echo "    <option".($selected=="Selkirkshire"?" selected":"").">Selkirkshire</option>";
    echo "    <option".($selected=="Shetland"?" selected":"").">Shetland</option>";
    echo "    <option".($selected=="Stirlingshire"?" selected":"").">Stirlingshire</option>";
    echo "    <option".($selected=="Sutherland"?" selected":"").">Sutherland</option>";
    echo "    <option".($selected=="West Lothian"?" selected":"").">West Lothian</option>";
    echo "    <option".($selected=="Wigtownshire"?" selected":"").">Wigtownshire</option>";
    echo "    </optgroup>";
    echo "    <optgroup label=\"Northern Ireland\">";
    echo "    <option".($selected=="Antrim"?" selected":"").">Antrim</option>";
    echo "    <option".($selected=="Armagh"?" selected":"").">Armagh</option>";
    echo "    <option".($selected=="Down"?" selected":"").">Down</option>";
    echo "    <option".($selected=="Fermanagh"?" selected":"").">Fermanagh</option>";
    echo "    <option".($selected=="Londonderry"?" selected":"").">Londonderry</option>";
    echo "    <option".($selected=="Tyrone"?" selected":"").">Tyrone</option>";
    echo "    </optgroup>";
    echo "    </select>  ";
  }  
 
  
  function dumpHow($selected) {
    echo "    <select name=\"how\" id=\"how\">";
	    echo "    <option".($selected=="None"?" selected":"").">Please Select...</option>";

    echo "    <option".($selected=="Google"?" selected":"").">Google</option>";
    echo "    <option".($selected=="Facebook"?" selected":"").">Facebook</option>";
    echo "    <option".($selected=="Twitter"?" selected":"").">Twitter</option>";
       echo "    <option".($selected=="Linkedin"?" selected":"").">Linkedin</option>";
	       echo "    <option".($selected=="Magazine or Newspaper"?" selected":"").">Magazine or Newspaper</option>";

    echo "    <option".($selected=="Radio"?" selected":"").">Radio</option>";
	
	    echo "    <option".($selected=="Other"?" selected":"").">Other</option>";


    echo "    </select>  ";
  }
  
  

  function dumpSalaries($selected,$min,$max,$step) {

    echo "<option value=\"0-15000\"".($selected=="0-15000"?" selected":"").">up to &pound;15,000</option>";
    echo "<option value=\"15001-20000\"".($selected=="15001-20000"?" selected":"").">&pound;15,000 to &pound;20,000</option>";
    echo "<option value=\"20001-25000\"".($selected=="20001-25000"?" selected":"").">&pound;20,000 to &pound;25,000</option>";
    echo "<option value=\"25001-30000\"".($selected=="25001-30000"?" selected":"").">&pound;25,000 to &pound;30,000</option>";
    echo "<option value=\"30001-35000\"".($selected=="30001-35000"?" selected":"").">&pound;30,000 to &pound;35,000</option>";
    echo "<option value=\"35001-40000\"".($selected=="35001-40000"?" selected":"").">&pound;35,000 to &pound;40,000</option>";
    echo "<option value=\"40001-50000\"".($selected=="40001-50000"?" selected":"").">&pound;40,000 to &pound;50,000</option>";
    echo "<option value=\"50001-60000\"".($selected=="50001-60000"?" selected":"").">&pound;50,000 to &pound;60,000</option>";
    echo "<option value=\"60001-70000\"".($selected=="60001-70000"?" selected":"").">&pound;60,000 to &pound;70,000</option>";    
    echo "<option value=\"70001-10000000\"".($selected=="70001-10000000"?" selected":"").">&pound;70,000 and above</option>\n";
  }
  
  function getImageList($dir,$exts) {
    $files = array();                                                                                                                                                                                                                    
    $dp = opendir($dir);                                                                                                         
    while(($file = readdir($dp)) !== false) {
      $tmp = strtolower(pathinfo($file, PATHINFO_EXTENSION)); 
      if(/*is_file($file) && */in_array($tmp,$exts)) {
        $files[] = $file;
      }
    }
    return $files;  
  }
  
  function getLatLong($place) {
    $address = "United+Kingdom+".urlencode($place);
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=United+Kingdom";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $lat = $response_a->results[0]->geometry->location->lat;
    //echo "<br />";
    $long = $response_a->results[0]->geometry->location->lng;
    return array("lat" => $lat, "lon" => $long);
    //return "$lat|$long";
  }
   
?>