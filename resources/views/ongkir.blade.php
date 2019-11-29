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
                                <label for="exampleInputEmail1">Provinsi Tujuan</label>
                                <select class="provinsi2 form-control" name="provinsi2">
                                    <option selected="" disabled="">Pilih Provinsi</option>
                                    @foreach($provinsi->result as $ps)
                                    <option value="{{ $ps->province_id }}">{{ $ps->province }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Kota Tujuan</label>
                                <select class="kota2 form-control" name="kota2">
                                    <option selected="" disabled="">Pilih Kota</option>
                                    
                                </select>
                              </div>
							  <div class="form-group">
                                <label for="exampleInputPassword1">Kecamatan</label>
                                <select class="kecamatan2 form-control" name="kecamatan2">
                                    <option selected="" disabled="">Pilih Kecamatan</option>
                                    
                                </select>
                              </div>
					    </div>
					    
					</div>
					
					<div class="row">
					    <div class="col-md-6">
					        
                              <div class="form-group">
                                <label for="exampleInputEmail1">Kurir</label>
                                <select class="kurir form-control" name="kurir">
                                    <option selected="" disabled="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
									<option value="pos">POS INDONESIA</option>
                                    <option value="wahana">WAHANA</option>
									<option value="jnt">JNT</option>
									<option value="pandu">PANDU LOGISTICS</option>
									<option value="lion">LION PARCEL</option>
									<option value="first">FIRST LOGISTICS</option>
									<option value="rpx">RPX INDONESIA</option>
									<option value="ninja">NINJA VAN INDONESIA</option>

									<option value="esl">ESL EXPRESS</option>
                                    <option value="sicepat">SICEPAT</option>
									<option value="pahala">PAHALA EXPRESS</option>
                                    <option value="cahaya">CAHAYA LOGISTICS</option>
									<option value="sap">SAP EXPRESS</option>
									<option value="jet">JET EXPRESS</option>
									<option value="slis">SOLUSI EXPRESS</option>
									<option value="dse">DSE</option>
									<option value="ncs">NCS</option>
									<option value="star">STAR CARGO</option>
									<option value="idl">IDL CARGO</option>
                                 
                                </select>
                              </div>
                            
					    </div>
					    <div class="col-md-6">
					        
                        <div class="form-group">
                  <label>Weight</label>
                  <input type="text" name="berat" class="berat form-control" placeholder="Enter ...">
                </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Layanan</label>
                                <select class="form-control layananNya" name="layanan" id="jqueryselect"></select>
                                    <option selected disabled>Agar Layanan Muncul Klik Cek Ongkir</option>
                                </select>
                              </div>
                              

<div class="form-group">
                  <label>Ongkir</label>
                  <input readonly type="text" name="ongkir" class="berat form-control" id="ongkirlur" placeholder="Agar Ongkos Kirim Muncul, Pilih Layanan Diatas">
  </div>
					    </div>
					</div>

					<div class="cart_buttons">
						<button type="button" class="button cart_button_clear"><a href="{{ url('keranjang/remove') }}" class="cek-ongkir" style="color:black;">Cek Ongkir</a></button>
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
		    

		    var provinsi1 = '';
		    var provinsi2 = '';
		    var kota1 = '';
		    var kota2 = '';
			var kecamatan2 = '';
		    
		    // Cek Ongkir
		    $('.cek-ongkir').click(function(e){
		        e.preventDefault();
		        $('.hasil-ongkir').empty();
		        
		        $("select[name='layanan']").empty();
		        
		        var kota_asal = $('.kota1').val();
		        var kota_tujuan = $('.kecamatan2').val();
		        var kurir = $('.kurir').val();
		        var berat = $('.berat').val();
		        
		        
		        $.ajax({
		            type:'get',
		            url:"{{ url('ongkir/cek') }}",
		            data:{
		                kota_asal: kota_asal,
		                kota_tujuan: kota_tujuan,
		                kurir: kurir,
                        berat: berat,
		                
		            },
		            success: function(data){
		                $.each(data.hasil.result,function(i,v){

                        // var hasil = '<table class="table table-bordered">';
                        // var hasil = '<tbody>';
                        
                            $.each(v.costs,function(i,v){
                                console.log(v);
    
                                var layanan = v.service;
                                var cost = 0;
                                
                                $.each(v.cost,function(i,v){
                                    cost = v.value;
                                })
                                
                                console.log(layanan+'-'+cost);
                                
                                var hasil = '';
                                
                                hasil += '<option value="'+cost+'">';
                                hasil += kurir+'-'+layanan;
                                hasil += '</option>';
                                
                                
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
			
			$('body').on('change','.provinsi1',function(e){
			    e.preventDefault();
			    var id = $(this).val();
			    $('.kota1').empty();
			    $.ajax({
			        type:'get',
			        dataType:'json',
			        url:"{{ url('ongkir/kota') }}"+'/'+id,
			        success:function(data){
			            console.log(data.data.result);
			            
			            var hasil = '';
			            $.each(data.data.result,function(i,v){
			                hasil += '<option value="'+v.city_id+'">';
			                
			                hasil += v.city_name
			                
			                hasil += '</option>';
			            })
			            
			            $('.kota1').append(hasil)
			        }
			    })
			})
			
			$('body').on('change','.provinsi2',function(e){
			    e.preventDefault();
			    var id = $(this).val();
			    $('.kota2').empty();
			    $.ajax({
			        type:'get',
			        dataType:'json',
			        url:"{{ url('ongkir/kota') }}"+'/'+id,
			        success:function(data){
			            console.log(data.data.result);
			            
			            var hasil = '';
			            $.each(data.data.result,function(i,v){
			                hasil += '<option value="'+v.city_id+'">';
			                
			                hasil += v.city_name
			                
			                hasil += '</option>';
			            })
			            
			            $('.kota2').append(hasil)
			            
			            
			        }
			    })
			})

			$('body').on('change','.kota2',function(e){
			    e.preventDefault();
			    var id = $(this).val();
			    $('.kecamatan2').empty();
			    $.ajax({
			        type:'get',
			        dataType:'json',
			        url:"{{ url('ongkir/kecamatan') }}"+'/'+id,
			        success:function(data){
			            console.log(data.data.result);
			            
			            var hasil = '';
			            $.each(data.data.result,function(i,v){
			                hasil += '<option value="'+v.subdistrict_id+'">';
			                
			                hasil += v.subdistrict_name
			                
			                hasil += '</option>';
			            })
			            
			            $('.kecamatan2').append(hasil)
			            
			            
			        }
			    })
			})
		});
	</script>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </html>