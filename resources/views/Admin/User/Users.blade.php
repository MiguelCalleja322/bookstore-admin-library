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
        <button type="button" class="btn btn-warning" id="open-adduser-modal">Add User</button>
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
                        <td class="m-auto">{{$user->name}}</td>
                        <td class="m-auto">{{$user->username}}</td>
                        <td>
                            <img src="{{$user->email}}" alt="" width="150" height="200">
                        </td>
                        <td class="m-auto">{{$user->profile_pic}}</td>
                        <td class="">
                            <div class="flex text-center">
                                
                                <button 
                                    type="button" 
                                    class="btn btn-secondary text-white" 
                                    id="open-view-modal"
                                    data-name="{{$user->name}}"
                                    data-username="{{$user->username}}"
                                    data-email="{{$user->email}}"
                                    data-profile_pic="{{$user->profile_pic}}">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>View</span>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-primary text-white" 
                                    id="open-update-modal"
                                    data-id="{{$user->id}}"
                                    data-name="{{$user->name}}"
                                    data-username="{{$user->username}}"
                                    data-email="{{$user->email}}"
                                    data-profile_pic="{{$user->profile_pic}}">
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
        $('#table #open-view-modal').on('click', function (e) {

            let name = $(this).data("name");
            let username = $(this).data("username");
            let email = $(this).data("email");
            let profile_pic = $(this).data("profile_pic");
        
            $('#view-modal .modal-title').text(name);
            $('#view-modal .modal-body img').attr('src', cover);
            $('#view-modal #author').text('Author: ' +  author);
            $('#view-modal #stock').text('Stocks: ' +  stocks);
            $('#view-modal').modal('toggle');
        });

        //update

        $('#table #open-update-modal').on('click', function (e) {
            id = $(this).data("id");
            let name = $(this).data("name");
            let username = $(this).data("username");
            let email = $(this).data("email");
            let profile_pic = $(this).data("profile_pic");

            $('#update-modal #name').val(name);
            $('#update-modal #author').val(username);
            $('#update-modal #cover').val(email);
            $('#update-modal #stock').val(profile_pic);
            $('#update-modal').modal('toggle');
        });

        $('#update-modal #close-modal').on('click', function () {
            $('#update-modal').modal('hide');
        })

        $('#update-modal #update').on('click', function () {
            
            let userID = id; 
            let name = $('#update-modal #name').val();
            let username = $('#update-modal #author').val();
            let email = $('#update-modal #cover').val();
            let profile_pic = $('#update-modal #stock').val();

            let data = {
                'id': userID,
                'name': name,
                'username': username,
                'email': email,
                'profile_pic': profile_pic,
            };
            
            axios.post("{{ route('admin.book.update')}}", data)
            .then(res => {
                location.reload();
            })
            .catch(err => {
                console.error(err.message); 
            })
        })

        //adduser-modal
        
        $('#open-adduser-modal').on('click', function (e) {
            $('#adduser-modal').modal('toggle');
        });
        
        $('#adduser-modal #close-modal').on('click', function () {
            $('#adduser-modal #error-message').addClass('hidden');
            $('#adduser-modal').modal('hide');
        });

    });

   
</script>