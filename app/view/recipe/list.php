<div class="antialiased sans-serif">


    <!-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script> -->


    <div class="container mx-auto py-6 px-4" x-data="datatables()">
        <h1 class="text-4xl py-4 border-b mb-10">Recettes</h1>



        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <input type="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </div>
                </div>
            </div>
            <div>
                <div class="shadow rounded flex">
                    <div class="relative">
                        <a href="<?= $vars['baseUrl'] ?>recipe/edit" class="text-lg text-center p-2  block lg:inline-block lg:mt-0">
                            <i class="fas fa-plus-circle text-green-800"></i> Ajouter
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow  relative">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead class="h-20">
                    <tr class="text-center">


                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold  uppercase text-lg"> ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold   text-xs"> Nom</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold   text-xs"> Difficulté</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold   text-xs"> Pour</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold   text-xs"> Temps</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold   text-xs"> Chef</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold   text-xs"> Actions</th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($vars['entities'] as $recipe) { ?>
                        <tr class="text-center">

                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 "> <?= $recipe->getId() ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 "><?= $recipe->getName() ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 "> <?= $recipe->getDifficulty() ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 "> <?= $recipe->getPortions() ?> </span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 "><?= $recipe->getTime() ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 "><?= $recipe->getChef()->getLastName(); ?></span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 grid pt-3">
                                <span class="text-gray-700  text-center ">
                                    <a href="<?= $vars['baseUrl'] ?>recipe/edit/<?= $recipe->getId() ?>" class="underline ">Modifier</a>
                                </span> <br>

                                <div x-data="{ showModal<?= $recipe->getId() ?>: false }" :class="{'overflow-y-hidden': showModal<?= $recipe->getId() ?> }">
                                    <main class="flex flex-col sm:flex-row justify-center items-center">
                                        <a class="cursor-pointer underline  text-gray-700 p-2 w-32   " @click="showModal<?= $recipe->getId() ?> = true">
                                            Supprimer
                                        </a>

                                    </main>

                                    <!-- Modal1 -->
                                    <div class="fixed inset-0 w-full h-full z-20 bg-gray-200 bg-opacity-50 duration-300 overflow-y-auto" x-show="showModal<?= $recipe->getId() ?>" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3  sm:mx-auto my-10 opacity-100">
                                            <div class="relative bg-gray-300 shadow-lg rounded-md text-gray-900 z-20" @click.away="showModal<?= $recipe->getId() ?> = false" x-show="showModal<?= $recipe->getId() ?>" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
                                                <header class="w-full h-40 grid mb-5 flex items-center  ">
                                                    <div class=" w-full   grid  bg-white h-20">

                                                        <h2 class=" font-semibold text-center justify-self-center self-center "><i class="text-3xl text-red-600 fas fa-exclamation-triangle"></i> Voulez-vous vraiment supprimer l'element: <?= $recipe->getId() ?> ?</h2>

                                                    </div>

                                                </header>
                                                <main class="  h-20 grid   p-2 text-center">
                                                    <p class="w-2/3 justify-self-center bg-white rounded-md">
                                                        Cette action est définitive et irréversible
                                                    </p>
                                                </main>
                                                <footer class="">

                                                    <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                                                        <button class="bg-red-500  active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" @click="showModal<?= $recipe->getId() ?> = false">
                                                            <span class="text-lg"> Annuler </span>
                                                        </button>

                                                        <div class="bg-green-500 ml-5 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                                                            <a href="<?= $vars['baseUrl'] ?>recipe/edit" class="text-lg text-center  block lg:inline-block lg:mt-0">
                                                                </i> Confirmer
                                                            </a>

                                                        </div>
                                                    </div>
                                                </footer>
                                            </div>
                                        </div>
                                    </div>




                                </div>




                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>


</div>