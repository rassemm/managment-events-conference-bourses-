@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('My Events') }}
                		</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($events as $event)
                            <tr>
                              <td><strong>{{ \App\User::find($event->user_id)->name }}</strong></td>
                              <td><strong>{{ $event->title }}</strong></td>
                              <td>{{ $event->date }}</td>
                              <td><strong>{{ $event->type }}</strong></td>
                              <td><strong>{{ $event->status }}</strong></td>
                              <td>
                                <a href="{{ url('/events/' . $event->id) }}" class="btn btn-block btn-primary">View</a>
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
