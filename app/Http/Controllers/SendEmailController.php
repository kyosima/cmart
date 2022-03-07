<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class SendEmailController extends Controller
{

    public function sendemail(Request $request)
    {
        $order = Order::whereOrderCode($_POST['order_code'])->first();

        $data["email"] = $_POST['email'];
        $data["subject"] = 'C-Bill Hóa đơn C-mart';
        $data["order"] = $order;

        $pdf = PDF::loadView('admin.order.c_bill', compact('order'));

        try {
            Mail::send('email.email', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
            return response()->json(
                'Chia sẻ thất bại'
            );
        } else {
            return response()->json(
                'Chia sẻ thành công'
            );
        }
    }
}
