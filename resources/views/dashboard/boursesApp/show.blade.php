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
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Create Bourse') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('apply.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" value="{{ $you->name }}" name="name" required autofocus disabled>
                                <input class="form-control" type="text" value="{{ $bourse->id }}" name="id" hidden>
                            </div>
                            <div class="form-group row">
                              <div class="form-group col-6">
                                  <label>Age</label>
                                  <input class="form-control" type="number" name="age" required >
                              </div>
                              <div class="form-group col-6">
                                  <label>Moyenne</label>
                                  <input type="number" class="form-control" name="moyenne" step="0.01" required/>
                              </div>
                            </div>
                            <div class="form-group">
                                <label>Graduation</label>
                                <input type="text" class="form-control" name="graduation" required/>
                            </div>
                            <div class="form-group">
                                <label>Tel</label>
                                <input type="number" class="form-control" name="tel" required/>
                            </div>
                              <button class="btn btn-block btn-success " type="submit">{{ __('Apply') }}</button>
                              <a href="{{ url()->previous() }}" class="btn btn-block btn-primary ">{{ __('Return') }}</a>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
