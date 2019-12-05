<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .m-b-md {
                margin-top:50px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            
            <div class="content">
                <div class="title m-b-md">
                    Scrabble
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{url('/')}}" method="post" enctype = "multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">Enter letters</label>
                        <input type="text" name="letters" class="form-control" id="input-letters" placeholder="Enter letters">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

                
            </div>
        

            @if(isset($words_sum))
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Word</th>
                        <th scope="col">Points</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($words_sum as $word)
                        <tr>
                            <td>{{ $word[0] }}</td>
                            <td>{{ $word[1] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
