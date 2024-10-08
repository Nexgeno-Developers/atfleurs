<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    protected $fillable = ['address_id','price','tax','shipping_cost','discount','product_referral_code','coupon_code','coupon_applied','quantity','user_id','temp_user_id','owner_id','product_id','notify_date','variation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public static function deleteInvalidCarts($userId = null)
    {
        // Log if no user ID is provided
        // Log::info('Attempting to delete invalid cart items', [
        //     'user_id' => $userId ?? 'no_user_id', // Log user ID or a message indicating no user
        // ]);
    
        // Start a transaction
        DB::transaction(function () use ($userId) {
            // Initialize the query builder for fetching invalid carts
            $query = DB::table('carts as c')
                ->leftJoin('product_stocks as ps', function ($join) {
                    $join->on('c.product_id', '=', 'ps.product_id')
                         ->on('c.variation', '=', 'ps.variant');
                })
                ->whereNull('ps.id') // Get carts with no matching stock variant
                ->select('c.id as cart_id', 'c.product_id', 'c.variation as cart_variation', 'ps.variant as product_variant'); // Select necessary fields
    
            // Apply user condition if userId is provided
            if ($userId) {
                // Log::info('User ID present, filtering by user', [
                //     'user_id' => $userId,
                // ]);
                $query->where('c.user_id', '=', $userId);
            }
    
            // Execute the query to get invalid carts
            $invalidCarts = $query->get();
    
            // If there are invalid carts, delete them and log the information
            if ($invalidCarts->isNotEmpty()) {
                foreach ($invalidCarts as $cart) {
                    // Log the details of the cart item being deleted
                    Log::info('Deleting invalid cart item', [
                        'cart_id' => $cart->cart_id,
                        'product_id' => $cart->product_id,
                        'cart_variation' => $cart->cart_variation,
                        'product_variant' => $cart->product_variant, // This will be null since there’s no match
                    ]);
                }
    
                // Collect cart IDs to delete
                $cartIds = $invalidCarts->pluck('cart_id')->toArray();
                self::destroy($cartIds); // Delete carts by ID
    
                // Log the total number of invalid carts deleted
                Log::info('Deleted invalid cart items', [
                    'deleted_count' => count($cartIds),
                    'user_id' => $userId ?? 'no_user_id',
                ]);
            } else {
                Log::info('No invalid carts found to delete', [
                    'user_id' => $userId ?? 'no_user_id',
                ]);
            }
        });
    }
}
