<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 22/08/2019
 * Time: 21:07
 */

?>
@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($post) ? 'Update Post' : 'Create Post'}}
        </div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if(isset($post))
                                        @if($category->id == $post->category_id)
                                            selected
                                            @endif
                                        @endif
                            >
                                {{ $category->name }}
                            </option>
                            @endforeach

                    </select>
                </div>
                @if($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Tag</label>
                        <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                @if(isset($post))
                                    @if($post->hasTags($tag->id))
                                        selected
                                        @endif
                                    @endif
                                >{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                <div class="form-group">
                    <button class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Add Post' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at',{
            enableTime:true
        });

        $(document).ready(function() {
            $('.tag-selector').select2();
        });
    </script>
    @endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    @endsection