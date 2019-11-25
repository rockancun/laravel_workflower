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
                <h1>Approve pullrequest</h1>
            </div>

            <div class="card mb-5">
                <div class="card-body">

                  <form action="{{route('review')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="title">Title</label>
                        <input class="form-control" name="title" id="title" type="text" placeholder="" value="{{$pull_request->title}}">
                        <input type="hidden" id="id" name="id" value="{{$pull_request->id}}">
                    </div>
                    <div class="form-group">
                        <label for="approved">Approve</label>
                        <select class="form-control" id="approved" name="approved">
                          <option value="1">Accept</option>
                          <option value="0">Reject</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Enviar</button>
                  </form>

                </div>
            </div>
        </div>
    </body>
</html>
