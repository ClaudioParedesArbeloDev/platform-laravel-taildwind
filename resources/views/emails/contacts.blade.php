<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code & Lens</title>
</head>
<body>
    <div>
        <h1>{{__('Emails')}}</h1>
        <div class="emails">
            <p><strong>{{__('Name')}}:</strong> {{$data['name']}}</p>
            <p><strong>{{__('Email')}}:</strong> {{$data['email']}}</p>
            <p><strong>{{__('Subject')}}:</strong> {{$data['subject']}}</p>
            <p><strong>{{__('Message')}}:</strong> {{$data['message']}}</p>
        </div>
    </div>

</body>
</html>

