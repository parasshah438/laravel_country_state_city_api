@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <select name="country" id="countrydata" class="form-control">
                    <option value="">Select country</option>
                    @foreach($country as $countrys)
                    <option value="{{$countrys['code']}}">{{$countrys['name']}}</option>
                    @endforeach
                </select>
                <br>
                <select name="state" id="state" class="form-control"></select>
                <br>
                <select name="city" id="city" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
<script type="text/javascript">
$('#countrydata').on('change',function(){
    var countryCode=$("#countrydata").val();
    $.ajax({
        url: "{{ route('state') }}",
        type:"Get",
        data:{countryCode:countryCode},
        dataType:"Json",
        success:function(result){
            if(result){
                $('#state').empty();
                $('#state').append('<option value="">Select your state name</option>');
                $.each(result,function(key,region){
                    $('#state').append('<option value='+region.region+'>'+region.region+'</option>')
                });
            }
            else
            {
                $('#state').empty();
                $('#state').append('<option value="">Select your state name</option>');
                $('#state').append('<option value="">No found state</option>');
            }
        }
    });
});

$('#state').on('change',function(){
    countryCode=$("#countrydata").val();
    state = $('#state').val();
    $.ajax({
        url:"{{route('city')}}",
        type:"Get",
        data:{countryCode:countryCode,state:state},
        dataType:"Json",
        success:function(result){
            if(result){
                $('#city').empty();
                $('#city').append('<option value="">Select your city name</option>');
                $.each(result,function(key,city){
                    $('#city').append('<option value='+city.city+'>'+city.city+'</option>')
                });
            }
            else
            {
                $('#city').empty();
                $('#city').append('<option value="">Select your city name</option>');
                $('#city').append('<option value="">No found city</option>');
            }

        }
    });
});
</script>
@endsection
