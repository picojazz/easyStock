$(document).ready(function() {
    var $this;
    var $id;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });

    //client
            //add client
    $('#formCli').on('submit',function  (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#addCli').text("...");
        var prenom = $(this).find("input[name=prenom]").val();
        var nom = $(this).find("input[name=nom]").val();
        var adresse = $(this).find("input[name=adresse]").val();
        var tel = $(this).find("input[name=tel]").val();
        var test = parseInt(tel);
        if (Number.isInteger(test) == true) {

        
        $.post("admin/addFournisseur.php",{prenom: prenom, nom: nom, adresse: adresse, tel: tel},function(data){
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
            $('tbody tr:first-child').after($("<tr><td>"+prenom+"</td><td>"+nom+"</td><td>"+tel+"</td><td>"+adresse+"</td><td class='modif'><a href='admin/modifFour.php?id="+data+"'><img src='../image/modif.png'></a></td><td class='supp'><a href='admin/suppFour.php?id="+data+"'><img src='../image/supp.png'></a></td></tr>").hide(2).fadeIn(1000));
          
            var inputs = document.querySelectorAll("#formCli input");
            inputs.forEach( function(input) {
                input.value="";
            });    
           }
            
            
            
        });
                    }else{
                 $('#addCli').removeClass("blue").addClass("red").text("erreur de saisie : tel doit etre des chiffres ou champs vide");
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
                console.log('entrez dans ajax',data.codecli);
                $('.modal form').find("input[name=prenom]").val(data.prenom);
                $('.modal form').find("input[name=nom]").val(data.nom);
                $('.modal form').find("input[name=tel]").val(data.tel);
                $('.modal form').find("input[name=adresse]").val(data.adresse);
                 $('#modal1').modal('open');

                 $id=data.codecli;
                


            }
           
        });

        return false;
    });

    //modal change

    $('#formModif').on('submit',function  (event) {
                    event.preventDefault();
                    event.stopPropagation();
        $('.butModif').text("...");
        var prenom1 = $(this).find("input[name=prenom]").val();
        var nom1 = $(this).find("input[name=nom]").val();
        var adresse1 = $(this).find("input[name=adresse]").val();
        var tel1 = $(this).find("input[name=tel]").val();
        var test = parseInt(tel1);
            console.log('click avant ajax form');
            if (Number.isInteger(test) == true) {
        
        $.post("admin/modifFour1.php",{id: parseInt($id),prenom: prenom1, nom: nom1, adresse: adresse1, tel: tel1},function(d){
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
             $this.parents('tr').find("td:eq(0)").html(prenom1);
             $this.parents('tr').find("td:eq(1)").html(nom1);
             $this.parents('tr').find("td:eq(2)").html(tel1);
             $this.parents('tr').find("td:eq(3)").html(adresse1);
                                 console.log('entrez dans ajax form');

             var inputs = document.querySelectorAll("#formModif input");
            inputs.forEach( function(input) {
                input.value="";
            });

                

            },1500);
            
           }
            
            
            
        });
              }else{
                 $('.butModif').removeClass("blue").addClass("red").text("erreur de saisie : tel doit etre des chiffres ou champs vide");
                setTimeout(function (){ 
                $('.butModif').removeClass("red").addClass("blue").text("modifier") ;
                },3000);
              }


        return false;
    });

   

});
