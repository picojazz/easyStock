$(document).ready(function(){


	var $this;
    var $id;
    var som=0;
    var cmd=0;
    var i=0;

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



        $('.puc').on('click',function(){
            
            $('.comm .row').slideToggle('slow',function(){
              i +=1
              if (i % 2 !=0) {
                $('.puc').text('cacher passer une commande');
              }else{
                $('.puc').text('afficher passer une commande');
              }
            });
        });



        // add panier

    $('.ajoutPanier').on('submit',function(e){
      e.preventDefault();
      if ($('#desi').val() != "" ) {
      var text1 = $('#desi').val() ;
      
            var val =$('#selectprod option').filter(function () { return this.text == text1; }).val();
      //alert(val);
      $("#selectprod").val(val);
      console.log(val);
    }

      var prod = $(this).parent().find('select').val();
      var qtecmd = parseInt($(this).parent().find("input[name=qtecmd]").val());
      var th = $(this);
      $.ajax({
            url : 'admin/recupProduit.php?id='+prod,  
            dataType : "json",   
            success : function(data)
            { 
              
              if (data.codeprod == undefined) {
                Materialize.toast("ce produit n'existe pas", 4000,'red');
                $('.qtecmdd').parent().find("input[name=qtecmd]").val("");
                $('#desi').val("");
              }else{

              if (qtecmd<=0 || qtecmd > data.qte || Number.isInteger(qtecmd) === false) {
                  Materialize.toast('erreur quantité', 4000,'red');
                  console.log(data.qte);
              }else{

                var tot = data.pu * qtecmd;
              som+=tot;
                Materialize.toast('produit ajouté au panier !', 4000,'green');
                $('.panier tbody').append($("<tr><td>"+data.codeprod+"</td><td>"+data.designation+"</td><td>"+qtecmd+"</td><td>"+data.pu+"</td><td class='tota'>"+tot+"</td><td><a href='#' class='supp'><img src='../image/supp.png'></a></td></tr>"
                  ).hide(2).fadeIn(2000));
               
                $('#desi').val("");
                $('.qtecmdd').parent().find("input[name=qtecmd]").val("");
                $('.total').html("TOTAL : "+som+" F CFA");
              }
            }
            }
           
        });

      

      

      return false;
    });

    $('.panier tbody').on('click','.supp',function(){
      
      var s = $(this).parents('tr').find("td:eq(4)").text();
       
      som-=s;
      $('.total').html("TOTAL : "+som+" F CFA");
      $(this).parents('tr').fadeOut();
      Materialize.toast('produit supprimé du panier !', 4000,'green');

      return false;
    });


    //commander


    $('.cmd').on('click',function(e){
      e.preventDefault();
      
      
      var codecli =$('.codecli').text();
      //console.log(codecli);
      $.post('admin/commanderUser.php',{codecli : codecli},function (d) {
         // console.log("envoie commande");
          if (d == "non") {
          Materialize.toast("erreur lors de l'enregistrement  !",4000,'red');
        }else{
        console.log("dans le else");

        $('.panier tbody tr').each(function(){
          cmd += 1;
       var codeprod = $(this).find('td:eq(0)').text();
       var qtecmd = $(this).find('td:eq(2)').text();
       
       if (cmd != 1) {
       $.post('admin/cmdProduit.php',{codeprod : codeprod ,qtecmd : qtecmd,codecmd : d},function (data){
        
        

       });

        }
       
     });
        

        
        if (cmd == 1) {
          Materialize.toast("Commande enregistrée sans produit",4000,'green');
        }else{
          Materialize.toast("Commande enregistrée",4000,'green');
        }

     } 
      });
      

    

      
    setTimeout(function(){
      window.location.reload();
    },1000)

      


      return false;
    });

});