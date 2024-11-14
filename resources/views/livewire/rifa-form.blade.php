<div>
    <hr class="mt-3">
    <div class="flex items-center justify-center justify-items-center pt-3">
        <p wire:model.lazy="price" class="text-2xl font-bold text-[#6FF0B2]">R{{ Number::currency($this->price) }}</p>
        <form class="ms-3 flex" method="post" action="/checkout">
            @csrf
            <div class="relative flex items-center max-w-full">
                <button wire:click="decrement" type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"><i class="fa-solid fa-minus text-[#ACABAB]"></i></button>
                <input name="quantity" min="20" max="5000" wire:input="updatePrice" wire:model="quantity" type="number" id="quantity-input" data-input-counter class="bg-gray-50 border-x-0 border-gray-100 border-2 text-center text-sm block text-[#ACABAB] w-full py-2.5 font-bold" value="{{ $quantity }}" required />
                <button wire:click="increment" type="button" id="increment-button" data-input-counter-increment="quantity-input" class="font-bold bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"><i class="fa-solid fa-plus text-[#ACABAB]"></i></button></button>
            </div>
            <button type="submit" class="shadow-sm ms-3 text-[#D08852] bg-[#F4A060] hover:text-white hover:bg-[#C3814F] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <i class="fa-solid fa-shopping-cart px-1"></i>
                Comprar
            </button>
        </form>
    </div>
</div>
