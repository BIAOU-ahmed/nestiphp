$(document).ready(function () {

    var recipe = $("#add-ingredient").data("id");
    let barUrl = $("#add-ingredient").data("url");

    // $('#addprep').click(function() {
    //     $('#modal').removeClass('hidden')
    // })


    $('#add-preparation').click(function () {
        var recipe = $(this).data("id");
        let barUrl = $(this).data("url");
        let preparationContent = $("#preparationsContent").val();

        if (recipe != "") {

            if (preparationContent != "") {
                $.post(barUrl + '/recipe/addPreparations', {
                    "recipe": encodeURIComponent(recipe),
                    "preparationContent": preparationContent
                }, (response) => {
                    addParagraph(response);

                });
            }else {
                alert("Le contenu de la preparation ne peut pas être vide")
            }


        } else {
            alert("Veuillez d'abord céer une recette")
        }
    })


    $('#add_ingredient').click(function () {
        // all values to pass in the ajax request
        let ingredientName = $("#ingredient").val();
        let unitName = $("#unit").val();
        let quantity = $("#quantity").val();

        if (recipe != "") {
            if (ingredientName != "" && unitName != "" && quantity != "") {

                $.post(barUrl + '/recipe/addIngredient', {
                    "recipe": encodeURIComponent(recipe),
                    "ingredientName": ingredientName,
                    "unitName": unitName,
                    "quantity": encodeURIComponent(quantity)
                }, (response) => {
                    addIngredientRecipe(response);
                });

            }

            if (ingredientName == "") {
                $("#ingredient").addClass("border-red-500")
                $("#ingredient_error").text("Ingredient obligatoire");

            } else {
                $("#ingredient").removeClass("border-red-500")
                $("#ingredient_error").text("");
            }
            if (unitName == "") {
                $("#unit").addClass("border-red-500")
                $("#unit_error").text('Unité obligatoire');
            } else {
                $("#unit").removeClass("border-red-500")
                $("#unit_error").text('');
            }
            if (quantity == "") {
                $("#quantity").addClass("border-red-500")
                $("#quantity_error").text('Un nombre atendut');
            } else {
                $("#quantity").removeClass("border-red-500")
                $("#quantity_error").text('');
            }

        } else {
            alert("Veuillez d'abord céer une recette")
        }
    })

    // ajax request on load of the page to get all ingredient of the recipe
    $.post(barUrl + '/recipe/addIngredient', {
        "load": encodeURIComponent(recipe),
    }, (response) => {
        addIngredientRecipe(response);
    });

    // ajax request on load of the page to get all apragraph of the recipe
    $.post(barUrl + '/recipe/addPreparations', {
        "load": encodeURIComponent(recipe),
    }, (response) => {
        addParagraph(response);
    });

    // this function check if the ingredient pass in parameter is present in the datalist or not
    function ingredientNotPresent(ingredient) {
        var x = document.getElementById("ingredient_list");
        var result = true;
        var i;
        for (i = 0; i < x.options.length; i++) {
            if (ingredient == x.options[i].value) {
                result = false;
                break;
            }
        }
        return result;
    }

    // this function check if the unit pass in parameter is present in the datalist or not
    function unitNotPresent(unit) {
        var x = document.getElementById("unit_list");
        var result = true;
        var i;
        for (i = 0; i < x.options.length; i++) {
            if (unit == x.options[i].value) {
                result = false;
                break;
            }
        }
        return result;
    }

    function addIngredientRecipe(data) {
        // check if the ingredient is already added
        if (data === "false") {
            alert("Cette ingredient est déjà ajouter si vous voulez la modifier veillez la supprimer et recréer")
        } else if (data !== '') {
            $('#ingredient-list').html("");
            let n = JSON.parse(data);

            for (var k in n) {
                let item = '<div class="flex justify-between mb-2"> <li  >' + n[k].quantity + " " + n[k].unitName + " de " + n[k].ingredientName + '</li> <button  data-idrecipe="' + n[k].idRecipe + '" data-idproduct="' + n[k].idProduct + '" class="deleteIngredient md:ml-2 md:w-1/6 lg:w-1/12 bg-indigo-500 text-gray-100  rounded">' +
                    'X' +
                    '</button> </div>';
                // if the added ingredient is not present in the datalist is addded
                if (ingredientNotPresent(n[k].ingredientName)) {
                    let newIng = '<option value="' + n[k].ingredientName + '"></option>'
                    $('#ingredient_list').append(newIng)
                }
                // if the added unit is not present in the datalist is addded
                if (unitNotPresent(n[k].unitName)) {
                    let newIng = '<option value="' + n[k].unitName + '"></option>'
                    $('#unit_list').append(newIng)
                }
                $('#ingredient-list').append(item)
            }
        }

        $('.deleteIngredient').click(function () {
            var el = $(this)
            var recipe = $(this).data("idrecipe");
            var product = $(this).data("idproduct");
            var right = $('#ingredient-list').data("cantdelete");

            // if the logged user have rigth to do this action
            if (right == true) {
                $.post(barUrl + '/recipe/addIngredient', {
                    "recipe": encodeURIComponent(recipe),
                    "idProduct": encodeURIComponent(product),
                }, (response) => {
                    addIngredientRecipe(response);
                });
            } else if ('false') {
                alert('Vous ne disposez pas des droit pour effectuer cette action');
            }

        })

        $("#ingredient").val("");
        $("#unit").val("");
        $("#quantity").val("");
    }

    // this function is for add new paragraph for the recipe
    function addParagraph(data) {
        $('#paragraph-container').html("")
        // we parse the data get in json
        let n = JSON.parse(data)
        // we loop on the json to create all pragraph in our page
        for (var k in n) {
            let maxpreparation = Object.keys(n).length;
            let content = ' <div class="flex mr-1 mb-5 ">' +
                '<div class="inline-block h-full self-center mr-3">';
            if (Object.keys(n)[0] != k) {
                content += '<button  class="moveParagraph block my-2"data-idRecipe="' + recipe + '" data-id="' + n[k].id + '"data-action="up"><i class="text-center bg-yellow-500 text-white pt-1 text-3xl h-10 w-10 border block fas fa-arrow-up "></i> </button>'
            }
            if (Object.keys(n)[maxpreparation - 1] != k) {
                content += '<button class="moveParagraph block my-2" data-idRecipe="' + recipe + '" data-id="' + n[k].id + '"data-action="down"><i class="text-center bg-yellow-400 text-white pt-1 text-3xl h-10 w-10 border block fas fa-arrow-down "></i></button>';
            }

            content += '  <div x-data="{ showModal' + n[k].id + '_para: false }" :class="{' + "'overflow-y-hidden': showModal" + n[k].id + "_para }" + '">' +
                '<main class="flex flex-col sm:flex-row justify-center items-center">' +

                '<button  @click="showModal' + n[k].id + '_para = true" class="delete_btn block"><i class="rounded text-center pt-1 text-3xl h-10 w-10 bg-red-600 border text-white block fas fa-trash-alt my-2"></i></button>' +

                '</main>' +


                '<div class="delete_modale hidden fixed inset-0 w-full h-full z-20 bg-gray-200 bg-opacity-50 duration-300 overflow-y-auto" x-show="showModal' + n[k].id + '_para" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">' +
                '<div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3  sm:mx-auto my-10 opacity-100">' +
                '<div class="relative bg-gray-300 shadow-lg rounded-md text-gray-900 z-20" @click.away="showModal' + n[k].id + '_para = false" x-show="showModal' + n[k].id + '_para" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">' +


                '<header class="w-full h-40 grid mb-5 flex items-center  ">' +
                '<div class=" w-full   grid  bg-white h-20">' +

                '<h2 class=" font-semibold text-center justify-self-center self-center "><i class="text-3xl text-red-600 fas fa-exclamation-triangle"></i> Voulez-vous vraiment supprimer l' + "'element: " + n[k].id + " ?</h2>" +

                "</div>" +

                '</header>' +
                '<main class="  h-20 grid   p-2 text-center">' +
                '<p class="w-2/3 justify-self-center bg-white rounded-md">' +
                'Cette action est définitive et irréversible' +
                '</p>' +
                '</main>' +
                '<footer class="">' +

                '<div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">' +
                '<button class="bg-red-500  active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" @click="showModal' + n[k].id + '_para = false">' +
                '<span class="text-lg"> Annuller </span>' +
                '</button>' +

                '<div class="bg-green-500 ml-5 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">' +
                '<button @click="showModal' + n[k].id + '_para = false" name="delete" type="submit" value="1" class="deletePara text-lg text-center  block lg:inline-block lg:mt-0" data-idrecipe="' + recipe + '" data-id="' + n[k].id + '"+>' +
                'Confirmer </button>' +


                '</div>' +
                '</div>' +
                '</footer>' +


                '</div>' +
                '</div>' +
                '</div>' +

                '</div>' +


                '</div>' +
                '<div class="inline-block w-full">' +
                '<textarea id="para"   class=" resize-none w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="5" data-idRecipe="' + recipe + '" data-id="' + n[k].id + '">' + n[k].content + '</textarea>' +
                '</div>' +

                '</div>';
            $('#paragraph-container').append(content)
            $("#preparationsContent").val("");

        }

        // add listener on all paragraph when they lost the focust we save the value
        $("textarea#para").focusout(function () {
            var recipe = $(this).data("idrecipe");
            var idPrep = $(this).data("id");
            var newValue = $(this).val();
            $.post(barUrl + '/recipe/addPreparations', {
                "update": encodeURIComponent(idPrep),
                "recipe": encodeURIComponent(recipe),
                "newValue": newValue,
            }, (response) => {
                // alert(response);
                addParagraph(response);
            });
            // $(this).css("background-color", "#FFFFCC");
            // alert($(this).val())
            // $("textarea#para").prop('readonly', true);
        });

        // a listener to move the paragraph to up or down
        $('.moveParagraph').click(function () {
            var recipe = $(this).data("idrecipe");
            var para = $(this).data("id");
            var action = $(this).data("action");
            if (action === "up") {
                $(this).parent().parent().children('div').eq(1).children().addClass("rotate-left");
                $(this).parent().parent().prev().children('div').eq(1).children().addClass("rotate-down");
            } else if (action === "down") {
                $(this).parent().parent().children('div').eq(1).children().addClass("rotate-down");
                $(this).parent().parent().next().children('div').eq(1).children().addClass("rotate-left");
            }

            // we wait time the css effect pass and we do the changement in the data base
            setTimeout(function () {
                if (recipe != "") {
                    // send the ajax queries to the endpoint
                    $.post(barUrl + '/recipe/movePreparations', {
                        "recipe": encodeURIComponent(recipe),
                        "action": encodeURIComponent(action),
                        "id": encodeURIComponent(para)
                    }, (response) => {
                        addParagraph(response);

                    });

                }
            }, 2000);
        })

        $('.deletePara').click(function () {

            var recipe = $(this).data("idrecipe");
            var para = $(this).data("id");

            if (recipe != "") {

                $.post(barUrl + '/recipe/addPreparations', {
                    "recipe": encodeURIComponent(recipe),
                    "deletedPara": encodeURIComponent(para)
                }, (response) => {

                    addParagraph(response);

                });

            }
        })

    }


})