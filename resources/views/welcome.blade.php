<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
    </head>
    <body>
    <form class="form-horizontal" role="form" method="POST" action="/">
{{csrf_field()}}
<div class="form-group-sm">
<div class="col-md-6">
<div class="form-group">
<label for="">Provinsi Asal</label>
<select name="province_origin" class="form-control">
<option value="">--Provinsi--</option>
@foreach ($provinces as $province => $value)
<option value="{{ $province }}"> {{ $value }} </option>
@endforeach
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="">Kota Asal</label>
<select name="city_origin" class="form-control"><option>--Kota--</option></select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="">Provinsi Tujuan</label>
<select name="province_destination" class="form-control">
<option value="">--Provinsi--</option>
@foreach ($provinces as $province => $value)
<option value="{{ $province }}"> {{ $value }} </option>
@endforeach
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="">Kota Tujuan</label>
<select name="city_destination" class="form-control"><option>--Kota--</option></select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="">Kurir</label>
<select name="courier" class="form-control">
@foreach ($couriers as $courier => $value)
<option value="{{$couriers}}">{{$value}}</option>></option>
@endforeach
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
         <label for="">Berat (g)</label>
         <input type="number" name="weight" id="" class="form-control" value="1000">
</div>
</div>
<button type="submit" class="btn btn-primary">Cek</button>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
  $('select[name="province_origin"]').on('change', function(){
    let provinceId = $(this).val();
    if(provinceId) {
      jQuery.ajax({
        url: '/province/'+provinceId+'/cities',
        type: "GET",
        dataType: "json",
        success:function(data){
          $('select[name="city_origin"]').empty();
          $.each(data, function(key, value){
            $('select[name="city_origin"]').append('option value="'+ key +'">' + value + '</option>');
          });
        },
      });
    } else {
      $('select[name="city_origin"]').empty();
    }
  });

  $('select[name="province_destination"]').on('change', function(){
    let provinceId = $(this).val();
    if(provinceId) {
      jQuery.ajax({
        url: '/province/'+provinceId+'/cities',
        type: "GET",
        dataType: "json",
        success:function(data){
          $('select[name="city_destination"]').empty();
          $.each(data, function(key, value){
            $('select[name="city_destination"]').append('option value="'+ key +'">' + value + '</option>');
          });
        },
      });
    } else {
      $('select[name="city_destination"]').empty();
    }
  });
});
</script>

    </body>
    
</html>
