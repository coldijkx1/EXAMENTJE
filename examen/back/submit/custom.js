$(document).ready(function(){
 
    showTable();
 
    $('#submit').click(function(){
        var form=$('#form').serialize();
        $.ajax({
            url:"add.php",
            method:"POST",
            data:form,
            success:function(){
                showTable();
                $('#form')[0].reset();
            } 
        });
    });
});
 
function showTable(){
    $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{
            fetch: 1,
        },
        success:function(data){
            $('#table').html(data);
        }
    });
}