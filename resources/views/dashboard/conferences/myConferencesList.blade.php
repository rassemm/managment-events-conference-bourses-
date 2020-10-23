@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('My Conferences') }}
                		</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Place</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($conferences as $conference)
                            <tr>
                              <td><strong>{{ \App\User::find($conference->user_id)->name }}</strong></td>
                              <td><strong>{{ $conference->title }}</strong></td>
                              <td>{{ $conference->date }}</td>
                              <td><strong>{{ $conference->place }}</strong></td>
                              <td><strong>{{ $conference->status }}</strong></td>
                              <td>
                                <a href="{{ url('/conferences/' . $conference->id) }}" class="btn btn-block btn-primary">View</a>
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
