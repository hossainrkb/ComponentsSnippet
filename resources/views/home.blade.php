<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">

    <title>Laravel AJAX Pagination with JQuery</title>
<style>
    td{
        border: 1px solid black
    }
    table{
        border-collapse: collapse
    }
</style>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <h1>Posts</h1>

{{-- <table class="posts">
    @forelse ($users as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
        </tr>
    @empty
        
    @endforelse
    <tr>
        <td colspan="2">
            {!!  $users->links()  !!}
        </td>
    </tr>
</table> --}}
<div class="posts">
@foreach ($users as $post)

   {{ $post->name }}

@endforeach
</div>
{{ $users->links()  }}

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }
    });
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getPosts(page) {
        $.ajax({
            url : 'http://127.0.0.1:8000/home?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            console.log(data)
            // alert("in")
            var posts = document.querySelector(".posts");
            posts.innerHTML = "";
            (data.users.data).forEach(element => {
                var textContent = document.createTextNode(element.name);
                var br = document.createElement("br");
                // posts.innerHTML = element.name
                posts.append(textContent,br)
            });
            // posts.appendChild(data)
            // $('.posts').html(data);
            location.hash = page;
        }).fail(function (error) {
            console.log(error);
            alert('Posts could not be loaded.');
        });
    }
    </script> 

</body>
</html>