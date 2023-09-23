// const { orderBy } = require("lodash");

// Call the dataTables jQuery plugin
$(document).ready(function () {
    $("#dataTable").DataTable();
    columnDefs: [{ targets: "created_at", type: "date" }], orderBy:[[0, "desc"]];
});
