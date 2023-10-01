@include('User.Header.nav')

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
            Welcome to Books
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
        <a type="button" class="btn btn-success" id="open-store-modal">Request a Book</a>
        <a type="button" class="btn btn-primary" id="open-favorites-modal" href="{{route('user.favorites.index')}}">View Favorites Book</a>
        <a type="button" class="btn btn-primary" id="open-favorites-modal" href="{{route('user.requestbook.user_index')}}">View Requested Book</a>
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
                                    class="btn btn-secondary text-white m-1" 
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
                                    class="btn btn-primary text-white m-1" 
                                    id="add_to_favorite"
                                    data-id="{{$book->id}}">
                                    <i class="fa-solid fa-pen-nib"></i>
                                    <span>Add To Favorite</span>
                                </button>
                                
                                <button 
                                    type="button" 
                                    class="btn btn-success text-white m-1" 
                                    id="borrow_book"
                                    data-id="{{$book->id}}">
                                    <i class="fa-solid fa-pen-nib"></i>
                                    <span>Borrow Book</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@include('User.Books.modals.view')
@include('User.Books.modals.store')

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

        //add to fave

        $('#table #add_to_favorite').on('click', function (e) {
            let bookID = $(this).data("id");
    
            let data = {
                'id': bookID,
            };
            
            axios.post("{{ route('user.book.addToFavorite')}}", data)
            .then(res => {
                location.reload();
            })
            .catch(err => {
                console.log(err)

                $('#error-message').removeClass('hidden');
                $('#error-message span').text(err.response.data.error);
            })
        });

        $('#table #borrow_book').on('click', function (e) {
            let bookID = $(this).data("id");
    
            let data = {
                'id': bookID,
            };
            
            axios.post("{{ route('user.book.borrow')}}", data)
            .then(res => {
                location.reload();
            })
            .catch(err => {
                $('#error-message').removeClass('hidden');
                $('#error-message span').text(err.response.data.error);
            })
        });

        //store

        $('#open-store-modal').on('click', function (e) {
            $('#store-modal').modal('toggle');
        });

        $('#store-modal #close-modal').on('click', function () {
            $('#store-modal #error-message').addClass('hidden');
            $('#store-modal').modal('hide');
        });
    });

   
</script>