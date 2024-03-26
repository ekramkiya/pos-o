<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserFullName()
    {
        if ($this->user) {
            return $this->user->first_name . ' ' . $this->user->last_name;
        }
    }

    public function getCustomerName()
    {
        if ($this->customer) {
            return $this->customer->first_name . ' ' . $this->customer->last_name;
        }
        return 'walking Customer';
    }

    public function total()
    {
        return $this->items->map(function ($i) {
            return $i->price;
        })->sum();
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }

    public function receivedAmount()
    {
        return $this->payments->map(function ($i) {
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }

    public function unpaidAmount()
    {
        $totalAmount = $this->totalAmount();
        $receivedAmount = $this->receivedAmount();

        $unpaidAmount = $totalAmount - $receivedAmount;

        return $unpaidAmount;
    }

    public function remainamount()
{
    $totalAmount = $this->total();
    $receivedAmount = $this->receivedAmount();

    $unpaidAmount = $totalAmount - $receivedAmount;

    return $unpaidAmount;
}


}
