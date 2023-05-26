		function validateForm() {
		    let id = validatId(document.forms["myForm"]["id"]);
  			if(!id){
  				document.forms["myForm"]["id"].focus();
  				return false;
  			}
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
  			let city = validatName(document.forms["myForm"]["city"]);
  			if(!city){
 			    alert("שם העיר אינו תקין. הכנס בבקשה רק אותיות.");  		
 			    document.forms["myForm"]["city"].focus();
  				return false;
  			}
  			let street = validatName(document.forms["myForm"]["street"]);
  			if(!street){
  			     alert("שם הרחוב אינו תקין. הכנס בבקשה רק אותיות."); 
  				document.forms["myForm"]["street"].focus();
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
  			let date = validatDate(document.forms["myForm"]["birthday"].value);
                if (!date) {
                    document.forms["myForm"]["birthday"].focus();
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
        function validatDate(date) {
            if (date === "0000-00-00" || date==='') {
                window.alert("לא הזנת את תאריך יום ההולדת של התלמיד. הכנס בבקשה תאריך .");
                return false;
            }
            var today = new Date();
                today.setHours(0,0,0,0); // set time portion to 0

            var inputDate = new Date(date);
            if (inputDate > today) {
                window.alert("התאריך אינו תקין.");
                return false;
            }
            return true;
        }

