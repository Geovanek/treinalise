@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <h1>Treinalise</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @livewire('teste')
            </div>
        </div>
    </div>
</div>
@endsection
