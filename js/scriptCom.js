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

      var prod = $(this).parent().find('select').val();
      var qtecmd = parseInt($(this).parent().find("input[name=qtecmd]").val());
      var th = $(this);
      $.ajax({
            url : 'admin/recupProduit.php?id='+prod,  
            dataType : "json",   
            success : function(data)
            { 
              

              if (qtecmd<=0 || qtecmd > data.qte || Number.isInteger(qtecmd) === false) {
                  Materialize.toast('erreur quantité', 4000,'red');
                  console.log(data.qte);
              }else{

                var tot = data.pu * qtecmd;
              som+=tot;
                Materialize.toast('produit ajouté au panier !', 4000,'green');
                $('.panier tbody').append($("<tr><td>"+data.codeprod+"</td><td>"+data.designation+"</td><td>"+qtecmd+"</td><td>"+data.pu+"</td><td class='tota'>"+tot+"</td><td><a href='#' class='supp'><img src='../image/supp.png'></a></td></tr>"
                  ).hide(2).fadeIn(2000));
               

                $('.qtecmdd').parent().find("input[name=qtecmd]").val("");
                $('.total').html("TOTAL : "+som+" F CFA");
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
      
    

});
