<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
// use config\constants;


define('PENDING',"pending");

class PaymentController extends Controller
{
    public function index(Course $course)
    {
        return view('student.payment.pay',['course' => $course]);
    }


    public function store(PaymentRequest $request,Course $course)
    {



        if($file = $request->file('pdf'))
        {
            $filesave = $file->store('public/payment');
        }
        
        
     


      
       Payment::create([
        'user_id' => auth()->user()->id,
        'course_id' => $course->id,
        'card' => $request->card,
        'cvv' => $request->cvv,
        'expiry_date' => $request->expiry_date,
        'pdf' => $filesave,
        'status' => config('constants.payment.pending'),
        'amount'=> $course->price,
           ]);
           session()->flash('payment_success',"Payment Successful for Course $course->name");
           return redirect('home');


              // $data['user_id'] =  auth()->user()->id;
        // $data['course_id'] =  $course->id;
        // $data['card'] =  $request->card;
        // $data['cvv'] =  $request->cvv;
        // $data['expiry_date'] =  $request->expiry_date;
        // $data['pdf'] =  $filesave;
        // $data['status'] =  config('constants.payment.pending');
        // $data['amount'] = $course->price;
        // Payment::create($data);

        // $payment->course_id = $course->id;
        // $payment->card = $request->card;
        // $payment->cvv = $request->cvv;
        // $payment->expiry_date = $request->expiry_date;
        // $payment->pdf = $filesave;   
        // $payment->status = PENDING;
        // 'amount'=> $course->price,
        // dd($payment);
        // $user->payments()->save($payment);  

    }


    public function edit(Payment $payment)
    {
        $payment = $payment->load('course');
        
        return view('student.payment.repayment',['payment' => $payment]);
    }
    public function update(Payment $payment,PaymentRequest $request)
    {
        // dd($payment);
        $data = Payment::findOrFail($payment->id);

        if($file = $request->file('pdf'))
        {
            $filesave = $file->store('public/payment');
        }
        $data['card'] = $request->card;
        $data['cvv'] = $request->cvv;
        $data['expiry_date'] = $request->expiry_date;
        $data['pdf'] = $filesave;
        $data['status'] = $request->status;
        // $data['amount'] = $payment->amount;
        $data['status'] = Config('constants.payment.pending');
        $data->save();


        dd("completed");    




    }
}
