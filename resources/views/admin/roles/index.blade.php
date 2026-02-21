@extends('admin.layout')
@section('title', 'Roles')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Roles</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Security policies management.</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Role Name</th>
                    <th scope="col" class="px-6 py-4">Guard</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">{{ $role->name }}</td>
                    <td class="px-6 py-4">{{ $role->guard_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $roles->links() ?? '' }}</div>
@endsection