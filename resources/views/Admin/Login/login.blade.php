<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<head>
    <style>
        .navbar>.container-fluid {
            justify-content: end !important;
        }
    </style>
</head>

<div class="container">
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <div class="container-fluid">
            {{-- @if(Auth::user())
                <form action="{{route('admin.logout')}}" method="post">
                    <button class="navbar-brand" type="submit">Logout</button>
                </form>
            @else --}}
                <a class="navbar-brand" href="{{route('user.index')}}">User Login</a>
            {{-- @endif --}}
            
        </div>
    </nav>

    <form action="{{route('admin.login')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div>
            <label for ="email" class="form-label">Email address</label>
            <input type="text" class="form-control" id="email" name="username">
        </div>

        <div>
            <label for ="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>