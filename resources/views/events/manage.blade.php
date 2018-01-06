<?php
/**
 * Created by PhpStorm.
 * User: Joshua_123
 * Date: 03/01/2018
 * Time: 11:59
 */?>
@extends('layouts.app')

@section('content')
    <style>
        .navbar{
            margin: 0;
            width: 100%;
            border-radius: 0;
        }
    </style>
    <div class="container-fluid">
        <div class="row" style="background-color: #2e3436; padding-top: 30px;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(Auth::user())
                            <h2>Manage Events</h2>
                            <a href="{{url('/manage/insert/'.Auth::user()->id)}}">Insert</a>
                        @endif
                    </div>

                    <div class="panel-body">
                        @foreach($events as $event)
                            <div class="col-md-3 col-sm-3" style="margin-bottom:10px; padding:5px 0;" >
                                <img src="{{asset('img/event/'.$event->image)}}" style="height:150px; width: 100px;" alt="">
                                <div class="col-md-2">
                                    <form action="{{url('/events/delete/'.$event->event_id)}}" method="post" style="float: left">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                    <form action="{{url('/manage/edit/'.$event->event_id)}}" method="get">
                                        <button class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="panel-footer text-center">
                        &copy; eve.id 2017
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

