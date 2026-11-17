<?php

namespace App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Expense;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::first();
        $query = Expense::query();

        // Filter by date if provided
        if ($request->filled('date')) {
            $date = $request->input('date');
            $query->whereDate('date', $date);
        }

        $expenses = $query->get();

        return view('admin.expense.index', compact('settings', 'expenses'));
    }

    
    public function addpage()
    {
        return view('admin/expense/add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'by_employee_or_office' => 'required|numeric',
            'details' => 'nullable|string',
            'attachment' => 'nullable|file'
        ]);
    
        $expense = new Expense();
        $expense->title = $request->title;
        $expense->date = $request->date;
        $expense->by_employee_or_office = $request->by_employee_or_office;
        $expense->details = $request->details;
    
        // Check if attachment exists in the request
        if ($request->hasFile('attachment')) {
            $image = $request->file('attachment');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $expense->attachment = $imageName;
        }
        $expense->save();
    
        return redirect()->route('expense.add')->with('success', 'Expense added successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('admin/expense/edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'by_employee_or_office' => 'required|numeric',
            'details' => 'nullable|string',
            'attachment' => 'nullable|file'
        ]);
    
        
        // Set new values to expense
        $expense->title = $request->title;
        $expense->date = $request->date;
        $expense->by_employee_or_office = $request->by_employee_or_office;
        $expense->details = $request->details;

        // If a new attachment is uploaded, update it
        if ($request->hasFile('attachment')) {
            $image = $request->file('attachment');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $expense->attachment = $imageName;
        }

        $expense->save();

        return redirect()->route('expenses.all')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {   
        // Delete the expense
        $expense->delete();

        return redirect()->back()->with('success', 'Expense deleted successfully.');
    }
}
