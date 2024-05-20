<template>
    <div class="flex items-center justify-center w-screen h-screen bg-keppel">
        <div class="flex flex-col items-center justify-center px-8 py-16 rounded-lg bg-white gap-5 w-1/3">
            <h1 class="text-5xl font-semibold">Login</h1>
            <p class="text-gray-400 mb-7">Masukkan akun anda untuk melanjutkan</p>

            <div class="flex items-center justify-center bg-white p-4 border-2 border-keppel rounded-lg w-full gap-3">
                <fa icon="fas fa-user" fixed-width class="text-lg text-keppel" />
                <input class="w-full outline-none" placeholder="Masukkan username anda..." />
            </div>

            <div class="flex items-center justify-center bg-white p-4 border-2 border-keppel rounded-lg w-full gap-3">
                <fa icon="fas fa-lock" fixed-width class="text-lg text-keppel" />
                <input class="w-full outline-none" placeholder="Masukkan password anda..." />
            </div>

            <button class="bg-keppel rounded-lg p-4 w-full font-semibold text-xl text-white tracking-wide">Masuk</button>
        </div>
    </div>
</template>