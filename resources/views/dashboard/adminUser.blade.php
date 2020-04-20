@extends('dashboard._base')

@section('title')
    <h1 class="text-3xl">Admin</h1>
@endsection

@section('content')

    <div class="pb-4 mb-4">
        <a  href="{{ route('admin.users') }}" class="text-black mb-1 font-bold mr-4 border-b-2">Users</a>
        <a  href="{{ route('admin.datasets') }}" class="text-gray-700 mb-1 mr-4">Datasets</a>
    </div>

    <div class="flex flex-col">

            edit user: {{ $user->name }}

        <form method="post">
            {{ csrf_field() }}
            @foreach($datasets as $dataset)
                <div>
                    <input type="checkbox" name="datasets[{{ $dataset->id }}]" @if ($user->datasets->contains($dataset->id)) checked @endif > {{ $dataset->name }}
                </div>
            @endforeach
            <button type="submit">Save</button>
        </form>

    </div>
@endsection
