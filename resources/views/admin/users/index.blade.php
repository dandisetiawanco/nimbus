@extends('admin.layout')
@section('title', 'Users Directory')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">System Users</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage accounts and permissions.</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-900 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Email</th>
                    <th scope="col" class="px-6 py-4">Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @foreach($user->roles as $role)
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">{{ $role->name }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $users->links() ?? '' }}</div>
@endsection