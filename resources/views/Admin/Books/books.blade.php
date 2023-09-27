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
            Book Admin Library
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
        <button type="button" class="btn btn-success" id="open-store-modal">Create Book</button>
        <button type="button" class="btn btn-primary" id="open-import-modal">Import Book</button>
        <a type="button" class="btn btn-secondary" id="open-import-secondary" href="{{ route('admin.book.export') }}">Export</a>
    </div>

    <div class="p-4 border border-secondary">
        <table class="table" id="table">
            <thead>
                <tr class="text-center">
                    <th scope="col" width="25%">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td class="m-auto">{{$book->book_name}}</td>
                        <td class="m-auto">{{$book->book_author}}</td>
                        <td>
                            <img src="{{$book->book_cover}}" alt="" width="150" height="200">
                        </td>
                        <td class="m-auto">{{$book->stocks}}</td>
                        <td class="">
                            <div class="flex text-center">
                                
                                <button 
                                    type="button" 
                                    class="btn btn-secondary text-white" 
                                    id="open-view-modal"
                                    data-name="{{$book->book_name}}"
                                    data-author="{{$book->book_author}}"
                                    data-cover="{{$book->book_cover}}"
                                    data-stock="{{$book->stocks}}">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>View</span>
                                </button>

                                <button 
                                    type="button" 
                                    class="btn btn-primary text-white" 
                                    id="open-update-modal"
                                    data-id="{{$book->id}}"
                                    data-name="{{$book->book_name}}"
                                    data-author="{{$book->book_author}}"
                                    data-cover="{{$book->book_cover}}"
                                    data-stock="{{$book->stocks}}">
                                    <i class="fa-solid fa-pen-nib"></i>
                                    <span>Update</span>
                                </button>

                                <button type="button" class="btn btn-danger text-white" id="destroy" data-id="{{$book->id}}">
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


@include('Admin.Books.modals.view')
@include('Admin.Books.modals.update')
@include('Admin.Books.modals.store')
@include('Admin.Books.modals.import')

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
            let author = $(this).data("author");
            let cover = $(this).data("cover");
            let stocks = $(this).data("stock");
        
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
            let author = $(this).data("author");
            let cover = $(this).data("cover");
            let stocks = $(this).data("stock");

            $('#update-modal #name').val(name);
            $('#update-modal #author').val(author);
            $('#update-modal #cover').val(cover);
            $('#update-modal #stock').val(stocks);
            $('#update-modal').modal('toggle');
        });

        $('#update-modal #close-modal').on('click', function () {
            $('#update-modal').modal('hide');
        })

        $('#update-modal #update').on('click', function () {
            
            let bookID = id; 
            let name = $('#update-modal #name').val();
            let author = $('#update-modal #author').val();
            let cover = $('#update-modal #cover').val();
            let stocks = $('#update-modal #stock').val();

            let data = {
                'id': bookID,
                'book_name': name,
                'book_author': author,
                'book_cover': cover,
                'stock': stocks,
            };
            
            axios.post("{{ route('admin.book.update')}}", data)
            .then(res => {
                location.reload();
            })
            .catch(err => {
                console.error(err.message); 
            })
        })

        //store

        $('#open-store-modal').on('click', function (e) {
            $('#store-modal').modal('toggle');
        });

        $('#store-modal #close-modal').on('click', function () {
            $('#store-modal #error-message').addClass('hidden');
            $('#store-modal').modal('hide');
        });

        $('#store-modal #store').on('click', function () {
            let name = $('#store-modal #name').val();
            let author = $('#store-modal #author').val();
            let cover = $('#store-modal #cover').val();
            let stocks = $('#store-modal #stock').val();

            if (name == '' || author == '' || cover == '') {
                $('#store-modal #error-message').removeClass('hidden');
                $('#store-modal #error-message span').text('Name, Author and Cover must not be empty');
                return;
            }

            let data = {
                'book_name': name,
                'book_author': author,
                'book_cover': cover,
                'stocks': stocks,
            };
            
            axios.post("{{ route('admin.book.store')}}", data)
            .then(res => {
                location.reload();
            })

            .catch(err => {
                $('#store-modal #error-message').removeClass('hidden');
                $('#store-modal #error-message span').text(err.message);
            })
        });

        //delete

         //update

         $('#table #destroy').on('click', function (e) {
            id = $(this).data("id");
            
            axios.post("{{ route('admin.book.delete') }}", {
                book_id: id
            })

            .then(res => {
                location.reload();
            })

            .catch(err => {
                $('#error-message').removeClass('hidden');
                $('#error-message span').text(err.message);
            })
        });

        //open-import-modal

        $('#open-import-modal').on('click', function (e) {
            $('#import-modal').modal('toggle');
        });

        $('#open-import #close-modal').on('click', function () {
            $('#import-modal').modal('hide');
        });
    });

   
</script>