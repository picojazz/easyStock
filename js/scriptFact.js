$(document).ready(function(){


	var $this;
    var $id;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });

    	$('.tablivrok tbody ').on('click','.detail a',function(e){
        e.preventDefault();
        e.stopPropagation();
        $this=$(this); 
        
        $.ajax({
            url : $(this).attr("href"),  
            dataType : "json",   
            success : function(data)
            {
              

              var a=$('#modal3 .modal-content table tbody ').find("tr:eq(0)");
            $('#modal3 .modal-content table tbody ').empty().append(a);
              $('#modal3 .modal-content h4').html("commande N° "+data[0].codecmd);
              data.forEach(function(d){
                 $('.modal-content table tbody ').find('tr:eq(0)').after("<tr><td>"+d.codeprod+"</td><td>"+d.designation+"</td><td>"+d.pu+"</td><td>"+d.qtecmd+"</td><td>"+d.montant+" </td></tr>");
                 
                });

              //alert(JSON.stringify(data));

              $('#modal3').modal('open');


            }   
                
           
        });

        return false;
    });






});