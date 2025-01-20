<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Midtrans\Notification;

class MidtransNotificationController extends Controller
{
    public function handleNotification(Request $request)
    {
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Tangkap notifikasi dari Midtrans
        $notif = new Notification();

        // Ambil order_id dari notifikasi
        $orderId = $notif->order_id;
        $transactionStatus = $notif->transaction_status;
        $paymentType = $notif->payment_type;
        $fraudStatus = $notif->fraud_status;

        // Cari transaksi berdasarkan order_id
        $transaksi = Transaksi::where('order_id', $orderId)->first();

        if (!$transaksi) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        // Perbarui status transaksi berdasarkan status dari Midtrans
        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $transaksi->status = 'challenge';
                } else {
                    $transaksi->status = 'success';
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $transaksi->status = 'success';
        } elseif ($transactionStatus == 'pending') {
            $transaksi->status = 'pending';
        } elseif ($transactionStatus == 'deny') {
            $transaksi->status = 'deny';
        } elseif ($transactionStatus == 'expire') {
            $transaksi->status = 'expired';
        } elseif ($transactionStatus == 'cancel') {
            $transaksi->status = 'canceled';
        }

        $transaksi->save();

        return response()->json(['message' => 'Notifikasi diproses'], 200);
    }
}
