@extends('layouts.default')
@section('content')
@include('inc.profile_common')
<?php
$user = Auth::user();
$editor = \App\Model\EditorRequest::where('applied_by', '=', $user->id)->first();
?>
    <div id="right-column">
        @include('inc.profile_form')
        <h3><?= _("Account"); ?></h3>
        <a class="change-password-link" href="/change_password/{{Auth::user()->id}}"><?= _("Change my password"); ?></a>
    </div>

@endsection