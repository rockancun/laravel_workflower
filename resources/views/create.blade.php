<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            
            <div style="margin: 30px 0px">
                <h1>Create pullrequest</h1>
            </div>

            <div class="card mb-5">
                <div class="card-body">

                  <form action="{{route('create')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Title</label>
                      <input class="form-control" name="title" id="title" type="text" placeholder="">
                    </div>

                    <button class="btn btn-primary">Create</button>
                  </form>

                </div>
            </div>
        </div>
    </body>
</html>
