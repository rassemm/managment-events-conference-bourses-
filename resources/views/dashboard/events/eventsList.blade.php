@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Events') }}
                			<a href="{{ route('events.create') }}" class="btn btn-primary m-2 float-right">
                        {{ __('Add Event') }}
                      </a>
                		</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th></th>
                            <th></th>
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
                              <td>
                                <a href="{{ url('/events/' . $event->id) }}" class="btn btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/events/' . $event->id . '/edit') }}" class="btn btn-block btn-primary">Edit</a>
                              </td>
                              <td>
                                <form action="{{ route('events.destroy', $event->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-danger">Delete</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {{ $events->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
