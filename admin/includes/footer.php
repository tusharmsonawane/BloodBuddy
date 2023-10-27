</div>
                </div>
            </div>
        </div>
    </div>
</div>



     <?php
         if(isset($_GET['logout'])){
            echo '<script>
                    swal({
                        title: "Ready To Leave",
                        text: "are you sure you want leave to page",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href="includes/adminfiles/logout";
                        } else {
                            window.location.href="index";
                        }
                    });
                  </script>';
         }
     ?>
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/pie.js"></script>
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        let MenuBtn =document.querySelector(".MenuBtn");
        let sidebar =document.querySelector(".sidebar");

        MenuBtn.onclick = function(){
          $(sidebar).toggleClass("active");
        }
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

    </script>
    <script>
            $("#searchbar").on("keyup",function(){ 
            var searchcontent = $(this).val();
            $.ajax({ 
                url: "includes/adminfiles/search",
                type: "POST",
                data: {search:searchcontent},
                success: function (data) {
                    $("#searchContent").html(data);
                }
            });
            });
    </script> 
</body>
</html>