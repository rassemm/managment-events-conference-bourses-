@extends('dashboard.base')

@section('content')
          <div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                @foreach($events as $event)
                  <div class="col-sm-6 col-lg-4">
                    <div class="card text-center item">
                      <div class="card-header">
                        <div class="btn float-left">{{ $event->type }}</div>
                        <button class="btn btn-secondary float-right"  type="submit">Event</button>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title tit">{{ \Illuminate\Support\Str::limit($event->title, 35) }}</h5>
                        <hr/>
                        <p class="card-text">{!! \Illuminate\Support\Str::limit($event->content, 150, $end='...') !!}</p>
                        <p><b>By {{ \App\User::find($event->user_id)->name }}</b></p>
                        <a href="{{ url('/events/' . $event->id) }}" class="btn btn-primary">View</a>
                          @if(!Auth::user()->isSubscribedEvent($event->id))
                            <form method="POST" class="btn" action="/events/subscribe/{{$event->id}}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success"  type="submit">Subscribe</button>
                            </form>
                          @else
                          <button class="btn btn-danger">Subscribed</button>
                          @endif
                      </div>
                      <div class="card-footer text-muted">
                        {{ $event->date }}
                      </div>
                    </div>
                  </div>
                @endforeach
                @foreach($conferences as $conference)
                  <div class="col-sm-6 col-lg-4">
                    <div class="card text-center item">
                      <div class="card-header">
                        <div class="btn float-left">{{ $conference->place }}</div>
                        <button class="btn btn-secondary float-right"  type="submit">Conference</button>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title tit">{{ \Illuminate\Support\Str::limit($conference->title, 35, $end='...') }}</h5>
                        <hr/>
                        <p class="card-text">{!! \Illuminate\Support\Str::limit($conference->content, 150, $end='...') !!}</p>
                        <p><b>By {{ \App\User::find($conference->user_id)->name }}</b></p>
                        <a href="{{ url('/conferences/' . $conference->id) }}" class="btn btn-primary">View</a>
                          @if(!Auth::user()->isSubscribedconference($conference->id))
                            <form method="POST" class="btn" action="/conferences/subscribe/{{$conference->id}}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-success"  type="submit">Subscribe</button>
                            </form>
                          @else
                          <button class="btn btn-danger">Subscribed</button>
                          @endif
                      </div>
                      <div class="card-footer text-muted">
                        {{ $conference->date }}
                      </div>
                    </div>
                  </div>
                @endforeach
                @foreach($bourses as $bourse)
                  <div class="col-sm-6 col-lg-4">
                    <div class="card text-center item">
                      <div class="card-header">
                        <div class="btn float-left">{{ $bourse->place }}</div>
                        <button class="btn btn-secondary float-right"  type="submit">Bourse</button>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title tit">{{ \Illuminate\Support\Str::limit($bourse->title, 35) }}</h5>
                        <hr/>
                        <p class="card-text">{!! \Illuminate\Support\Str::limit($bourse->content, 150, $end='...') !!}</p>
                        <p><b>By {{ \App\User::find($bourse->user_id)->name }}</b></p>
                        <a href="{{ url('/bourses/' . $bourse->id) }}" class="btn btn-primary">View</a>
                          @if(!Auth::user()->isSubscribedBourse($bourse->id))
                          <a class="btn btn-success" href="/apply/{{$bourse->id}}">
                            Apply
                          </a>
                          @else
                          <button class="btn btn-danger">Applied</button>
                          @endif
                      </div>
                      <div class="card-footer text-muted">
                        {{ $bourse->start_date }}-{{ $bourse->end_date }}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

@endsection

@section('javascript')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
