<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<head>
    <style>
        .navbar>.container-fluid {
            justify-content: end !important;
        }

        .inner-container {
            max-width: 400px;
        }
    </style>
</head>

<div class="container p-3 mt-5">
    <div class="inner-container mx-auto">
        <h1 class="mb-5 text-center">Book to Library Management System</h1>

        <form action="{{route('auth.login')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="mb-3">
                <label for ="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="username">
            </div>

            <div class="mb-3">
                <label for ="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>