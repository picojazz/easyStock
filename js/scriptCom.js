$(document).ready(function() {
    var $this;
    var $id;
    var som=0;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });

    // add panier

    $('.ajoutPanier').on('submit',function(e){
      e.preventDefault();

      var prod = $(this).parent().find('select').val();
      var qtecmd = $(this).parent().find("input[name=qtecmd]").val();

      $.ajax({
            url : 'admin/recupProduit.php?id='+prod,  
            dataType : "json",   
            success : function(data)
            { 
              var tot = data.pu * qtecmd;
              som+=tot;
                Materialize.toast('produit ajouté au panier !', 4000,'green');
                $('.panier tbody').append($("<tr><td>"+data.codeprod+"</td><td>"+data.designation+"</td><td>"+qtecmd+"</td><td>"+data.pu+"</td><td class='tota'>"+tot+"</td><td><a href='#' class='supp'><img src='../image/supp.png'></a></td></tr>"
                  ).hide(2).fadeIn(2000));
                var inputs = document.querySelectorAll(".com input");
            inputs.forEach( function(input) {
                input.value="";
            });

                $('.total').html("TOTAL : "+som+" F CFA");
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
    

});
