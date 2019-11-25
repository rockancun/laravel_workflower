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
                <h1>List de pullrequest</h1>
            </div>

            <div class="card mb-5">

                <div class="card-body">
            
                    <a href="{{route('create')}}" class="btn btn-primary btn-lg active mb-2" role="button" aria-pressed="true">New pullrequest</a>

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">title</th>
                          <th scope="col">state</th>
                          <th scope="col">merged</th>
                          <th scope="col">approved</th>
                          <th scope="col">url</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($pullRequests as $pull_request )
                            <tr>
                              <td>{{ $pull_request->id }}</td>
                              <td>{{ $pull_request->title }}</td>
                              <td>{{ $pull_request->state }}</td>
                              <td>{{ $pull_request->merged }}</td>
                              <td>{{ $pull_request->approved }}</td>
                              <td>
                                <a href=" 
                                {{ $pull_request->state == 'fix-pr' ? route('fix') . '/' . $pull_request->id : ''}}
                                {{ $pull_request->state == 'review-pr' ? route('review') . '/' . $pull_request->id: ''}}
                                ">
                                {{ $pull_request->state == 'fix-pr' ? 'Fix' : ''}}
                                {{ $pull_request->state == 'review-pr' ? 'Review': ''}}
                                {{ $pull_request->state == 'EndEvent_0fiy5ns' ? 'Merged': ''}}
                                </a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
