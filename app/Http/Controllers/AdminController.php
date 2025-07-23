<?php

namespace App\Http\Controllers;

use \App\Models\Transaction;

class AdminController extends Controller
{
	public function incomeReport()
	{
		// Ambil semua transaksi yang sudah diverifikasi beserta relasi payment
		$transactions = Transaction::with('payment')
			->where('status', 'verified')
			->get();

		// Hitung total pemasukan dari payment
		$totalIncome = $transactions->sum(function($trx) {
			return $trx->payment ? $trx->payment->price : 0;
		});

		return view('admin.income', compact('transactions', 'totalIncome'));
	}
}
