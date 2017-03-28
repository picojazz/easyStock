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
               var th = '<table class="tabprod z-depth-5"><tbody><tr><th>codecmd</th><th>datecmd</th><th>codeprod</th><th>produit</th><th>pu</th><th>qtecmd</th><th>qte livrée</th><th>montant</th><th>Etat</th></tr></tbody></table>'
               $('.tabLivr').append(th);

               data.forEach( function(line) {
               	$('.tabLivr table tbody ').find('tr:eq(0)').after(
               	'<tr><td>'+line.codecmd+'</td><td style="color:#2ecc71;">'+line.datecmd+'</td><td>'+line.codeprod+'</td><td>'+line.designation+'</td><td>'+line.pu+'</td><td>'+line.qtecmd+'</td><td style="color:#3498db;"><p>'+line.qtelivr+'</p><input placeholder="quantite a livrer" name="livr" type="number"><button class="qtelivr btn green waves-effect">livrer</button></td><td>'+line.montant+'</td><td><img src="../image/'+line.etat+'.png" ></td></tr>'
               	).hide(2).fadeIn(2000);
               });
               

                


            }
           
        });

    });


    $('.tabLivr ').on('click','.qtelivr',function(){
    	$this=$(this);

    	var qtecmd = $(this).parents('tr').find('td:eq(5)').text();
    	var qtelivr = $(this).parents('tr').find('td:eq(6)').find('p').text();
    	var qtein = $(this).parents('tr').find('td:eq(6)').find('input[name=livr]').val();
    	var codeprod = $(this).parents('tr').find('td:eq(2)').text();
    	var codecmd = $(this).parents('tr').find('td:eq(0)').text();
    	if (qtein <=0 || qtein > qtecmd-qtelivr) {
    		Materialize.toast('erreur quantite', 4000,'red');
    		//alert(qtelivr);
    		//console.log(qtein,qtecmd-qtelivr);
    	}else{
    		//alert(qtein);

    		$.get('admin/livr.php?qte='+qtein+'&codeprod='+codeprod+'&codecmd='+codecmd,function(data){
    			$this.parents('tr').find('td:eq(6)').find('p').text(parseInt(qtelivr)+parseInt(qtein));
    			$this.parents('tr').find('td:eq(6)').find('input[name=livr]').val("");
    			Materialize.toast('produit livré', 4000,'green');

    			if (data == "oui") {
    				$this.parents('tr').find('td:eq(8)').find('img').attr("src","../image/1.png");
    			}
    		});
    	}
    	


    });





});