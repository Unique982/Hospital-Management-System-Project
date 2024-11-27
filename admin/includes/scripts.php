
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
     <!-- Bootstrap core JavaScript-->
     <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- a;lert box -->
   <script src=../assets/js/sweetalert.min.js></script> 
 <?php
 if(isset($_SESSION['alert']) && $_SESSION['alert']!='') {

    ?>
    <script>
swal({
  title: "<?php echo $_SESSION['alert'] ?>",
  icon: "<?php echo $_SESSION['alert_code'] ?>",
  button: "Done !",
});
</script>


    <?php
    unset($_SESSION['alert']);
     } 
    ?>

<script>
    $(document).ready(function (){
    $('.deletebtn').click(function(e){
        e.preventDefault();
        // console.log("hello");
        var delid = $(this).closest("tr").find('.delete_id').val();
        // console.log(delid);
        var deleteUrl = $(this).data('delete-url');
        
        swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
        type : "POST",
        url:deleteUrl,
        data:{
    "delete_btn_set":1,
    "delete_id":delid,
    },
        success: function(response) {
           
            swal("Data delete Successfully.",{
            icon:"success",
        }).then((value) => {
            location.reload();

});
  } 
});
    }
        
    });
    
});
});


</script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>
    <!-- <script>
   
    function confirmDetele(){
        if(confirm('Are you sure you want to delete')){
            document.getElementById('deleteForm').submit();
        }
    }
</script> -->


