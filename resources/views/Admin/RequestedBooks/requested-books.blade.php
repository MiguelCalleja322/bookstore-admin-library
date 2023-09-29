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
            Requested Books
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

    <div class="p-4 border border-secondary">
        <table class="table" id="table">
            <thead>
                <tr class="text-center">
                    <th scope="col" width="25%">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Requested by</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requestedBooks as $requestedBook)
                    <tr>
                        <td class="align-middle">{{$requestedBook->book_name}}</td>
                        <td class="align-middle">{{$requestedBook->book_author}}</td>
                        <td class="align-middle">{{$requestedBook->user->username}}</td>
                        <td class="align-middle">
                            @if ($requestedBook->status == 'PENDING')
                              <span class="badge bg-warning text-light p-3">{{ $requestedBook->status }}</span>
                            @elseif ($requestedBook->status == 'APPROVED')
                              <span class="badge bg-success text-light p-3">{{ $requestedBook->status }}</span>
                            @else 
                              <span class="badge bg-danger text-light p-3">{{ $requestedBook->status }}</span>
                            @endif
                
                          </td>
                        <td class="align-middle">
                            <div class="flex text-center">
                                
                                <button 
                                    type="button" 
                                    class="btn btn-secondary text-white" 
                                    id="btn_approve"
                                    data-id="{{$requestedBook->id}}"
                                    data-status="APPROVED"
                                    >
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Approve</span>
                                </button>


                                <button type="button" 
                                    class="btn btn-danger text-white" 
                                    id="btn_deny" 
                                    data-id="{{$requestedBook->id}}"
                                    data-status="DENIED"
                                    >
                                    <i class="fa-solid fa-trash"></i>
                                    <span>Deny</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script>
    $(function () {
        let table = new DataTable('#table');
        let status = null;
        let id = null;

        $('#table #btn_approve').on('click', function () {
            status = $(this).data('status');
            id = $(this).data('id');
    
            update(status, id)
        })

        $('#table #btn_deny').on('click', function () {
            status = $(this).data('status');
            id = $(this).data('id');

            update(status, id)
        })

        function update(status, id) {

            let data = {
                'status': status,
                'id': id,
            }

            axios.post("{{ route('admin.requestedbooks.approveOrDisapprove')}}", data)
            .then(res => {
                location.reload();
            })
            .catch(err => {
                console.error(err.message); 
            })
        }

    })
</script>