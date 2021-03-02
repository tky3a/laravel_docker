@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="GET" action="{{route('contact.create')}}">
                        <button type="submit" class="btn btn-primary">
                            新規作成
                        </button>
                    </form>
                    <br>
                    <form method="post" action="{{route('contact.dlcsv')}}">
                        @csrf
                        <input type="hidden" name="contactForms[array]" value={{$contactForms}}>
                        <button type="submit" class="btn btn-primary">
                            CSV
                        </button>
                    </form>
                    indexです
                </div>
            </div>
        </div>
    </div>
</div>
@endsection