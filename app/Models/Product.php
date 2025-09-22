<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transaction;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity_available',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function purchase($userId, $quantity)
    {
        if ($quantity > $this->quantity_available) {
            throw new \Exception('Not enough quantity available.');
        }

        $totalPrice = $this->price * $quantity;

        Transaction::create([
            'user_id' => $userId,
            'product_id' => $this->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);

        $this->decrement('quantity_available', $quantity);
    }
}
