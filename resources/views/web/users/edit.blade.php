@extends('web.layouts.app')

@section('title', $user->name . ' - 编辑资料')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h4><i class="fa fa-edit"></i> 编辑个人资料</h4>
        </div>

        <div class="card-body">
          <form action="{{ route('users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label for="name-field" class="col-sm-4 col-form-label text-md-right">用&ensp;户&ensp;名</label>

              <div class="col-md-6">
                <input id="name-field" type="text"
                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                       name="name" value="{{ old('name', $user->name) }}">
                @if ($errors->has('name'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="email-field" class="col-sm-4 col-form-label text-md-right">邮&emsp;&emsp;箱</label>

              <div class="col-md-6">
                <input id="email-field" type="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email', $user->email) }}">
                @if ($errors->has('email'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="introduction-field" class="col-md-4 col-form-label text-md-right">个人简介</label>

              <div class="col-md-6">
              <textarea id="introduction-field"
                        class="form-control{{ $errors->has('introduction') ? ' is-invalid' : '' }}"
                        name="introduction"
              >{{ old('introduction', $user->introduction) }}</textarea>
                @if ($errors->has('introduction'))
                  <span class="invalid-feedback">
                  <strong>{{ $errors->first('introduction') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-outline-primary">
                  <i class="fa fa-save"></i> 保存
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop
