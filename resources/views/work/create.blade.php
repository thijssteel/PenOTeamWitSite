@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new log item</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('works.store')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('task') ? ' has-error' : '' }}">
                            <label for="task" class="col-md-4 control-label">Task</label>

                            <div class="col-md-6">
                                <select id="task" class="form-control" name="task">
                                    <option></option>
                                    @foreach($tasks as $task)
                                        <option value="{{$task->id}}">{{$task->title}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('task'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('task') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                            <label for="user" class="col-md-4 control-label">User</label>

                            <div class="col-md-6">
                                <select id="user" class="form-control" name="user">
                                    <option></option>
                                    @foreach($users as $user)
                                        @if($user->id == $currentuser->id)
                                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('started_at') ? ' has-error' : '' }}">
                            <label for="started_at" class="col-md-4 control-label">Started At</label>

                            <div class="col-md-6">
                                <input type="time" id="started_at" class="form-control" name="started_at" value="{{ date('H:i',time()+60*60) }}">

                                @if ($errors->has('started_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('started_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ended') ? ' has-error' : '' }}">
                            <label for="ended" class="col-md-4 control-label">Ended At</label>

                            <div class="col-md-6">
                                <input type="time" id="ended_at" class="form-control" name="ended_at" value="{{ date('H:i',time()+60*60) }}">

                                @if ($errors->has('ended_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ended_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Date</label>

                            <div class="col-md-6">
                                <input type="date" id="date" class="form-control" name="date" value="{{ date('Y-m-j') }}">

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Opslaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
