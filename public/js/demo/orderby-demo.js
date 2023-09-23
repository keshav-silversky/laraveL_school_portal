const { orderBy } = require("lodash");

$(document).ready(function () {
  $("#dataTable").DataTable();
  columnDefs: [{ targets: "created_at", type: "date" }], orderBy:[[0, "desc"]];
});
