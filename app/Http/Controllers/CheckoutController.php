<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;
use App\Models\Participant;

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
            'quantity' => 'required|numeric|max:' . strval($this->maxUnits) . '|min:1',
            'name' => 'required',
            'cpf' => 'required|cpf',
            'number' => 'required'
        ]);

        $quantity = $validated['quantity'];

        $data = [];
        $data['name'] = $validated['name'];
        $data['cpf'] = $validated['cpf'];
        $data['number'] = $validated['number'];
        $data = json_encode($data);

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
            'notification_urls' => ['http://dev.qtandi.com/payment/webhook'],
            'payment_notification_urls' => ['http://dev.qtandi.com/payment/webhook'],
            "payment_methods" => [
                [
                    "type" => "PIX"
                ],
                [
                    "type" => "CREDIT_CARD"
                ]
            ],
            'soft_descriptor' => 'Qtandi',
            'redirect_url' => 'http://dev.qtandi.com/payment/callback',
            'payment_redirect_url' => 'http://dev.qtandi.com/payment/callback'
        ]);

        if($checkout->successful())
        {
            // Colocamos o pedido no banco de dados
            $order = new Order;
            $order->order_id = $checkout['id'];
            $order->data = $data;
            $order->save();

            $checkoutUrl = $checkout->json('links');
            return redirect($checkoutUrl[1]['href']);
        }
        else
        {
            // Algo deu errado, sinceramente foda-se
            return redirect()->back();
        }
    }

    function listener(Request $request)
    {
        /* Escuta as notificações do status de pagamento de cada pedido enviado pelo PagSeguro. */
        // Primeiro, verificamos o ID de origem e buscamos no nosso banco.
        $origin_id = $request->header('X-Product-Id');
        $origin = $request->header('X-Product-Origin');

        $checkout = Order::where('order_id', $origin_id)->get();

        if(!$checkout)
            return;

        // Encontramos a compra no nosso banco. Agora verificamos a atualização de status para saber se podemos fechar a transação e gerar os números.
        $notification = $request->json()->all();
        $charges = $notification['charges'];

        $quantity = 0;
        foreach($notification['items'] as $item)
        {
            $quantity += $item['quantity'];
        }

        foreach($charges as $charge)
        {
            // Devemos ter somente UMA charge, mas vai que né?
            $status = $charge['status'];

            if($status == "PAID")
            {
                // Verificar se o participante já existe, caso sim, adicionamos os novos números
                $data = json_decode($checkout->first()->data);

                $cpf = $data->cpf;
                $name = $data->name;

                $participant = (Participant::where('cpf', $cpf)->first() ?: new Participant);
                $participant->cpf = $cpf;
                $participant->name = $name;
                if($participant->numbers != null)
                {
                    $oldNumbers = json_decode($participant->numbers, true);
                    $newNumbers = json_decode($this->generateNumbers($quantity));

                    $participant->numbers = array_merge($oldNumbers, $newNumbers);
                }
                else
                    $participant->numbers = $this->generateNumbers($quantity);
                $participant->save();

                dd($participant);
            }
            else
                return;
        }

        // Limpar o pedido do banco?
        // Não sei se é necessário?
    }

    function callback()
    {

    }

    function generateNumbers($quantity)
    {
        $numbers = [];
        for($i = 0; $i < $quantity; $i++)
        {
            $rand = random_int(0, 999999);

            while(in_array($rand, $numbers))
            {
                $rand = random_int(000001, 999999);
            }

            $rand = str_pad($rand, 6, '0', STR_PAD_LEFT);

            array_push($numbers, $rand);
        }

        return json_encode($numbers);
    }
}
