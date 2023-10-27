let menutoggle =document.querySelector(".menutoggle");
let sidebar =document.querySelector(".sidebar");
let content =document.querySelector(".content");

menutoggle.onclick = function () {
    $(sidebar).toggleClass('active');
    $(content).toggleClass('active');
}

$(document).ready(function () {
    $('#dataTable').DataTable();
});