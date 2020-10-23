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
                            <th>Content</th>
                            <th>Place</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($bourses as $bourse)
                            <tr>
                              <td><strong>{{ \App\User::find($bourse->user_id)->name }}</strong></td>
                              <td><strong>{{ $bourse->title }}</strong></td>
                              <td>{{ \Illuminate\Support\Str::limit($bourse->content, 50, $end='...') }}</td>
                              <td><strong>{{ $bourse->place }}</strong></td>
                              <td><strong>{{ $bourse->status }}</strong></td>
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
