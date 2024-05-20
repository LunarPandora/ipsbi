<template>
    <div class="flex">
        <div class="flex w-1/6 sticky top-0 left-0 py-7 px-6 h-screen bg-darkTeal">
            <div class="flex flex-col w-full items-center justify-start gap-3">
                <!-- <img src="@/assets/img/IPSBI-LOGO-FINAL-WHITE.png" class="mb-4"> -->
                <p class="display font-medium text-4xl tracking-wider text-white w-full mb-10">IPSBI</p>

                <RouterLink to="/dashboard/post" class="w-full">
                    <div class="bg-gray-700 rounded-xl p-4 flex items-center gap-3">
                        <fa icon="fas fa-newspaper" class="text-xl text-white" />
                        <p class="text-white">Postingan</p>
                    </div>
                </RouterLink>

                <RouterLink to="/dashboard/banner" class="w-full">
                    <div class="rounded-xl p-4 flex items-center gap-3 group hover:bg-white">
                        <fa icon="fas fa-image" class="text-xl text-neutral-400 group-hover:text-darkTeal" />
                        <p class="text-neutral-400 group-hover:text-darkTeal">Banner</p>
                    </div>
                </RouterLink>
                
                <RouterLink to="/dashboard/comment" class="w-full">
                    <div class="rounded-xl p-4 flex items-center gap-3 group hover:bg-white">
                        <fa icon="fas fa-comment" class="text-xl text-neutral-400 group-hover:text-darkTeal" />
                        <p class="text-neutral-400 group-hover:text-darkTeal">Komentar</p>
                    </div>
                </RouterLink>

                <RouterLink to="/dashboard/account" class="w-full">
                    <div class="rounded-xl p-4 flex items-center gap-3 group hover:bg-white">
                        <fa icon="fas fa-user" class="text-xl text-neutral-400 group-hover:text-darkTeal" />
                        <p class="text-neutral-400 group-hover:text-darkTeal">Akun</p>
                    </div>
                </RouterLink>

                <RouterLink to="/dashboard/form" class="w-full">
                    <div class="rounded-xl p-4 flex items-center gap-3 group hover:bg-white">
                        <fa icon="fas fa-clipboard" class="text-xl text-neutral-400 group-hover:text-darkTeal" />
                        <p class="text-neutral-400 group-hover:text-darkTeal">Form</p>
                    </div>
                </RouterLink>

                <div class="rounded-xl w-full p-4 flex items-center gap-3 group hover:bg-white">
                    <fa icon="fas fa-right-from-bracket" class="text-xl text-neutral-400 group-hover:text-darkTeal" />
                    <p class="text-neutral-400 group-hover:text-darkTeal">Logout</p>
                </div>
            </div>
        </div>

        <div class="flex w-5/6 flex-col">
            <div class="flex bg-keppel sticky top-0 right-0 h-fit p-8">
                <h1 class="text-white font-medium text-xl">Dashboard</h1>
            </div>  
            <div class="flex flex-col bg-ivory h-full p-8 gap-10">
                <RouterView />
            </div>
        </div>
    </div>
</template>