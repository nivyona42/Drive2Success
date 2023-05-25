		function validateForm() {
		    let carID = validatId(document.forms["myForm"]["carID"]);
  			if(!carID){
  				document.forms["myForm"]["carID"].focus();
  				return false;
  			}
  			let company = validatName(document.forms["myForm"]["company"]);
  			if(!company){
  			    alert("החברה של כלי הרכב אינו תקין .הכנס בבקשה רק אותיות.");
  				document.forms["myForm"]["company"].focus();
  				return false;
  			}
  			let model = validatModel(document.forms["myForm"]["model"]);
  			if(!model){
  				document.forms["myForm"]["model"].focus();
  				return false;
  			}
  			let color = validatName(document.forms["myForm"]["color"]);
  			if(!color){
  			    alert("הצבע של כלי הרכב אינו תקין .הכנס בבקשה רק אותיות.");
  				document.forms["myForm"]["color"].focus();
  				return false;
  			}
  			let testDate = validatDate(document.forms["myForm"]["testDate"].value);
  			if(!testDate){
  				document.forms["myForm"]["testDate"].focus();
  				return false;
  			}
  			let insuranceDate = validatDate(document.forms["myForm"]["insuranceDate"].value);
  			if(!insuranceDate){
  				document.forms["myForm"]["insuranceDate"].focus();
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
		function validatModel(model){
		    var hebrewEnglishAndNumbersRegex = /^[\u0590-\u05FFa-zA-Z0-9\s]+$/;
		    if (!model.value.match(hebrewEnglishAndNumbersRegex)) {
		          	alert("המודל של כלי הרכב אינו תקין .הכנס בבקשה רק אותיות או מספרים.");
		            return false;
  			}
  			return true;
		}
		function validatDate(date) {
            if (date === "0000-00-00" || date==='') {
                window.alert("לא הזנת את תאריך פקיעת הביטוח\הטסט. הכנס בבקשה תאריך .");

                return false;
            }
            var today = new Date();
            today.setHours(0,0,0,0); // set time portion to 0

            var inputDate = new Date(date);
            if (inputDate < today) {
                window.alert("התאריך אינו תקין.");
                return false;
            }
            return true;
        }
		        
		function validatId(id){
		    let digitRange=/^[0-9]+$/
			if (!id.value.match(digitRange) || id.value.length != 8) {
			    window.alert("מספר הרכב אינו תקין. המספר חייב להכיל 8 ספרות.");
				return false;
  			}
  			return true;
		}

	
