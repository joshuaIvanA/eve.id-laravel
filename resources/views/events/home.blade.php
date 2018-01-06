<?php
/**
 * Created by PhpStorm.
 * User: Joshua_123
 * Date: 04/01/2018
 * Time: 2:00
 */?>
@extends('layouts.app')

@section('content')
    <style>
        .event h2:hover{
            cursor: pointer;
        }
        #logo{
            -webkit-filter: invert(100%);
            filter: invert(100%);
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-nav>li>a{
            color: #FFFFFF;
        }
        .navbar{
            margin: 0;
            width: 100%;
            border-radius: 0;
            background-color: transparent;
            position: fixed;
        }
        .jumbotron{
            background: url("{{asset('/img/background.jpg')}}") fixed center;
            background-size: cover;
            height: 25%;
        }
        .icons{
            margin: 20px;
            display: inline-block;
            color: #FFFFFF;
            font-size: 50px;
        }
        #events{
            color:#2e3436;
        }
        .borderless td, .borderless th, .borderless tr{
            border:none !important;
        }
        h3{
            padding: 10px;
        }
    </style>

    <div class="jumbotron" style="margin-bottom: 0">
        <div class="container text-center" style="margin-top: 50px">
            <h1 style="color: #FFFFFF">All of your Event</h1>

                <form class="form-horizontal" action="{{url('/search')}}" method="post">
                {{csrf_field()}}
                <div class="form-group has-feedback">
                    <div class="col-md-6 col-md-offset-3">
                        <input id="input-search" name="input_search" class="form-control" type="text" placeholder="Search">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </div>
            </form>
            <div class="icons">
                <span class="glyphicon glyphicon-plane"></span>
                <h5>Travel</h5>
            </div>
            <div class="icons">
                <span class="glyphicon glyphicon-globe"></span>
                <h5>World</h5>
            </div>
            <div class="icons">
                <span class="glyphicon glyphicon-user"></span>
                <h5>Community</h5>
            </div>
        </div>
    </div>

    <div id="events" class="container-fluid text-center" style="padding-bottom: 30px; background-color: #2e3436">
        @if(empty($search))
            <h3 style="color: #FFFFFF">All Events</h3>
        @else
            <h3 style="color: #FFFFFF">Results "{{$search}}"</h3>
        @endif
     <div class="container-fluid text-center">
        <div id="events" class="col-md-10 col-md-offset-2">
            {{--insert events here--}}
            @foreach($events as $event)
                <div class="col-md-3 event" style=" margin: 10px; padding: 0;
                        background: url({{asset('img/event/'.$event->image)}}) no-repeat center;">
                    <div style="height: 250px;  background-color: rgba(52, 50, 94, 0.75);padding: 15px">
                        <h2 data-toggle="modal" data-target="#{{$event->event_id}}"
                           style="color: #FFFFFF; text-wrap: initial">{{$event->title}}</h2>
                    </div>
                </div>
            @endforeach
            {{--end of loop--}}
        </div>
        {{$events->links()}}
    </div>
</div>
<footer class="container-fluid text-center">
    <p>Copyright <i>&copy;</i> eve.id 2017</p>
</footer>

@foreach($events as $event)
<div id="{{$event->event_id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{$event->title}}</h4>
            </div>
            <div class="modal-body">
                <table class="table borderless">
                    <tr>
                        <td rowspan="3" style="padding-top: 30px"><img src="{{asset('img/event/'.$event->image)}}" alt="" height="300px" width="200px"></td>
                        <td><p>{!! $event->description !!}</p></td>
                    </tr>
                    <tr>
                        <td><p>{{$event->contact}}</p></td>
                    </tr>
                    <tr>
                        <td><a href="{{$event->registration}}">REGISTER NOW!</a></td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection