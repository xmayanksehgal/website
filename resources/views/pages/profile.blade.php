@extends('layouts.default')
@section('content')
@include('inc/profile_common')
        <div id="right-column">
            <?php 
                $user = Auth::user();
                //own profile ?
                if ($user = Auth::user()){?>
                @include("inc/profile_form");
                <?php
                }
            ?>

            <div class="profile-section">
                <h3><?= _("Account"); ?></h3>
                <a class="change-password-link" href=""><?= _("Change my password"); ?></a>
                <?php if (!empty($showPasswordResetForm)): ?>
                <script> $(document).ready(function(){ $(".change-password-link").click(); }); </script>
                <?php endif; ?><br /><br />
                <a href="" onclick="return confirm('<?= _("Are you sure that you want to delete your account?"); ?>')"><?= _("Delete my account"); ?></a>
            </div>
        </div>
@endsection