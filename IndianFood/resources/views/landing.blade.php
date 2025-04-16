<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Indian Food Engine</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <style>
        div a{
            text-decoration: none;
        }
        div p{
            margin: 0;
            line-height: 1.5;
        }
        div #img-food{
            border-radius: 1000px;
            width: 40px;
            height: 40px;
            object-fit: cover;
            margin-right: 10px;
        }

        #headerimg img {
            width: 100%;           
            height: 100px;           
            object-fit: cover;
            filter:grayscale(100%)      
        }

        #textblue{
            color: #60B5FF;
        }

        #textred{
            color: #E83F25;
        }

        #textorange{
            color: #FFA955;
        }

        #textgreen{
            color: #328E6E;
        }
    </style>
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
    <header>
            <div id="headerimg">
                <img src="https://www.archanaskitchen.com/images/archanaskitchen/1-Author/Pooja_Thakur/Karela_Masala_Recipe-4_1600.jpg" 
                alt="header img">
            </div>

    </header>
    <main role="main" style="height:150px; border-bottom: 0.5px solid grey;">
        <div class="container pt-5" >
            <div class="d-flex gap-4">
                <h4 style="width: 20%;"><span id="textblue">I</span><span id="textgreen">n</span><span id="textblue">d</span><span id="textgreen">i</span><span id="textred">a</span><span id="textblue">n</span> <span id="textblue">F</span><span id="textred">o</span><span id="textorange">o</span><span id="textblue">d</span></h4>
                <div style="width: 100%;">
                    <form action="#" method="GET" onsubmit="return false">
                        <div class="d-flex rounded-pill overflow-hidden shadow-lg" style="border: 1px solid black">
                            <input type="text" class="form-control border-0 rounded-0" placeholder="Search name food" name="q" id="cari" style="background-color: #EEEDEB;">
                            
                            <select class="form-select border-0 rounded-0" name="rank" id="rank" style="background-color: #EEEDEB; width: 70px;">
                                <option value="2">2</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                            </select>
                            
                            <button class="btn rounded-0" id="search" style="background-color: #EEEDEB" type="submit"><i class="fa-solid fa-magnifying-glass" id="textblue"></i></button>
                        </div>
                    </form>
                </div>   
            </div>
            
        </div>
    </main>

    <div class="row m-4 mb-5 p-5" id="content">
     
    </div>

    <footer class="fixed-bottom p-4" style="background-color: #DBDBDB">
        <div class="d-flex justify-content-center">
            <p>&copy; 2025 Muhammad Fathan Alizain/230411100181</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>