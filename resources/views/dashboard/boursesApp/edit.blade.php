@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Edit') }}: {{ $bourse->title }}</div>
                    <div class="card-body">
                        <form method="POST" action="/bourses/{{ $bourse->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col">
                                    <label>Title</label>
                                    <input class="form-control" type="text" placeholder="{{ __('Title') }}" name="title" value="{{ $bourse->title }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Content</label>
                                    <textarea class="form-control" id="textarea-input" name="content" rows="9" placeholder="{{ __('Content..') }}" required>{{ $bourse->content }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Place</label>
                                    <input type="date" class="form-control" name="place" value="{{ $bourse->place }}" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>Aplication Start Date</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ $bourse->start_date }}" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col">
                                    <label>bourse type</label>
                                    <input class="form-control" type="text" placeholder="{{ __('bourse type') }}" name="type" value="{{ $bourse->type }}" required>
                                </div>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Save') }}</button>
                            <a href="/bourses" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                        </form>
                    </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-8">
                <div class="card">
                                <div class="card-header">
                                  <i class="fa fa-align-justify"></i>{{ __('Subscribed Users') }}
                                  @if($bourse->status == 'unpublished')
                                  <form method="POST" action="/bourses/publish/{{$bourse->id}}" class="float-right">
                                      @csrf
                                      @method('PUT')
                                      <button class="btn btn-success"  type="submit">publish</button>
                                  </form>
                                  @else
                                  <form method="POST" action="/bourses/unpublish/{{$bourse->id}}" class="float-right">
                                      @csrf
                                      @method('PUT')
                                      <button class="btn btn-danger"  type="submit">unpublish</button>
                                  </form>
                                  @endif
                                  </div>
                                <div class="card-body">
                                    <table class="table table-responsive-sm table-striped">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($users as $key => $user)
                                        <tr>
                                          <th>{{ ++$key }}</th>
                                          <td><b>{{ $user->name }}</b></td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ $user->status }}</td>
                                          <td>
                                            @if($user->status != 'approved')
                                              <form method="POST" action="/bourses/approve/{{$user->id}}/{{$bourse->id}}">
                                                  @csrf
                                                  @method('PUT')
                                                  <button class="btn btn-success"  type="submit">Approve</button>
                                              </form>
                                            @else
                                              <form method="POST" action="/bourses/unapprove/{{$user->id}}/{{$bourse->id}}">
                                                  @csrf
                                                  @method('PUT')
                                                  <button class="btn btn-danger"  type="submit">Unapprove</button>
                                              </form>
                                            @endif
                                            </td>
                                            <td>
                                            @if($user->status == 'pending')

                                            <form method="POST" action="/bourses/remove/{{$user->id}}/{{$bourse->id}}">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-danger"  type="submit">Remove</button>
                                            </form>
                                            @endif
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
