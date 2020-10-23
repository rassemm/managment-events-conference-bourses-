@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('Create Bourse') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bourses.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label>Title</label>
                                <input class="form-control" type="text" placeholder="{{ __('Title') }}" name="title" required autofocus>
                            </div>

                            <div class="form-group row">
                                <label>Content</label>
                                <textarea class="form-control" id="textarea-input" name="content" rows="9" placeholder="{{ __('Content..') }}" required></textarea>
                            </div>

                            <div class="form-group row">
                                <label>Place</label>
                                <input type="text" class="form-control" name="place" required/>
                            </div>

                            <div class="form-group row">
                                <label>Aplication Start Date</label>
                                <input type="date" class="form-control" name="start_date" required/>
                            </div>

                            <div class="form-group row">
                                <label>Aplication End Date</label>
                                <input type="date" class="form-control" name="end_date" required/>
                            </div>

                            <button class="btn btn-block btn-success" type="submit">{{ __('Add') }}</button>
                            <a href="{{ route('bourses.index') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
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
