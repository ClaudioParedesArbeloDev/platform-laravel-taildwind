<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SoftwareOrder;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $courseStatus = $request->input('course_status');
        $softwareStatus = $request->input('software_status');

        $coursePayments = Payment::with(['user', 'course'])
            ->when($courseStatus, fn ($query) => $query->where('status', $courseStatus))
            ->latest()
            ->paginate(10, ['*'], 'coursesPage')
            ->withQueryString();

        $softwareOrders = SoftwareOrder::with(['user', 'items'])
            ->when($softwareStatus, fn ($query) => $query->where('status', $softwareStatus))
            ->latest()
            ->paginate(10, ['*'], 'softwarePage')
            ->withQueryString();

        $stats = [
            'coursesApprovedTotal' => Payment::approved()->sum('amount'),
            'softwareApprovedTotal' => SoftwareOrder::approved()->sum('total'),
            'coursesPendingCount' => Payment::pending()->count(),
            'softwarePendingCount' => SoftwareOrder::pending()->count(),
        ];

        return view('pages.dashboard.admin.sales', compact(
            'coursePayments',
            'softwareOrders',
            'stats',
            'courseStatus',
            'softwareStatus'
        ));
    }
}
