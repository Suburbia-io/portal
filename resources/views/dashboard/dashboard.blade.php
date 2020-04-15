@extends('dashboard._base')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="text-black text-lg mb-1">Account Status</div>
    <div class="text-gray-700 w-full pb-4 mb-6 border-b border-gray-300">An overview of the current capabilities of your account.</div>

    <ul class="md:grid md:grid-cols-2 md:col-gap-8 md:row-gap-10 mb-4">
        <li>
            <div class="flex">
                @if ($hasS3)
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 p-6 rounded-md bg-green-500 text-white">
                            <i class="fas fa-check mx-auto w-6 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h5 class="text-lg leading-6 font-medium text-gray-900">S3 Dataset Access</h5>
                        <p class="mt-2 text-base leading-6 text-gray-500 block w-full">
                            You have access to our datasets via S3 (Simple Storage Service)
                        </p>
                        <a href="{{ route('s3') }}" class="mt-3 px-3 inline-block py-2  rounded shadow bg-white text-gray-500 hover:text-gray-600 bg-gray-200">
                            Learn more
                        </a>
                    </div>
                @else
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 p-6 rounded-md bg-blue-500 text-white">
                            <i class="fas fa-exclamation mx-auto w-6 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h5 class="text-lg leading-6 font-medium text-gray-900">S3 Dataset Access</h5>
                        <p class="mt-2 text-base leading-6 text-gray-500 block w-full">
                            You haven't set up dataset access via S3 yet.
                        </p>
                        <a href="{{ route('s3') }}" class="mt-3 px-3 inline-block py-2  rounded shadow bg-white text-gray-500 hover:text-gray-600 bg-gray-200">
                            Learn more
                        </a>
                    </div>
                @endif
            </div>
        </li>
        <li class="mt-10 md:mt-0">
            <div class="flex">
                @if ($hasSftp)
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 p-6 rounded-md bg-green-500 text-white">
                            <i class="fas fa-check mx-auto w-6 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h5 class="text-lg leading-6 font-medium text-gray-900">SFTP Dataset Access</h5>
                        <p class="mt-2 text-base leading-6 text-gray-500">
                            You have access to our datasets via SFTP
                        </p>
                        <a href="#" class="mt-3 px-3 inline-block py-2  rounded shadow bg-white text-gray-500 hover:text-gray-600 bg-gray-200">
                            Learn more
                        </a>
                    </div>
                @else
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 p-6 rounded-md bg-blue-500 text-white">
                            <i class="fas fa-exclamation mx-auto w-6 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h5 class="text-lg leading-6 font-medium text-gray-900">SFTP Dataset Access</h5>
                        <p class="mt-2 text-base leading-6 text-gray-500 block w-full">
                            You haven't set up dataset access via SFTP yet.
                        </p>
                        <a href="#" class="mt-3 px-3 inline-block py-2  rounded shadow bg-white text-gray-500 hover:text-gray-600 bg-gray-200">
                            Learn more
                        </a>
                    </div>
                @endif
            </div>
        </li>
    </ul>

@endsection
