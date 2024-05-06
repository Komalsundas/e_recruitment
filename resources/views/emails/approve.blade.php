<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BTL HR</title>
</head>

<body>
    <h4>{{ $mail_data['title'] }}</h4>
    <p>&nbsp;{{ $mail_data['body'] }}</p>
    {{-- <p>&nbsp;{{ $mail_data['login_link'] }}</p> --}}
 
    <br><p>&nbsp; Please click on the link below to login:</p>
    <br>
    {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <a href="{{route('login')}}" class="btn btn-info btn-sm" target="_blank">
        <i class="far fa-edit"></i>
        &#x2192;Click here to login</a> --}}


        &nbsp;&nbsp;&nbsp;<a href="{{ route('login') }}" target="_blank"
        style="background-color: #4ca8af; color: white; padding: 12px 20px; text-align: center; display: inline-block; text-decoration: none; font-size: 14px; border-radius: 4px; border: none;">{{
        __('Login to the Portal') }}</a> 

    
{{-- 
    @if($status == 'A')
    
    @endif --}}
    <br>
    <br>
    <p> Regards</p>
    <p> Thank you</p>
</body>

</html>