function validateForm() {
    let id = validatId(document.forms["myForm"]["id"]);
    if (!id) {
        document.forms["myForm"]["id"].focus();
        return false;
    }
    let date = validatDate(document.forms["myForm"]["date"].value);
    if (!date) {
        document.forms["myForm"]["date"].focus();
        return false;
    }
    let startTime = validatSTime(document.forms["myForm"]["startTime"].value);
    if (!startTime) {
        document.forms["myForm"]["startTime"].focus();
        return false;
    }
    let endTime = validatETime(document.forms["myForm"]["startTime"].value, document.forms["myForm"]["endTime"].value);
    if (!endTime) {
        document.forms["myForm"]["endTime"].focus();
        return false;
    }
    return true;
}

function validatId(id) {
    let digitRange = /^[0-9]+$/;
    if (!id.value.match(digitRange) || id.value.length != 9) {
        window.alert("מספר תעודת הזהות אינו תקין. המספר חייב להכיל 9 ספרות.");
        return false;
    }
    return true;
}

function validatDate(date) {
    if (date === "0000-00-00" || date === '') {
        window.alert("לא הזנת את תאריך המבחן. הכנס בבקשה תאריך .");
        return false;
    }
    var today = new Date();
    today.setHours(0,0,0,0); // set time portion to 0
    var inputDate = new Date(date);
    if (inputDate < today) {
        window.alert("התאריך אינו תקין");
        return false;
    }
    return true;
}

function validatSTime(time) {
    if (time === "00:00" || time === '') {
        window.alert("לא הזנת את שעת התחלת המבחן. הכנס בבקשה שעת התחלה .");
        return false;
    }
    return true;
}

function validatETime(Stime, Etime) {
    if (Etime === "00:00" || Etime === '') {
        window.alert("לא הזנת את שעת סיום המבחן. הכנס בבקשה שעת סיום .");
        return false;
    }
    if (Stime > Etime) {
        window.alert("שעת סיום המבחן אינה תקינה. שעת הסיום צריכה להיות מאוחרת יותר משעת ההתחלה .");
        return false;
    }
    return true;
}
