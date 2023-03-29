@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search Results</div>
                    <div class="panel-body">
                        <form action="{{ route('search.index') }}" method="get" class="form-inline">
                            <div class="form-group">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" name="q" id="search" class="form-control" placeholder="Search...">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <hr>
                        @if(isset($searchResults))
                            <h4>Search Results for "{{ $query }}"</h4>
                            <ul>
                                @foreach($searchResults as $result)
                                    <li><a href="{{ $result->url }}">{{ $result->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
