<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 15/09/2019
 * Time: 07:48
 */
?>

@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>Post count</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{ $tag->name }}
                            </td>
                            <td>
                               {{$tag->posts->count()}}
                            </td>
                            <td>
                                <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Tags Yet</h3>
            @endif

        </div>
    </div>

    <div class="modal animated bounceIn" id="deleteTag" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="title" id="defaultModalLabel">Delete Tag</h6>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text-bold">
                            Are you sure you want to delete tag ?
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
@section('script')
    <script>
        function handleDelete(id)
        {
            $('#deleteTag').modal('show');
            var form = document.getElementById('deleteForm');
            form.action = 'tags/' + id;
        }
    </script>
@endsection
