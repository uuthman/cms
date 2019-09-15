<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 15/09/2019
 * Time: 15:40
 */
?>
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">User Profile</div>

        <div class="card-body">
            @include('partials.error')
            <form action="{{ Route('users.update-profile') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" class="form-control" id="about" cols="30" rows="10">{{$user->about}}</textarea>
                </div>

                <button type="submit" class="btn btn-sm btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection

