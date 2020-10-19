/**
 * Establishment Division
 * Department of Agriculture
 * 
 * Js functions 
 */


/*
 * update the appoinment date input value same as assignment date
 * and increment month and date input also
 */

 function changeAppointmentDate(assignmentDate) {
     var appointment_date_input = document.getElementById("appointment_date");
     appointment_date_input.value = assignmentDate;
     changeIncrementDate(assignmentDate);
 }
 
/*
 * update the increment date input value in MM-DD format on appointment date input change
 */

 function changeIncrementDate(appointmentDate) {
     var appointment_date = new Date(appointmentDate);
     var month = appointment_date.getUTCMonth() + 1; //months from 1-12
     var day = appointment_date.getUTCDate();
     var month_day = month +"-"+ day;
     var increment_date_input = document.getElementById("increment_date");
     increment_date_input.value = month_day;
 }


 /* add new input to appraisee_list */
 function addAppraiseeInput() {
	 
	 var table = document.getElementById("appraisee_list");
	 var rows_count = table.rows.length;
	 var row = table.insertRow(rows_count);
	 var cell1 = row.insertCell(0);
	 var cell2 = row.insertCell(1);
	 cell1.innerHTML = "<input type='text' placeholder='ජාතික හැදුනුම්‍පත් අංකය' class='form-control' name='appraisee[]'>";
	 cell2.innerHTML = "<button type='button' onClick='deleteAppraiseeInput()'>Delete row</button>";
 }
 