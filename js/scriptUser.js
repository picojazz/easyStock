$(document).ready(function(){


	var $this;
    var $id;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });

    $('.tablcom').on('click','.com',function(){
    	$this=$(this);

    	var qtecmd = $(this).parents('tr').find('td:eq(5)').find('p').text();
    	var qtelivr = $(this).parents('tr').find('td:eq(8)').text();
    	var qtein = $(this).parents('tr').find('td:eq(5)').find('input[name=com]').val();
    	var codeprod = $(this).parents('tr').find('td:eq(2)').text();
    	var codecmd = $(this).parents('tr').find('td:eq(0)').text();
    	
    	if (qtein <=0 || parseInt(qtein) < parseInt(qtelivr)) {
    		Materialize.toast('erreur quantite', 4000,'red');
    		
    		console.log(qtein,qtelivr);
    	}else{
    		console.log("else");

    		$.get('admin/modifQte.php?qte='+qtein+'&codeprod='+codeprod+'&codecmd='+codecmd,function(data){
    			$this.parents('tr').find('td:eq(9)').text(parseInt(qtein)-parseInt(qtelivr));
    			$this.parents('tr').find('td:eq(5)').find('p').text(parseInt(qtein));
    			$this.parents('tr').find('td:eq(5)').find('input[name=com]').val("");
    			Materialize.toast('quantite  modifiée', 4000,'green');

    			
    		});

    	}

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
            	

            	var a=$('.modal-content table tbody ').find("tr:eq(0)");
      			$('.modal-content table tbody ').empty().append(a);
            	$('.modal-content h4').html("commande N° "+data[0].codecmd);
            	data.forEach(function(d){
                 $('.modal-content table tbody ').find('tr:eq(0)').after("<tr><td>"+d.codeprod+"</td><td>"+d.designation+"</td><td>"+d.pu+"</td><td>"+d.qtecmd+"</td><td>"+d.montant+" </td></tr>");
                 
                });

            	//alert(JSON.stringify(data));

            	$('#modal1').modal('open');


            }   
                
           
        });

        return false;
    });

        $('.tablcom').on('click','.supp a',function(e){
        e.preventDefault();
        e.stopPropagation();
        var codecmd = $(this).parents('tr').find('td:eq(0)').text();
        var codeprod = $(this).parents('tr').find('td:eq(2)').text();
        var $this=$(this);
        $.post($(this).attr("href"),{codecmd: codecmd,codeprod:codeprod},function(data){
            $this.parents('tr').fadeOut();
            Materialize.toast('produit supprimé de la commande!', 4000,'green');
        });
        return false;
            });


});