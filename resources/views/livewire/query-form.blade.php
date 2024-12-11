<div>
    <button wire:click="toggle" type="button" class="text-white bg-[#44F6AC] hover:bg-[#3AD695] focus:ring-4 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2">
        <i class="fa-solid fa-ticket px-1"></i>
        Verificar meus números
    </button>

    <div x-data="{ visible: @entangle('isVisible') }" x-show="visible">
        <div class="z-20 fixed top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 w-full max-w-3xl px-4 pt-4">
            <div class="bg-white p-6 rounded-lg shadow-md relative">
                <div class="absolute right-0 top-0 p-2 px-3">
                    <button wire:click="toggle"><i class="text-[#0000005F] text-lg fa-solid fa-xmark"></i></button>
                </div>
                <p class="text-lg">Verifique os seus números aqui.</p>
                <p class="text-[#0000005F] text-sm">Todos os seus números estão atrelados ao seu CPF.</p>
                <form wire:submit="updateCPF">
                    @csrf
                    <div class="mt-3 flex flex-col">
                        <div class="flex flex-col flex-grow mb-5">
                            <label class="block mb-2 text-md font-medium text-gray-500" for="cpf">CPF:</label>
                            <input maxlength="11" wire:model="cpf" type="text" name="cpf" id="cpf" class="bg-gray-50 p-5 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="XXX.XXX.XXX-XX" required />
                        </div>
                    </div>
                    <span class="font-bold me-1">Participante: </span>
                    <span class="font-normal text-[#0000005F]">{{$name}}</span>
                    <hr class="my-3">
                    <div class="overflow-x-auto whitespace-nowrap flex">
                        <br>
                        @foreach($numbers as $number)
                            <div class="font-bold shrink-0 p-2">{{$number}}</div>
                        @endforeach
                    </div>
                <div class="justify-items-center flex content-center justify-center py-3">
                    <button type="submit" class="shadow-sm ms-3 text-[#fff] bg-[#F4A060] hover:text-white hover:bg-[#C3814F] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-magnifying-glass px-1"></i>
                        Pesquisar
                    </button>
                </div>
                </form>
            </div>
        </div>
        <div id="blur" wire:click="toggle" class="fixed top-0 left-0 pointer-events-none inset w-screen h-screen bg-[#0000005F] backdrop-blur z-10"></div>
    </div>
</div>
