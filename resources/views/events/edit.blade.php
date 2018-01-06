<?php
/**
 * Created by PhpStorm.
 * User: Joshua_123
 * Date: 04/01/2018
 * Time: 22:38
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
        <div class="row" style="background-color: #2e3436; padding-top: 30px">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Edit Event</h2></div>
                        <div class="panel-body">
                            <form action="{{url('/events/edit/'.$event->event_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Event Title: </td>
                                        <td colspan="2">
                                            <input type="text" class="form-control" name="event_title" value="{{$event->title}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Event Description: </td>
                                        <td colspan="2">
                                            <textarea id="ckeditor" class="form-control" name="event_desc" style="height: 70px">{{$event->description}}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Event Contact: </td>
                                        <td colspan="2">
                                            <input type="text" class="form-control" name="event_contact" value="{{$event->contact}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Event Registration: </td>
                                        <td colspan="2">
                                            <input type="text" class="form-control" name="event_registration" value="{{$event->registration}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Event Image: </td>
                                        <td colspan="2">
                                            <input type="file" name="event_image" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(Auth::check())
                                            <td><input type="hidden" name="user_id" value="{{Auth::user()->id}}"></td>
                                        @endif
                                        <td><button class="btn btn-primary">Edit Events</button></td>
                                        <td style="text-align: right">
                                            @if($errors->any())
                                                <span style="color:red">{{$errors->first()}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    <div class="panel-footer text-center">
                        &copy; eve.id 2017
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
