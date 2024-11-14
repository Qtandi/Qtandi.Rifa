<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    // Implementação de Checkout
    // PagSeguro
    // @mdolli

    private $unitPrice = 25; // Definimos o valor da unidade do servidor, para prevenir quaisquer brechas
    private $maxUnits = 999;

    function realizarCheckout(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|numeric|max:999|min:1'
        ]);

        $quantity = $validated['quantity'];

        $checkout = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAGSEGURO_API_TOKEN'),
            'Content-Type' => 'application/json',
            'Accept' => '*/*',
        ])->post(env('PAGSEGURO_API_ENDPOINT'), [
            'reference_id' => 'rifa',
            'customer_modifiable' => true,
            'items' => [
                [
                    'reference_id' => 'rifa',
                    'name' => 'Rifa Samsung SMART TV 50" 4K UHD 50CU7700',
                    'description' => 'Participe da nossa rifa e concorra a uma incrível Samsung SMART TV 50" 4K UHD 50CU7700!',
                    'quantity' => $quantity,
                    'unit_amount' => $this->unitPrice,
                    'image_url' => 'https://files.catbox.moe/ongijh.png'
                ]
            ],
            'payment_methods' => [
                ['type' => 'CREDIT_CARD'],
                ['type' => 'DEBIT_CARD'],
                ['type' => 'BOLETO'],
                ['type' => 'PIX']
            ],
            'soft_descriptor' => 'Qtandi',
            'redirect_url' => 'http://example.com/checkout/callback'
        ]);

        if($checkout->successful())
        {
            $checkoutUrl = $checkout->json('links');
            return redirect($checkoutUrl[1]['href']);
        }
        else
        {
            return dd($checkout->body());
        }
    }

    function callback()
    {

    }
}
