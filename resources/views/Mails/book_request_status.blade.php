<!DOCTYPE html>
<html>
<head>
    <title>About your book request</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>

    @if($bookRequest->status == 'PENDING')
        <h3>Congratulations on placing your book request. While the status is still on pending status, we would like to inform you that we'll get back to you as soon as possible.</h3>

        <h3>Meanwhile, feel free to browse our existing books.</h3>

        <h3>Thank you and have a great day!</h3>
    @elseif ($bookRequest->status == 'APPROVED')
        <h3>Congratulations! your book request has been approved</h3>

        <h3>Thank you and have a great day!</h3>
    @else 
        <h3>We are sorry. your book request has been denied</h3>

        <h3>{{$bookRequest->reason}}</h3>

        <h3>Thank you and have a great day!</h3>
    @endif
</body>
</html>