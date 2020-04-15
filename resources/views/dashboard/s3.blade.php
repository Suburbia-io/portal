@extends('dashboard._base')

@section('title')
    S3 Data Access
@endsection

@section('content')
    <div class="text-black text-lg mb-1">Simple Storage Service</div>
    <div class="text-gray-700 w-full pb-4 mb-6 border-b border-gray-300">Here you can set up S3 credentials to access our datasets.</div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="block text-sm leading-5 font-medium text-gray-700">S3 Access Key</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input class="form-input block w-full mt-1 relative border p-2 rounded-md shadow-sm" readonly placeholder="No credentials generated yet..." value/>
            </div>
        </div>
        <div>
            <label class="block text-sm leading-5 font-medium text-gray-700">S3 Secret Key</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input class="form-input block w-full mt-1 relative border p-2 rounded-md shadow-sm" readonly placeholder="No credentials generated yet..."  />
            </div>
        </div>
    </div>
@endsection
