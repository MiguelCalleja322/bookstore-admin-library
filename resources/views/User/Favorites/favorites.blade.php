@include('User.Header.nav')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="container p-5">
  <div class="flex justify-content-between">
    <h1 class="mb-5">
      List of Favorite Books
    </h1>
  </div>
  <div>
    <table class="table" id="table">
      <thead>
        <tr>
          <th scope="col">Book Name</th>
          <th scope="col">Author</th>
          <th scope="col">Book Cover</th>
          <th scope="col">Date Added</th>
        </tr>
      </thead>
      <tbody>
        @foreach($favorites as $favorite)
        <tr>
          <td class="align-middle">{{ $favorite->book->book_name }}</td>
          <td class="align-middle">{{ $favorite->book->book_author }}</td>
          <td class="align-middle"><img src="{{ $favorite->book->book_cover }}" alt="" width="100" height="150"></td>
          <td class="align-middle">{{ $favorite->created_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(function () {
      let table = new DataTable('#table');
  });
</script>