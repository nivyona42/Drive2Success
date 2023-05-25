function validateForm() {
		   
  			let Fname = validatName(document.forms["myForm"]["fname"]);
  			if(!Fname){
  			    alert("השם הפרטי אינו תקין .הכנס בבקשה רק אותיות.");
  				document.forms["myForm"]["fname"].focus();
  				return false;
  			}
  			let Lname = validatName(document.forms["myForm"]["lname"]);
  			if(!Lname){
                alert("שם המשפחה אינו תקין .הכנס בבקשה רק אותיות."); 	
                document.forms["myForm"]["lname"].focus();
  				return false;
  			}
  			 let id = validatId(document.forms["myForm"]["id"]);
  			if(!id){
  				document.forms["myForm"]["id"].focus();
  				return false;
  			}
  			let email = validateEmail(document.forms["myForm"]["email"].value);
    		if(!email){
    			window.alert("כתובת המייל אינה תקינה.");
  				document.forms["myForm"]["email"].focus();
  				return false;
  			}
  			let phone = validatePhoneNumber(document.forms["myForm"]["phone"].value);
  			if(!phone){
    			window.alert("מספר הטלפון אינו תקין.");
  				document.forms["myForm"]["phone"].focus();
  				return false;
  			}
  			let userName = validateUesrName(document.forms["myForm"]["userName"].value);
  			if(!userName){
    			window.alert("שם המשתמש אינו תקין. שם המשתמש צריך להכיל ספרות או אותיות בלבד");
  				document.forms["myForm"]["userName"].focus();
  				return false;
  			}
  			return true;

}
        function validatName(ToCheck){
  			var hebrewOrEnglishLettersRegex = /^[\u0590-\u05FFa-zA-Z\s]+$/;
 			if (!ToCheck.value.match(hebrewOrEnglishLettersRegex)) {
    			return false;
  			}
  			return true;
		}
		function validatId(id){
		    let digitRange=/^[0-9]+$/
			if (!id.value.match(digitRange) || id.value.length != 9) {
			    window.alert("מספר תעודת הזהות אינו תקין. המספר חייב להכיל 9 ספרות.");
				return false;
  			}
  			return true;
		}
		function validateEmail(email) {
    		let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   			return re.test(String(email).toLowerCase());
   		}
   		function validatePhoneNumber(phone){
  			let re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im
  			return re.test(phone);
        }
        function validateUesrName(userName){
            var hebrewEnglishAndNumbersRegex = /^[\u0590-\u05FFa-zA-Z0-9\s]+$/;
		    if (!userName.value.match(hebrewEnglishAndNumbersRegex)) {
		          	alert("שם המשתמש אינו תקין .הכנס בבקשה רק אותיות או מספרים.");
		            return false;
  			}
  			return true;
        }