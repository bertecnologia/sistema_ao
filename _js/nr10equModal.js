$(document).ready(function(){
    $(document).on('click', '#getEmployee', function(e){
        e.preventDefault();
        var id_Equi = $(this).data('id');

        $('#employee-detail').hide();
        $('#employee_data-loader').show();

        $.ajax({
            url: BASEURL+'content/nr10equ_Modal.php',
            type: 'POST',
            data: {id_Equi: id_Equi},
            dataType: 'json',
            cache: false
        })
            .done(function(data){
                /*width='283' height='213'*/
                var etiqueta = "<img src='"+BASEURL+'upload/nr10/images/'+data.foto+"'>";
                console.log(etiqueta);
                $('#employee-detail').hide();
                $('#employee_data-loader').hide();
                $('#foto').html(etiqueta);
                $('#pdf').attr('href',BASEURL+'upload/nr10/images/etiqueta_'+id_Equi+'.pdf');
                $('#png').attr('href',BASEURL+'upload/nr10/images/etiqueta_'+id_Equi+'.svg');
                //ABSPATH."upload/nr10/images/
                $('#employee-detail').show();
            })
            .fail(function(){
                $('#employee-detail').html('Erro, Tente Novamente...');
                $('#employee_data-loader').hide();
            });
    });


});