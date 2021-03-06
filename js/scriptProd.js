$(document).ready(function() {
    var $this;
    var $id;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });

    //produit
            //add produit
    $('#formCli').on('submit',function  (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#addCli').text("...");
        var designation = $(this).find("input[name=designation]").val();
        var qte = $(this).find("input[name=qte]").val();
        var pu = $(this).find("input[name=pu]").val();
        var four = $(this).find("select").val();
        var fourn = $(this).find("select option:selected").text();
        var test = parseInt(pu);
        var test1 = parseInt(qte);
        if (Number.isInteger(test) == true && Number.isInteger(test1) == true) {

        
        $.post("admin/addProd.php",{qte: qte, pu: pu, designation: designation,four : four},function(data){
            if (data =="non") {
                $('#addCli').removeClass("blue").addClass("red").text("erreur de saisie : champs vides");
            setTimeout(function (){ 
             $('#addCli').removeClass("red").addClass("blue").text("ajouter") ;
           },3000);
           }else{
             $('#addCli').removeClass("blue").addClass("green").text("enregistré");
            setTimeout(function (){ 
             $('#addCli').removeClass("green").addClass("blue").text("ajouter") ;
             
            },3000);
            $('.clientTable tbody tr:first-child').after($("<tr><td>"+designation+"</td><td style='color:#3498db;'>"+test+"</td><td>"+test1+"</td><td>"+fourn+"</td><td class='modif'><a href='admin/modifProd.php?id="+data+"'><img src='../image/modif.png'></a></td><td class='supp'><a href='admin/suppProd.php?id="+data+"'><img src='../image/supp.png'></a></td></tr>").hide(2).fadeIn(1000));
          Materialize.toast('nouveau produit ajouté !', 4000,'green');
            var inputs = document.querySelectorAll("#formCli input");
            inputs.forEach( function(input) {
                input.value="";
            });    
           }
            
            
            
        });
                    }else{
                 $('#addCli').removeClass("blue").addClass("red").text("erreur de saisie : prix et quantite doivent etre des chiffres ou champs vide");
                setTimeout(function (){ 
                $('#addCli').removeClass("red").addClass("blue").text("ajouter") ;
                },3000);
              }

        return false;
    });










            //supp client

    $('tbody ').on('click','.supp a',function(e){
        e.preventDefault();
        e.stopPropagation();
        var $this=$(this);
        $.get($(this).attr("href"),function(data){
            $this.parents('tr').fadeOut();
            Materialize.toast('produit supprimé !', 4000,'green');
        });
        return false;
    });
    

                //modif client

    $('.clientTable tbody ').on('click','.modif a',function(e){
        e.preventDefault();
        e.stopPropagation();
        $this=$(this);
        
        $.ajax({
            url : $(this).attr("href"),  
            dataType : "json",   
            success : function(data)
            {
                console.log('entrez dans ajax',data.codeprod);
                $('.mod form').find("input[name=designation]").val(data.designation);
                $('.mod form').find("input[name=pu]").val(data.pu);
                $('.mod form').find("input[name=qte]").val(data.qte);
                 $('#modal1').modal('open');

                 $id=data.codeprod;
                


            }
           
        });

        return false;
    });

    //modal change

    $('#formModif').on('submit',function  (event) {
                    event.preventDefault();
                    event.stopPropagation();
        $('.butModif').text("...");
        var designation = $(this).find("input[name=designation]").val();
        var qte = $(this).find("input[name=qte]").val();
        var pu = $(this).find("input[name=pu]").val();
        var test = parseInt(pu);
        var test1 = parseInt(qte);
        if (Number.isInteger(test) == true && Number.isInteger(test1) == true) {
        
        $.post("admin/modifProd1.php",{id: parseInt($id),qte: qte, pu: pu, designation: designation},function(d){
            if (d =="non") {
                $('.butModif').removeClass("blue").addClass("red").text("erreur de saisie : champs vides");
            setTimeout(function (){ 
             $('.butModif').removeClass("red").addClass("blue").text("modifier") ;
           },3000);
           }else{
             $('.butModif').removeClass("blue").addClass("green").text("modifié");
            setTimeout(function (){ 
             $('.butModif').removeClass("green").addClass("blue").text("modifier") ;
             
            },3000);
            setTimeout(function (){
             $('#modal1').modal('close');
            },1000);
            setTimeout(function (){
             $this.parents('tr').find("td:eq(0)").html(designation);
             $this.parents('tr').find("td:eq(1)").html(test);
             $this.parents('tr').find("td:eq(2)").html(test1);
                                 console.log('entrez dans ajax form');
            Materialize.toast('produit modifié !', 4000,'green');

             var inputs = document.querySelectorAll("#formModif input");
            inputs.forEach( function(input) {
                input.value="";
            });

                

            },1500);
            
           }
            
            
            
        });
              }else{
                 $('.butModif').removeClass("blue").addClass("red").text("erreur de saisie : prix et quantite doivent etre des chiffres ou champs vide");
                setTimeout(function (){ 
                $('.butModif').removeClass("red").addClass("blue").text("modifier") ;
                },3000);
              }


        return false;
    });

    $('.mo').on('click',function(){

      $.ajax({
            url : "admin/prod.php",  
            dataType : "json",   
            success : function(data)
            {
              var tot = 0;
                //alert(JSON.stringify(data));
                data.forEach(function(d){
                 $('.prod ').append("<tr><td>"+d.codeprod+"</td><td>"+d.designation+"</td><td>"+d.pu+" F</td><td>"+d.qte+"</td><td>"+parseInt(d.qte)*parseInt(d.pu)+" F</td></tr>");
                 tot+=parseInt(d.qte)*parseInt(d.pu);
                });
                $('.tot ').html("TOTAL : "+tot+" F CFA");
                $('#modal2').modal('open');
                


            }

        });
      var a=$('.prod ').find("tr:eq(0)");
      $('.prod ').empty().append(a);

      return false;
    });

   
    



});
