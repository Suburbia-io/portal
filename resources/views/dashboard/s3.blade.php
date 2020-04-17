@extends('dashboard._base')

@section('title')
    <h1 class="text-3xl">S3 Data Access</h1>
@endsection

@section('content')
    <div class="text-black text-lg mb-1">Simple Storage Service (S3)</div>
    <div class="text-gray-700 w-full pb-4 mb-6 border-b border-gray-300">Here you can set up S3 credentials to access our datasets.</div>

    <div class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <label class="block text-sm leading-5 font-medium text-gray-700">S3 Access Key</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input class="form-input block w-full mt-1 relative border p-2 rounded-md shadow-sm" readonly placeholder="No credentials generated yet..." value="{{ $key }}"/>
            </div>
        </div>
        <div>
            <label class="block text-sm leading-5 font-medium text-gray-700">S3 Secret Key</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input class="form-input block w-full mt-1 relative border p-2 rounded-md shadow-sm" readonly placeholder="No credentials generated yet..." value="{{ $secret }}"  />
            </div>
        </div>
    </div>

    <form method="post">
        {{ csrf_field() }}
        <button type="submit" class="px-3 inline-block py-2  rounded shadow text-white bg-blue-500"><i class="fas fa-sync-alt mr-2"></i>Generate new S3 keys</button>
    </form>

@endsection
