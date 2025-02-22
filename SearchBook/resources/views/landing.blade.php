<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SearchBook</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <script>
    $(document).ready(function() {
        $("#search").click(function(){
            var cari = $("#cari").val();
            var rank = $("#rank").val();
            $.ajax({
                url:'/search?q='+cari+'&rank='+rank,
                dataType : "json",
                success: function(data){
                         $('#content').html(data);
                    },
                    error: function(data){
                        alert("Please insert your command");
                    }
            });
        });
    });
</script>

</head>
<body>

    <header class="fixed-top">
        <nav style="background-image: linear-gradient( 111.4deg,  #C4D9FF 18.8%, #C5BAFF  100.2% );" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded d-flex justify-content-between">
            <a class="navbar-brand ms-5" href="#" style="font-family: Lucida Sans">
                <div class="d-flex justify-content-center">
                    <i class="fa-solid fa-book mt-1 fs-3 me-2"></i> 
                    <h2>Book Searching</h2>
                </div>
            </a>
            <div class="me-5" style="font-family: Lucida Sans">
                <p>Muhammad Fathan Alizain</p>
                <p>230411100181</p>
            </div>
        </nav>
    </header>

    <main role="main" style="height:200px; background-image: linear-gradient( 111.4deg,  #C4D9FF 18.8%, #C5BAFF 100.2% ); margin-top: 72px;">
        <div class="container pt-5">
            <div>
                <h4>Please Search in this Form!</h4>
            </div>
            <!-- Another variation with a button -->
            <form action="#" method="GET" onsubmit="return false">
            <div class="input-group gap-2">
                <input type="text" class="form-control" placeholder="Search the Book" name="q" id="cari" style="background-color: #EEEDEB">
                <div class="col-lg-1">
                <select class="form-select" name="rank" id="rank" style="background-color: #EEEDEB" >
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                  </select>
                </div>
                <div class="input-group-append">
                <input class="btn btn-primary" id="search" type="submit" value="Search">
                </div>
            </div>
        </form>
        </div>
    </main>

    <div class="row m-4" id="content">
     
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>