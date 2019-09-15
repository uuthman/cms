<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 22/08/2019
 * Time: 21:02
 */

?>
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
           Posts
        </div>
        <div class="card-body">
            @if($posts->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Image
                        </th>
                        <th>
                            Title
                        </th>
                        <th>Category</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset($post->image) }}" alt="" width="120px" height="60px">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit',$post->category->id) }}">{{ $post->category->name }}</a>
                            </td>
                            @if(!$post->trashed())
                                <td>
                                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info btn-sm">Edit</a>
                                </td>
                            @else
                                <td>
                                    <form action="{{ route('restore',$post->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                    </form>
                                </td>
                                @endif
                            <td>
                                <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">{{ $post->trashed() ? "Delete" : "Trashed" }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3 class="text-center">No Posts Yet</h3>
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
