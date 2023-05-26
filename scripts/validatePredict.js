function validateForm() {
    let id = validatId(document.forms["myForm"]["id"]);
    if (!id) {
        document.forms["myForm"]["id"].focus();
        return false;
    }
    let grade = validatGrade(document.forms["myForm"]["grade"]);
    if (!grade) {
        document.forms["myForm"]["grade"].focus();
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
function validatGrade(grade) {
  let number = parseInt(grade.value, 10);
  if (number < 1 || number > 10) {
    window.alert("הציון אינו תקין. הציון חייב להיות מספר בין 1 ל-10.");
    return false;
  }
  return true;
}