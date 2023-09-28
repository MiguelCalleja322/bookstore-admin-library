@include('Admin.Header.nav')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .update-text {
            width: 100%
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }
        .modal-content {
            margin: 2px auto;
            z-index: 1100 !important;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<div class="container mt-5">
    <div class="text-center">
        <h1>
            Users Management Library
        </h1>
    </div>

    <div class="mt-5">
        <div class="p-3 mb-2 bg-danger text-white hidden" id="error-message">
            <span></span>
        </div>
        <div class="p-3 mb-2 bg-success text-white hidden" id="success-message">
            <span></span>
        </div>
       
    </div>

    <div class="mb-3 flex">   
        <button type="button" class="btn btn-warning" id="open-store-modal">Add User</button>
    </div>

    <div class="p-4 border border-secondary">
        <table class="table" id="table">
            <thead>
                <tr class="text-center">
                    <th scope="col" width="25%">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Profile Picture</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="m-auto">{{$user->user->name}}</td>
                        <td class="m-auto">{{$user->user->username}}</td>
                        <td class="m-auto">{{$user->user->email}}</td>
                        <td>
                            <img src="{{$user->user->profile_pic}}" alt="" width="150" height="200">
                        </td>
                        <td class="">
                            <div class="flex text-center">
                                
                                <button 
                                    type="button" 
                                    class="btn btn-secondary text-white" 
                                    id="open-view-modal"
                                    data-name="{{$user->user->name}}"
                                    data-username="{{$user->user->username}}"
                                    data-email="{{$user->user->email}}"
                                    data-profile_pic="{{$user->user->profile_pic}}">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>View</span>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-primary text-white" 
                                    id="open-update-modal"
                                    data-id="{{$user->user->id}}"
                                    data-name="{{$user->user->name}}"
                                    data-username="{{$user->user->username}}"
                                    data-email="{{$user->user->email}}"
                                    data-profile_pic="{{$user->user->profile_pic}}">
                                    <i class="fa-solid fa-pen-nib"></i>
                                    <span>Update</span>
                                </button>

                                <button type="button" class="btn btn-danger text-white" id="destroy" data-id="{{$user->id}}">
                                    <i class="fa-solid fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@include('Admin.User.modals.view')
@include('Admin.User.modals.update')
@include('Admin.User.modals.store')

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
    $(function () {
        let table = new DataTable('#table');
        let id = null;

        //view

        $('#table #open-view-modal').on('click', function (e) {
            let id = $(this).data("id");
            let name = $(this).data("name");
            let username = $(this).data("username");
            let email = $(this).data("email");
            let profile_pic = $(this).data("profile_pic");
        
            $('#view-modal #id').val(id);
            $('#view-modal #name').text(name);
            $('#view-modal #username').text(username);
            $('#view-modal #email').text(email);
            $('#view-modal #profile_pic').attr('src',profile_pic);
            $('#view-modal').modal('toggle');
        });

        $('#view-modal #close-modal').on('click', function () {
            $('#view-modal').modal('hide');
        })

        //update

        $('#table #open-update-modal').on('click', function (e) {
            let id = $(this).data("id");
            let name = $(this).data("name");
            let username = $(this).data("username");
            let email = $(this).data("email");
            let profile_pic = $(this).data("profile_pic");

            $('#update-modal #id').val(id);
            $('#update-modal #name').val(name);
            $('#update-modal #username').val(username);
            $('#update-modal #email').val(email);
            $('#update-modal #profile_pic').val(profile_pic);
            $('#update-modal').modal('toggle');
        });

        $('#update-modal #close-modal').on('click', function () {
            $('#update-modal').modal('hide');
        })

        //store-modal
        
        $('#open-store-modal').on('click', function (e) {
            $('#store-modal').modal('toggle');
        });
        
        $('#store-modal #close-modal').on('click', function () {
            $('#store-modal #error-message').addClass('hidden');
            $('#store-modal').modal('hide');
        });

    });

   
</script>