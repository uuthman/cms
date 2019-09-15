<?php
/**
 * Created by PhpStorm.
 * User: AYINDE
 * Date: 15/09/2019
 * Time: 08:14
 */

?>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    </div>
@endif
