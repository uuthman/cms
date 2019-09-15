<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 15/09/2019
 * Time: 14:12
 */
?>

@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Image
                        </th>
                        <th>
                            Name
                        </th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{ Gravatar::src($user->email) }}" alt="" width="40px" height="40px" style="border-radius: 50%;">
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                           <td>{{ $user->email }}</td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{ Route('users.make-admin',$user->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                    </form>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Users Yet</h3>
            @endif
        </div>
    </div>

    <div class="modal animated bounceIn" id="deleteCategory" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">Delete Category</h6>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold">
                            Are you sure you want to delete category ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No, Go Back
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Yes, Delete it
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

