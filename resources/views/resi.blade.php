<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
    </head>
    <body>


<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="cart_container">
					<div class="cart_title">Periksa Ongkir</div>
					
					<div class="cart_items">
					    
					    
						
					</div>
					
					<!-- Order Total -->
				<form method="get">
					
					<div class="row">
					    <div class="col-md-6">
					        
                              <div class="form-group">
                                <label for="exampleInputEmail1">Kurir</label>
                                <select class="kurir form-control" name="kurir">
                                    <option selected="" disabled="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
									<option value="pos">POS</option>
                                    <option value="wahana">WAHANA</option>
									<option value="jnt">JNT</option>
                                 
                                </select>
                              </div>
                              
                              
					    </div>
					    <div class="col-md-6">
					        
                        <div class="form-group">
                  <label>Resi</label>
                  <input type="text" name="resi" class="berat form-control" placeholder="Enter ...">
                </div>
                <div>
                <input type="text" name="layanan" class="layananNya form-control" placeholder="Enter ...">
                              </div>
                            
					    </div>
					</div>

					<div class="cart_buttons">
						<button type="button" class="button cart_button_clear"><a href="{{ url('resi/remove') }}" class="cek-resi" style="color:black;">Cek Resi</a></button>
						<button style="display:none;" type="submit" class="button cart_button_checkout">Lanjut Bayar</button>
					
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 
$("#jqueryselect").change(function(){
 var selectedcolor = $('#jqueryselect').val(); 
 var selected = $('#jqueryselect').text();
 document.getElementById("ongkirlur").value = selectedcolor;
   
});
 
});
</script>
<script type="text/javascript">
		$(document).ready(function(){
		    


	
		    
		    // Cek Ongkir
		    $('.cek-resi').click(function(e){
		        e.preventDefault();
		        $('.hasil-ongkir').empty();
		        
		        $("input[name='layanan']").empty();
		        
		        var resi = $('.resi').val();

		        var kurir = $('.kurir').val();

		        
		        
		        $.ajax({
		            type:'get',
		            url:"{{ url('resi/cek') }}",
		            data:{

		                kurir: kurir,
                        resi: resi,
		                
		            },
		            success: function(data){
		                $.each(data.hasil.result,function(i,v){

                        // var hasil = '<table class="table table-bordered">';
                        // var hasil = '<tbody>';
                        
                            $.each(v.costs,function(i,v){
                                console.log(v);
    
                                var layanan = v.summary;
                                var cost = 0;
                                
                                $.each(v.cost,function(i,v){
                                    cost = v.value;
                                })
                                
                                console.log(layanan+'-'+cost);
                                
                                var hasil = '';
                                
                                hasil += '<input value="'+layanan+'">';
                    
                                hasil += '</input>';
                                
                                
                                $('.layananNya').append(hasil);
                                
                            });
    
                            // hasil+='</tbody>'
                            // hasil+= '</table>';
    
                            
                        })
                        $('.cart_button_checkout').show();
                        
		            }
		        })
		    })
		    
			$('.btn-cart').click(function(e){
				e.preventDefault();
				$('#modal-cart').modal();
			});
			
			
		});
	</script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </html>