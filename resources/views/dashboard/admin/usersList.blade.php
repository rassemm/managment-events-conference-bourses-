@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Admins') }}</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($admins->count() > 0)
                            @foreach($admins as $user)
                              <tr>
                                <th>{{ $user->id }}</th>
                                <td><b>{{ $user->name }}</b></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                  @foreach($user->roles as $role)
                                    <span class="badge badge-secondary" style=" font-size: 0.75rem">{{$role->name}}</span>
                                  @endforeach
                                </td>
                                <td>
                                  <a href="{{ url('/users/' . $user->id) }}" class="btn btn-sm btn-block btn-primary">View</a>
                                </td>
                                <td>
                                  <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-sm btn-block btn-success">Edit</a>
                                </td>
                                <td>
                                  @if( $you->id !== $user->id )
                                  <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button class="btn btn-block btn-sm btn-danger">Delete</button>
                                  </form>
                                  @endif
                                </td>
                                <td>
                                  @if( $you->id !== $user->id )
                                  <form method="POST" action="/users/{{ $user->id }}">
                                      @csrf
                                      @method('PUT')
                                      <input name="role" value="removeAdmin" hidden/>
                                      <button class="btn btn-block btn-sm btn-danger">Remove Admin</button>
                                  </form>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          @else
                          <tr><td colspan="9" style="text-align:center">There is no admins</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Event Managers') }}</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($event_managers->count() > 1)
                          @foreach($event_managers as $user)
                            @if(!$admins->contains($user))
                            <tr>
                              <th>{{ $user->id }}</th>
                              <td><b>{{ $user->name }}</b></td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @foreach($user->roles as $role)
                                  <span class="badge badge-secondary" style=" font-size: 0.75rem">{{$role->name}}</span>
                                @endforeach
                              </td>
                              <td>
                                <a href="{{ url('/users/' . $user->id) }}" class="btn btn-sm btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-sm btn-block btn-success">Edit</a>
                              </td>
                              <td>
                                @if( $you->id !== $user->id )
                                <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-sm btn-danger">Delete</button>
                                </form>
                                @endif
                              </td>
                            </tr>
                            @endif
                          @endforeach
                          @else
                          <tr><td colspan="9" style="text-align:center">There is no event managers</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Bourse Managers') }}</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($bourse_managers->count() > 1)
                          @foreach($bourse_managers as $user)
                            @if(!$admins->contains($user))
                            <tr>
                              <th>{{ $user->id }}</th>
                              <td><b>{{ $user->name }}</b></td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @foreach($user->roles as $role)
                                  <span class="badge badge-secondary" style=" font-size: 0.75rem">{{$role->name}}</span>
                                @endforeach
                              </td>
                              <td>
                                <a href="{{ url('/users/' . $user->id) }}" class="btn btn-sm btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-sm btn-block btn-success">Edit</a>
                              </td>
                              <td>
                                @if( $you->id !== $user->id )
                                <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-sm btn-danger">Delete</button>
                                </form>
                                @endif
                              </td>
                            </tr>
                            @endif
                          @endforeach
                          @else
                          <tr><td colspan="9" style="text-align:center">There is no bourse managers</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Conference Managers') }}</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($conference_managers->count() > 1)
                            @foreach($conference_managers as $user)
                              @if(!$admins->contains($user))
                              <tr>
                                <th>{{ $user->id }}</th>
                                <td><b>{{ $user->name }}</b></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                  @foreach($user->roles as $role)
                                    <span class="badge badge-secondary" style=" font-size: 0.75rem">{{$role->name}}</span>
                                  @endforeach
                                </td>
                                <td>
                                  <a href="{{ url('/users/' . $user->id) }}" class="btn btn-sm btn-block btn-primary">View</a>
                                </td>
                                <td>
                                  <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-sm btn-block btn-success">Edit</a>
                                </td>
                                <td>
                                  @if( $you->id !== $user->id )
                                  <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button class="btn btn-block btn-sm btn-danger">Delete</button>
                                  </form>
                                  @endif
                                </td>
                              </tr>
                              @endif
                            @endforeach
                          @else
                          <tr><td colspan="9" style="text-align:center">There is no conference managers</td></tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Users') }}</div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Roles</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          @if(!$admins->contains($user) && !$bourse_managers->contains($user) && !$event_managers->contains($user) && !$conference_managers->contains($user))
                            <tr>
                              <th>{{ $user->id }}</th>
                              <td><b>{{ $user->name }}</b></td>
                              <td>{{ $user->email }}</td>
                              <td>
                                @foreach($user->roles as $role)
                                  <span class="badge badge-secondary" style=" font-size: 0.75rem">{{$role->name}}</span>
                                @endforeach
                              </td>
                              <td>
                                <a href="{{ url('/users/' . $user->id) }}" class="btn btn-sm btn-block btn-primary">View</a>
                              </td>
                              <td>
                                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-sm btn-block btn-success">Edit</a>
                              </td>
                              <td>
                                @if( $you->id !== $user->id )
                                <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-block btn-sm btn-danger">Delete</button>
                                </form>
                                @endif
                              </td>
                            </tr>
                            @endif
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
