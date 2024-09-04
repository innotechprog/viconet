
 $('#add_staff').click(function() {
  var table = document.getElementById("scrollableTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  cell1.innerHTML = document.getElementById('staff_surname');
  cell2.innerHTML = document.getElementById('staff_name');
});