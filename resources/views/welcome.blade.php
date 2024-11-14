<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Sorteio de TV</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-[#122F75]">
    <div class="relative min-h-screen min-w-screen">
        <livewire:modal />
        <div style="z-index: -1;" class="fixed w-screen h-screen flex overflow-hidden">
            <div class="sm:left-[-5%] sm:top-[-15%] top-[-10%] left-[-10%] sm:size-64 size-32 border sm:border-[20px] border-[10px] aliased border-[#FFC74A] rounded-full left-0 absolute"></div>
            <div class="sm:right-[-5%] sm:bottom-[-15%] right-[-10%] bottom-[-10%] sm:size-64 size-32 border sm:border-[20px] border-[10px] aliased border-[#FFC74A] rounded-full right-0 bottom-0 absolute"></div>
        </div>
        <nav>
            <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-8">
                <a href="#" class="flex items-center">
                    <img src="{{ url('/images/full.png') }}" class="h-16" alt="Qtandi" />
                </a>
                <div class="px-3"></div>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Expandir</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
        </nav>
        <div class="flex flex-wrap items-center justify-center sm:px-8 md:px-2 pb-8">
            <div class="rounded-xl bg-white p-5 shadow-md sm:w-2/4 sm:mx-0 mx-3">
                <div class="flex">
                    <div class="flex-grow">
                        <span class="font-bold text-[#FFC74A]">Rifa</span><span class="text-[#ACABAB] px-1 font-medium">- Samsung SMART TV UHD 4K</span>
                    </div>
                    <div class="flex-grow justify-self-end text-end">
                        <div>
                            <i class="text-[#ACABAB] fa-regular fa-calendar px-1"></i>
                            <span class="text-[#ACABAB]">01/11/2024 18:30</span>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
                <div class="flex">
                    <img class="rounded-xl" src="{{ url('/images/tv2.png') }}" alt="Qtandi" />
                </div>
                <div class="flex py-3">
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-book px-1"></i>
                        Regulamentação
                    </button>
                    <button id="share" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-share px-1"></i>
                        Compartilhar
                    </button>
                </div>
                <div class="flex pb-2">
                    <p class="text-xl font-bold">Samsung SMART TV 50" 4K UHD 50CU7700</p>
                </div>
                <div class="flex">
                    <p class="text-justify text-[#ACABAB] text-sm">Participe da nossa rifa e concorra a uma incrível Samsung SMART TV 50" 4K UHD 50CU7700! Com a sua contribuição, você estará apoiando o lançamento do nosso projeto Qtandi, uma plataforma que vai transformar a forma como você acessa serviços. <br><br> Além de ter a chance de ganhar essa super TV, você estará ajudando a tornar nossa ideia em realidade. Não perca!
                </div>
                <livewire:rifa-form />
            </div>
        </div>
    </div>
</body>
<script>
    const shareData = {
        title: "Qtandi - Sorteio de TV",
        text: "Participe da nossa rifa!",
        url: "{{ Request::url() }}",
    };

    const btn = document.querySelector("#share");
    btn.addEventListener("click", async () => {
        try {
            await navigator.share(shareData);
        } catch (err) {
            console.log(err);
        }
    });
</script>
</html>
