<?php
namespace App\Http\Controllers;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller {
    public function index() {
        $auditLogs = AuditLog::paginate(10);
        return view('admin.audit-logs.index', compact('auditLogs'));
    }
}