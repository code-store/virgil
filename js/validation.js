function validateForm(){
	
	var form_name 		  = document.getElementById("form_name");
	var form_url  		  = document.getElementById("form_url");
	var form_description  = document.getElementById("form_description");
	var mail_to           = document.getElementById("mail_to"); 
	var sidebar_size      = document.getElementById("sidebar_size"); 
	
	
			if(form_name.value == ''){
			alert("Please Enter a Form Name");
			form_name.focus();
			return false;
			}
			
			if(form_name.value == 'Enter form name'){
			alert("Please Enter a Form Name");
			form_name.focus();
			return false;
			}
			
			if(form_url.value == ''){
			alert("Please Enter a Form URL");
			form_url.focus();
			return false;
			}
			
			if(form_url.value == 'Url is used to show this form in frontend'){
			alert("Please Enter a Form URL");
			form_url.focus();
			return false;
			}
			
	if(document.getElementById("tr_mail_to").style.display!='none'){
			if(mail_to.value == ''){
			alert("Please Enter a Valid Email Address");
			mail_to.focus();
			return false;
			}
			
			if(mail_to.value == 'Enter email where need to send'){
			alert("Please Enter a Valid Email Address");
			mail_to.focus();
			return false;
			}			
	  }	
	if(document.getElementById("tr_sidebar_size").style.display!='none'){
			if(sidebar_size.value == ''){
			alert("Please Enter sidebar size");
			sidebar_size.focus();
			return false;
			}
			
			if(sidebar_size.value == 'Enter sidebar size' || isNaN(sidebar_size.value)){
			alert("Please Enter valid sidebar size");
			sidebar_size.focus();
			return false;
			}			
	  }  
	
	return true;
	}
	
function validateFieldset(){
			
			var fieldset_name  = document.getElementById("fieldset_name");
			
			if(fieldset_name.value == 'Enter fieldset name'){
			alert("Please Enter a Fieldset Name");
			fieldset_name.focus();
			return false;
			}
			
			if(fieldset_name.value == ''){
			alert("Please Enter a Fieldset Name");
			fieldset_name.focus();
			return false;
			}
	
	
		return true;
	}
	
function validateNewfield(){
			
			var field_label  = document.getElementById("field_label");
			var field_name  = document.getElementById("field_name");
			
			if(field_label.value == 'Enter field label'){
			alert("Please Enter field label");
			field_label.focus();
			return false;
			}
			
			if(field_label.value == ''){
			alert("Please Enter a Field label");
			fieldset_name.focus();
			return false;
			}
			
	        if(field_name.value == 'Enter field name'){
			alert("Please Enter field Name");
			field_name.focus();
			return false;
			}
			
			if(field_name.value == ''){
			alert("Please Enter a Fieldset Name");
			field_name.focus();
			return false;
			}
	
		return true;
	}
	
function validateEditFieldset(fieldsetId){
			
			var fieldset_name  = document.getElementById("fieldset_name_"+fieldsetId);			
			if(fieldset_name.value == 'Enter fieldset name'){
			alert("Please Enter a Fieldset Name");
			fieldset_name.focus();
			return false;
			}
			
			if(fieldset_name.value == ''){
			alert("Please Enter a Fieldset Name");
			fieldset_name.focus();
			return false;
			}
	
	
		return true;
	}
function validateEditfield(fieldId){
			
			var field_label  = document.getElementById("field_label_"+fieldId);
			var field_name  = document.getElementById("field_name_"+fieldId);
			
			if(field_label.value == 'Enter field label'){
			alert("Please Enter field label");
			field_label.focus();
			return false;
			}
			
			if(fieldset_label.value == ''){
			alert("Please Enter a Fieldset label");
			field_label.focus();
			return false;
			}
			
	        if(field_name.value == 'Enter field name'){
			alert("Please Enter field Name");
			field_name.focus();
			return false;
			}
			
			if(field_name.value == ''){
			alert("Please Enter a Fieldset Name");
			field_name.focus();
			return false;
			}
	
	
		return false;
	}		