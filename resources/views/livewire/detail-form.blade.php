<div x-data="{ visible: @entangle('isVisible') }" x-show="visible">
    <div class="z-20 fixed top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 w-full max-w-3xl px-4 pt-4">
        <div class="bg-white p-6 rounded-lg shadow-md relative">
            <div class="absolute right-0 top-0 p-2 px-3">
                <button wire:click="toggle"><i class="text-[#0000005F] text-lg fa-solid fa-xmark"></i></button>
            </div>
            <p class="text-lg">Antes de prosseguir, precisamos de alguns dados para identificação.</p>
            <p class="text-[#0000005F] text-sm">Não se preocupe, seus dados serão utilizados apenas para identificar os seus números sorteados.</p>
            <form method="post" action="/checkout">
                @csrf
                <div class="my-5 flex flex-col">
                    <input value="{{$quantity}}" type="hidden" name="quantity" wire:model="quantity">
                    <div class="flex flex-col flex-grow mb-5">
                        <label class="block mb-2 text-md font-medium text-gray-500" for="cpf">Nome Completo:</label>
                        <input type="text" name="name" id="nome" class="bg-gray-50 p-5 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Hudson Gomes Machado" required />
                    </div>
                    <div class="flex flex-row">
                        <div class="flex flex-col flex-grow mr-5">
                            <label class="block mb-2 text-md font-medium text-gray-500" for="cpf">CPF:</label>
                            <input maxlength="11" type="text" name="cpf" id="cpf" class="bg-gray-50 p-5 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="XXX.XXX.XXX-XX" required />
                        </div>
                        <div class="flex flex-col flex-grow ml-5">
                            <label class="block mb-2 text-md font-medium text-gray-500" for="cpf">Número de Contato:</label>
                            <input type="text" name="number" id="numero" class="bg-gray-50 p-5 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="(XX) XXXX-XXXX" required />
                        </div>
                    </div>
                </div>
                <div class="justify-items-center flex content-center justify-center py-3">
                    <button type="submit" class="shadow-sm ms-3 text-[#fff] bg-[#F4A060] hover:text-white hover:bg-[#C3814F] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-arrow-right px-1"></i>
                        Prosseguir
                    </button>
                </div>
            </form>
            <hr class="mt-3">
            <div class="justify-items-center flex justify-center py-4 flex-row">
                <img class="mx-3" style="max-height: 32px;" src="{{ asset('/images/full_gs.png')}}">
                <img class="mx-3" style="max-height: 32px;" src="{{ asset('/images/pag_gs.png')}}">
            </div>
            <p class="text-[#0000005F] text-center text-sm">Você será redirecionado para o ambiente seguro de pagamento do <a class="underline" href="https://pagseguro.uol.com.br">PagBank</a>.</p>
        </div>
    </div>
    <div id="blur" wire:click="toggle" class="absolute w-full h-full bg-[#0000005F] backdrop-blur z-10"></div>
</div>
