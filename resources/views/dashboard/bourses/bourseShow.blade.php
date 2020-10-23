@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                  <i class="fa fa-align-justify"></i>Bourse: {{ $bourse->title }}
                </div>
                  <div class="card-body">
                      <h5>Author: {{ \App\User::find($bourse->user_id)->name }}</h5>
                      <h5>Title: {{ $bourse->title }}</h5>
                      <h5>Content:</h5>
                      <p>{!! $bourse->content !!}</p>
                      <h5>Aplication Start Date: {{ $bourse->start_date }} </h5>
                      <h5>Aplication End Date: {{ $bourse->end_date }} </h5>
                      <h5>Place: {{ $bourse->place }}</h5>
                      <br>
                      <div class="text-center">
                        @if(!Auth::user()->isSubscribedBourse($bourse->id))
                          <a class="btn btn-success" href="/apply/{{$bourse->id}}">
                            Apply
                          </a>
                        @else
                        <button class="btn btn-danger">Applied</button>
                        @endif
                        <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('Return') }}</a>
                      </div>
                      <br>
                  </div>
                </div>
              </div>
              @if($bourse->status == 'published')
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
                            @if($user->app->status == 'approved')
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
