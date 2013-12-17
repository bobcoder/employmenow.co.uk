function validateEmail(email) { 
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}   

  function showWorkExp(eid) {
    document.getElementById('weditval').value = eid;
    document.getElementById('grpWorkExp').style.display = 'block'; 
    if(eid != "-1") {
      var wxv = document.getElementById('workexp').value;
      var wxtmp = wxv.split('|');
      for(x = 0; x < wxtmp.length-1; x++) {      
        w = wxtmp[x].split(';');
        if(w[0] == eid) {
	  document.getElementById('companyname').value = w[1];
	  document.getElementById('description').value = w[4];
          if (w[5] == 'true')
              {
                  $('input[name=present]').attr('checked', true);

              }
	  dbits = w[2].split('-');
	  for(i=0;i<document.getElementById('startyear').length;i++) {	    
	    if(document.getElementById('startyear').options[i].value == dbits[0]) break;
	  }	  
          document.getElementById('startyear').options.selectedIndex = i;
	  for(i=0;i<document.getElementById('startmonth').length;i++) {
	    if(document.getElementById('startmonth').options[i].value == dbits[1]) break;
	  }
          document.getElementById('startmonth').options.selectedIndex = i;	  
	  
	  dbits = w[3].split('-');
	  for(i=0;i<document.getElementById('endyear').length;i++) {
	    if(document.getElementById('endyear').options[i].value == dbits[0]) break;
	  }
          document.getElementById('endyear').options.selectedIndex = i;
	  for(i=0;i<document.getElementById('endmonth').length;i++) {
	    if(document.getElementById('endmonth').options[i].value == dbits[1]) break;
	  }
          document.getElementById('endmonth').options.selectedIndex = i;
          
	}
      }      
    }
    return false;
  }
  
  function addWorkExp() {
    if(document.getElementById('weditval').value == "-1") {
      var companyname = document.getElementById('companyname').value;
      var startdate = document.getElementById('startyear').value + '-' + document.getElementById('startmonth').value;
      var enddate = document.getElementById('endyear').value + '-' + document.getElementById('endmonth').value;    
      var present = 'false';
      if ($('input[name=present]').is(':checked'))
          {
          present = 'true';
          }

      var desc = document.getElementById('description').value;
      var uid = new Date().getTime();
      var wx = uid + ';' + companyname + ';' + startdate + ';' + enddate + ';' + desc + ';' + present + '|';    
      document.getElementById('workexp').value = document.getElementById('workexp').value + wx;
      document.getElementById('grpWorkExp').style.display = 'none';
      
      document.getElementById('companyname').value = '';
      document.getElementById('description').value = '';
      $("#startyear").val("1");
      $("#startmonth").val("2013");
      $("#endmonth").val("1");
      $("#endyear").val("2013");
      $('input[name=present]').prop('checked', false);
      
      writeWorkExpText(document.getElementById('workexp').value);
    }
    else editWorkExp(document.getElementById('weditval').value);
    return false;
  }
  
  function removeWorkExp(uid) {
    var wxv = document.getElementById('workexp').value;
    var wxtmp = wxv.split('|');
    var newval = '';
    for(x = 0; x < wxtmp.length-1; x++) {      
      w = wxtmp[x].split(';');
      if(w[0] != uid) newval = newval + wxtmp[x] + '|';
    }
    document.getElementById('workexp').value = newval;
    writeWorkExpText(newval);    
    return false;
  }
  
  function editWorkExp(uid) {
    var companyname = document.getElementById('companyname').value;
    var startdate = document.getElementById('startyear').value + '-' + document.getElementById('startmonth').value;
    var enddate = document.getElementById('endyear').value + '-' + document.getElementById('endmonth').value;
    var present = 'false';
      if ($('input[name=present]').is(':checked'))
          {
          present = 'true';
          }
    var desc = document.getElementById('description').value;
    var wxv = document.getElementById('workexp').value;
    var wx = uid + ';' + companyname + ';' + startdate + ';' + enddate + ';' + desc + ';' + present + '|';    
    var newval = '';
    var wxtmp = wxv.split('|');
    for(x = 0; x < wxtmp.length-1; x++) {      
      w = wxtmp[x].split(';');
      if(w[0] != uid) newval = newval + wxtmp[x] + '|';    
      else newval = newval + wx;
    }
    document.getElementById('workexp').value = newval;    
    writeWorkExpText(newval);    
    document.getElementById('weditval').value = "-1";
    document.getElementById('grpWorkExp').style.display = 'none';
    return false;    
  }
  
  function writeWorkExpText(wx) {
    document.getElementById('workexpedit').innerHTML = '&nbsp;';
    wxtmp = wx.split('|');
    for(x = 0; x < wxtmp.length-1; x++) {
      w = wxtmp[x].split(';');   
      document.getElementById('workexpedit').innerHTML = document.getElementById('workexpedit').innerHTML + '<p>'+w[1]+' <a href="#" onclick="return removeWorkExp(\''+w[0]+'\');">Remove</a> <a href="#" onclick="return showWorkExp(\''+w[0]+'\');">Edit</a></p>';
    }          

  }
  
  function showEducation(eid) {
    document.getElementById('eeditval').value = eid;
    document.getElementById('grpEducation').style.display = 'block'; 
    if(eid != "-1") {
      var wxv = document.getElementById('education').value;
      var wxtmp = wxv.split('|');
      for(x = 0; x < wxtmp.length-1; x++) {      
        w = wxtmp[x].split(';');
        if(w[0] == eid) {
	  document.getElementById('schoolname').value = w[1];
	  document.getElementById('grades').value = w[4];
	  dbits = w[2].split('-');
	  for(i=0;i<document.getElementById('estartyear').length;i++) {	    
	    if(document.getElementById('estartyear').options[i].value == dbits[0]) break;
	  }	  
          document.getElementById('estartyear').options.selectedIndex = i;
	  for(i=0;i<document.getElementById('estartmonth').length;i++) {
	    if(document.getElementById('estartmonth').options[i].value == dbits[1]) break;
	  }
          document.getElementById('estartmonth').options.selectedIndex = i;	  
	  
	  dbits = w[3].split('-');
	  for(i=0;i<document.getElementById('eendyear').length;i++) {
	    if(document.getElementById('eendyear').options[i].value == dbits[0]) break;
	  }
          document.getElementById('eendyear').options.selectedIndex = i;
	  for(i=0;i<document.getElementById('eendmonth').length;i++) {
	    if(document.getElementById('eendmonth').options[i].value == dbits[1]) break;
	  }
          document.getElementById('eendmonth').options.selectedIndex = i;	  
	}
      }       
    }
    return false;
  }
  
  function addEducation() {
    //alert(document.getElementById('eeditval').value);
    if(document.getElementById('eeditval').value == "-1") {
      var schoolname = document.getElementById('schoolname').value;
      var startdate = document.getElementById('estartyear').value + '-' + document.getElementById('estartmonth').value;
      var enddate = document.getElementById('eendyear').value + '-' + document.getElementById('eendmonth').value;    
      var grades = document.getElementById('grades').value;
      var uid = new Date().getTime();
      var wx = uid + ';' + schoolname + ';' + startdate + ';' + enddate + ';' + grades + '|';    
      document.getElementById('education').value = document.getElementById('education').value + wx;
      document.getElementById('grpEducation').style.display = 'none';
      writeEducationText(document.getElementById('education').value);
    }
    else editEducation(document.getElementById('eeditval').value);
    return false;
  }
  
  function editEducation(uid) {
    var companyname = document.getElementById('schoolname').value;
    var startdate = document.getElementById('estartyear').value + '-' + document.getElementById('estartmonth').value;
    var enddate = document.getElementById('eendyear').value + '-' + document.getElementById('eendmonth').value;    
    var grades = document.getElementById('grades').value;    
    var wx = uid + ';' + companyname + ';' + startdate + ';' + enddate + ';' + grades + '|';
    var wxv = document.getElementById('education').value;
    var wxtmp = wxv.split('|');
    var newval = ''; 
    for(x = 0; x < wxtmp.length-1; x++) {      
      w = wxtmp[x].split(';');
      if(w[0] != uid) newval = newval + wxtmp[x] + '|';
      else newval = newval + wx;
    }
    document.getElementById('education').value = newval;
    document.getElementById('grpEducation').style.display = 'none';
    writeEducationText(newval);    
    return false;    
  }
  
  function removeEducation(uid) {
    var wxv = document.getElementById('education').value;
    var wxtmp = wxv.split('|');
    var newval = '';
    for(x = 0; x < wxtmp.length-1; x++) {      
      w = wxtmp[x].split(';');
      if(w[0] != uid) newval = newval + wxtmp[x] + '|';
    }
    document.getElementById('education').value = newval;
    writeEducationText(newval);    
    return false;
  }
  
  function writeEducationText(wx) {
    document.getElementById('eduedit').innerHTML = '&nbsp;';
    wxtmp = wx.split('|');
    for(x = 0; x < wxtmp.length-1; x++) {
      w = wxtmp[x].split(';');   
      document.getElementById('eduedit').innerHTML = document.getElementById('eduedit').innerHTML + '<p>'+w[1]+' <a href="#" onclick="return removeEducation(\''+w[0]+'\');">Remove</a> <a href="#" onclick="return showEducation(\''+w[0]+'\');">Edit</a></p>';
    }          
  }    
  