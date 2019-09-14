<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 22/08/2019
 * Time: 18:02
 */

?>
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                <h3 class="text-center">No Categories Yet</h3>
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
@section('script')
    <script>
        function handleDelete(id)
        {
            $('#deleteCategory').modal('show');
            var form = document.getElementById('deleteForm');
            form.action = 'categories/' + id;
        }
    </script>
    @endsection
