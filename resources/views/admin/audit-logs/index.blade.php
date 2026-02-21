@extends('admin.layout')
@section('title', 'Audit Logs')
@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Audit Logs</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage audit logs in the system.</p>
    </div>
    <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm">
        + Create New
    </button>
</div>

<div class="bg-white dark:bg-gray-900 shadow-sm rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Action</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($auditLogs ?? [] as $item)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/80">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->name ?? $item->title ?? $item->key ?? 'Item #'.$item->id }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <span class="block">No audit logs found in the database.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@if(isset($auditLogs) && method_exists($auditLogs, 'links'))
<div class="mt-6 border-t border-gray-100 dark:border-gray-800 pt-4">
    {{ $auditLogs->links() }}
</div>
@endif
@endsection