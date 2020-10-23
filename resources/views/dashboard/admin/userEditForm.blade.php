@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Edit') }} {{ $user->name }}</div>
                    <div class="card-body">
                        <br>
                        <form method="POST" action="/users/{{ $user->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" placeholder="{{ __('Name') }}" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ $user->email }}" required>
                            </div>
                            @if(Auth::user()->hasRole('admin') && $you->id !== $user->id)
                            <div class="form-group">
                              <label>Role</label>
                              <select class="form-control" name="role">
                                <option value="admin" {{$user->hasRole('admin') ? 'selected':''}}>Admin</option>
                                <option value="event_manager" {{$user->hasRole('event_manager') && $user->roles()->count() == 2 ? 'selected':''}}>Event Manager</option>
                                <option value="bourse_manager" {{$user->hasRole('bourse_manager') && $user->roles()->count() == 2 ? 'selected':''}}>Bourse Manager</option>
                                <option value="conference_manager" {{$user->hasRole('conference_manager') && $user->roles()->count() == 2 ? 'selected':''}}>Conference Manager</option>
                                <option value="user" {{$user->roles()->count() == 1  ? 'selected':''}}>No Role</option>
                              </select>
                            </div>
                            @endif
                            <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                        </form>
                    </div>
                </div>
              </div>
              @if($user->events->count()>0)
              <div class="col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Events') }}
                		</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($user->events as $event)
                            <tr>
                              <td><strong>{{ $event->title }}</strong></td>
                              <td>{{ $event->date }}</td>
                              <td><strong>{{ $event->type }}</strong></td>
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
                    </div>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection
