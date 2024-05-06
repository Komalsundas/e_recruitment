<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shortlisted candidate</title>
</head>

<body>
    <h4>{{ $mail_data['title'] }}</h4>
    <p> &nbsp;{{ $mail_data['body'] }}</p>

    <br>

    {{-- <div class="details"> --}}
        {{-- <h3>&nbsp;Access Details as Follows:</h3> --}}
        {{-- <p>&nbsp;<strong>Name:</strong>{{$mail_data['name']}}</p>
        <p>&nbsp;<strong>CID Number:</strong>{{$mail_data['cid']}}</p>

        <p>&nbsp;<strong>Visit From:</strong>{{$mail_data['from']}}</p> --}}
        {{-- <p>&nbsp;<strong>Visit To:</strong>{{$mail_data['to']}}</p> --}}
    {{-- </div>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('approval.process') }}" target="_blank"
        style="background-color: #4ca8af; color: white; padding: 15px 25px; text-align: center; display: inline-block; text-decoration: none; font-size: 16px; border-radius: 4px; border: none;">{{
        __('Login to the Portal') }}</a> 
{{-- </body> --}}
<p>Regards</p>
<p>Thank you</p>
</body>

</html>