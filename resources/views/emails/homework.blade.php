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
        <h1>{{__('Homework')}}</h1>
        <div class="emails">
            <p><strong>{{__('Name')}}:</strong> {{$data['user']}}</p>
            <p><strong>{{__('Email')}}:</strong> {{$data['course_id']}}</p>
            <p><strong>{{__('Subject')}}:</strong> {{$data['homework']}}</p>
            
        </div>
    </div>

</body>
</html>

