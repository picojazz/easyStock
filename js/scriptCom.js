$(document).ready(function() {
    var $this;
    var $id;
    var som=0;
    var cmd=0;
    var res=0;
    var $d;

    $('.indicator').addClass('blue');
    $('.modal').modal();
      
  $('.datepicker').pickadate({
  selectMonths: true,//Creates a dropdown to control month
  selectYears: 15,//Creates a dropdown of 15 years to control year
  //The title label to use for the month nav buttons
  labelMonthNext: 'Next Month',
  labelMonthPrev: 'Last Month',
  //The title label to use for the dropdown selectors
  labelMonthSelect: 'Select Month',
  labelYearSelect: 'Select Year',
  //Months and weekdays
  monthsFull: [ 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre' ],
  monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Auo', 'Sep', 'Oct', 'Nov', 'Dec' ],
  weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
  weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
  //Materialize modified
  weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
  //Today and clear
  today: "today",
  clear: 'effacer',
  close: 'fermer',
  //The format to show on the `input` element
  format: 'yyyy-mm-dd'
  });
        
    

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
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



    $('.cmd').on('click',function(e){
      e.preventDefault();
      if ($('#cli').val() != "" ) {
      var text1 = $('#cli').val() ;
      
            var val =$('#selectcli option').filter(function () { return this.text == text1; }).val();
      //alert(val);
      $("#selectcli").val(val);
      console.log(val);
    }
      var datelivr =$(this).parent().find('input[name=date]').val();
      console.log(datelivr);
      var codecli =$(this).parent().find('select').val();
      //console.log(codecli);
      $.post('admin/commander.php',{codecli : codecli, datelivr : datelivr},function (d) {
         // console.log("envoie commande");
          if (d == "non") {
          Materialize.toast("erreur lors de l'enregistrement , client ou date vide  !",4000,'red');
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
      
    
    //add client

    $('#formCli').on('submit',function  (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#addCli').text("...");
        var prenom = $(this).find("input[name=prenom]").val();
        var nom = $(this).find("input[name=nom]").val();
        var adresse = $(this).find("input[name=adresse]").val();
        var tel = $(this).find("input[name=tel]").val();
        var type = $(this).find("select").val();
        var test = parseInt(tel);
        if (Number.isInteger(test) == true) {

        
        $.post("admin/addClient.php",{prenom: prenom, nom: nom, adresse: adresse, tel: tel,type: type},function(data){
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
          Materialize.toast('nouveau client ajouté !', 4000,'green');
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

        setTimeout(function(){
          window.location.reload();
        },1000);
        return false;
    });

});
