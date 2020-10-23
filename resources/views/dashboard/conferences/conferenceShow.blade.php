@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                  <i class="fa fa-align-justify"></i>Conference: {{ $conference->title }}
                </div>
                  <div class="card-body">
                      <h5>Author: {{ \App\User::find($conference->user_id)->name }}</h5>
                      <h5>Title: {{ $conference->title }}</h5>
                      <h5>Content:</h5>
                      <p>{!! $conference->content !!}</p>
                      <h5>Date: {{ $conference->date }} </h5>
                      <h5>Type: {{ $conference->place }}</h5>
                      <br>
                      <div class="text-center">
                        @if(!Auth::user()->isSubscribedConference($conference->id))
                          <form method="POST" class="btn" action="/conferences/subscribe/{{$conference->id}}">
                              @csrf
                              @method('PUT')
                              <button class="btn btn-success"  type="submit">Subscribe</button>
                          </form>
                        @else
                        <button class="btn btn-danger">Subscribed</button>
                        @endif
                        <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('Return') }}</a>
                      </div>
                      <br>
                  </div>
                </div>
              </div>
              @if($conference->status == 'published')
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                  <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('Participing Users') }}
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Username</th>
                            <th>E-mail</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $key => $user)
                            @if($user->status == 'approved')
                            <tr>
                              <th>{{ ++$key }}</th>
                              <td><b>{{ $user->name }}</b></td>
                              <th>{{ $user->email }}</th>
                            </tr>
                            @endif
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
