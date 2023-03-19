<script src="../Assets/jquery-3.6.0.js"></script>
<link rel="stylesheet" href="../Assets/DataTables/datatables.css">
<script src="../Assets/DataTables/datatables.min.js"></script>

<!-- <script src="../Assets/DataTables/Buttons-2.2.3/js/dataTables.buttons.js"></script>
<script src="../Assets/DataTables/JSZip-2.5.0/jszip.js"></script>

<script src="../Assets/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
<script src="../Assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>



<script src="../Assets/DataTables/Buttons-2.2.3/js/buttons.dataTables.js"></script>

<script src="../Assets/DataTables/Buttons-2.2.3/js/buttons.html5.js"></script>
<script src="../Assets/DataTables/Buttons-2.2.3/js/buttons.print.js"></script>
<link rel="stylesheet" href="../Assets/DataTables/Buttons-2.2.3/css/buttons.dataTables.css"> -->



<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
           
            "ordering": false,

            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, 'All']
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });



        $('#myTables').DataTable({
            "ordering": false,

            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, 'All']
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    });
</script>