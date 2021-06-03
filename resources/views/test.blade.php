@extends('layouts.test')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <div class="container-fluid" style="padding-top:0;" >
        <!-- <a class="btn btn-primary" href="">ארכיון</a> -->
        <div class="row">
            <div class="col-lg-12" id="app">
                <h2 style="margin-top:0; font-weight:bold;">posts</h2>
                <div class="row">
                    <div class="col-3"><add-post></add-post></div>
                    <div class="col-9"><posts></posts></div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->
@endsection
