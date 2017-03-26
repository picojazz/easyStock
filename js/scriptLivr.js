$(document).ready(function(){


	var $this;
    var $id;

    $('.indicator').addClass('blue');
    $('.modal').modal();

    $('select').material_select();


    $('.closebtn').click(function(){
    	$(this).parent().fadeOut();
    });


    $('.livr').on('click',function(){

    	var codecmd = $(this).parent().find('select').val();
    	$.ajax({
            url : 'admin/prodLivr.php?id='+codecmd,  
            dataType : "json",   
            success : function(data)
            {
               $('.tabLivr').empty();
               var th = '<table><tbody><tr><th>codecmd</th><th>datecmd</th><th>produit</th><th>pu</th><th>qtecmd</th><th>qte livrée</th><th>montant</th></tr></tbody></table>'
               $('.tabLivr').append(th);

               data.forEach( function(line) {
               	$('.tabLivr table tbody ').find('tr:eq(0)').after(
               	'<tr><td>'+line.codecmd+'</td><td>'+line.datecmd+'</td><td>'+line.designation+'</td><td>'+line.pu+'</td><td>'+line.qtecmd+'</td><td style="color:#3498db;">'+line.qtelivr+'<input placeholder="quantite a livrer" name="livr" type="number"><button class="qtelivr btn blue waves-effect">livrer</button></td><td>'+line.montant+'</td></tr>'
               	).hide(2).fadeIn(2000);
               });
               

                


            }
           
        });

    });






});