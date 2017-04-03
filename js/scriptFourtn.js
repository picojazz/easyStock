$(document).ready(function(){

	var som=0;
	var $this;
    var $id;
    var cmd=0;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });


    $('.ajoutPanier').on('submit',function(e){
      e.preventDefault();

      var prod = $(this).parent().find('select').val();
      var qtecmd = parseInt($(this).parent().find("input[name=qtecmd]").val());
      var th = $(this);
      
      if (qtecmd<=0 || Number.isInteger(qtecmd) === false ) {
                  Materialize.toast('erreur quantité', 4000,'red');
                  console.log(data.qte);
              }else{

      $.ajax({
            url : 'admin/recupProduit.php?id='+prod,  
            dataType : "json",   
            success : function(data)
            { 
              

              

                var tot = data.pu * qtecmd;
              som+=tot;
                Materialize.toast('produit ajouté au fourniture !', 4000,'green');
                $('.panier tbody').append($("<tr><td>"+data.codeprod+"</td><td>"+data.designation+"</td><td>"+data.qte+"</td><td>"+qtecmd+"</td><td>"+data.pu+"</td><td class='tota'>"+tot+"</td><td><a href='#' class='supp'><img src='../image/supp.png'></a></td></tr>"
                  ).hide(2).fadeIn(2000));
               

                $('.qtecmdd').parent().find("input[name=qtecmd]").val("");
                $('.total').html("TOTAL : "+som+" F CFA");
              
            }
           
        });

  	}

      



      return false;
    });


    $('.panier tbody').on('click','.supp',function(){
      
      var s = $(this).parents('tr').find("td:eq(5)").text();
       
      som-=s;
      $('.total').html("TOTAL : "+som+" F CFA");
      $(this).parents('tr').fadeOut();
      Materialize.toast('produit supprimé des fournitures !', 4000,'green');

      return false;
    });



    $('.cmd').on('click',function(e){
      e.preventDefault();
      
      //console.log(codecli);
      $.get('admin/fournir.php',function (d) {
         // console.log("envoie commande");
          
        console.log("dans le else");

        $('.panier tbody tr').each(function(){
          cmd += 1;
       var codeprod = $(this).find('td:eq(0)').text();
       var qteav = $(this).find('td:eq(2)').text();
       var qtefr = $(this).find('td:eq(3)').text();
       console.log(cmd);
       
       if (cmd != 1) {
       $.post('admin/fourntProduit.php',{codeprod : codeprod ,qteav : qteav,qtefr : qtefr,codefournt : d},function (data){
        
        

       });

        }
       
     });
        

        
        if (cmd == 1) {
          Materialize.toast("fourniture enregistrée sans produit",4000,'green');
        }else{
          Materialize.toast("fourniture enregistrée",4000,'green');
        }

      
      });
      

    

      
    setTimeout(function(){
      window.location.reload();
    },1000)

      


      return false;
    });
 




});