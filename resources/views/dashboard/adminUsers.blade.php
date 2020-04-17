@extends('dashboard._base')

@section('title')
    <h1 class="text-3xl">Admin</h1>
@endsection

@section('content')

    <div class="pb-4 mb-4">
        <a class="text-black mb-1 font-bold mr-4 border-b-2">Users</a>
        <a class="text-gray-700 mb-1">Datasets</a>
    </div>

    <div class="flex flex-col">

            <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg border border-gray-300">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Datasets
                        </th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-6 py-3 border-b border-gray-300 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ Gravatar::get($user->getEmail()) }}" alt="" />
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm leading-5 font-medium text-gray-900">{{ $user->getName() }}</div>
                                    <div class="text-sm leading-5 text-gray-500">{{ $user->getEmail() }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-800">{{ implode(', ', $user->datasets()->pluck('name')->toArray()) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            @if ($user->isAdmin())
                                <div class="text-sm leading-5 text-gray-800">Admin</div>
                            @else
                                <div class="text-sm leading-5 text-gray-800">Customer</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                            <a href="#" class="rounded-md border border-gray-300 px-4 py-2 bg-white leading-6 font-medium text-gray-700 shadow-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

    </div>
@endsection
