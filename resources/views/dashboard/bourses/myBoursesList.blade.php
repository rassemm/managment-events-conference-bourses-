@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('My Bourses') }}
                		</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Place</th>
                            <th>Age</th>
                            <th>Moyenne</th>
                            <th>Graduation</th>
                            <th>Tel</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($bourses as $bourse)
                            <tr>
                              <td><strong>{{ \App\User::find($bourse->user_id)->name }}</strong></td>
                              <td><strong>{{ $bourse->title }}</strong></td>
                              <td><strong>{{ $bourse->place }}</strong></td>
                              <td><strong>{{ $bourse->app->age }}</strong></td>
                              <td><strong>{{ $bourse->app->moyenne }}</strong></td>
                              <td><strong>{{ $bourse->app->graduation }}</strong></td>
                              <td><strong>{{ $bourse->app->tel }}</strong></td>
                              <td><strong>{{ $bourse->app->status }}</strong></td>
                              <td>
                                <a href="{{ url('/bourses/' . $bourse->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
