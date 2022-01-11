/*
    Recarregar elementos DOM
 */
document.addEventListener("livewire:load", () => {
    Livewire.hook('message.processed', (message, component) => {

        /**
         *  Set Masks
         */
        cash(".imask-cnpj").each(function () {
            IMask((this),{mask:[
                    {
                        mask: '00.000.000/0000-00',
                        lazy: false,
                        placeholderChar: '_',
                    }
                ]});
        });

        cash(".imask-cpf").each(function () {
            IMask((this),{mask:[
                    {
                        mask: '000.000.000-00',
                        lazy: false,
                        placeholderChar: '_',
                    }
                ]});
        });

        cash(".imask-cnpj-cpf").each(function () {
            IMask((this),{mask:[
                    {
                        mask: '000.000.000-00',
                        lazy: false,
                        placeholderChar: '_',
                    },
                    {
                        mask: '00.000.000/0000-00',
                        lazy: false,
                        placeholderChar: '_',
                    }
                ]});
        });

        /*
            Select
         */
        cash(".tom-select").each(function () {
            var select = (this);
            let options = {
                plugins: {
                    dropdown_input: {},
                },
            };

            if (cash(this).attr("multiple") !== undefined) {
                options = {
                    ...options,
                    plugins: {
                        ...options.plugins,
                        remove_button: {
                            title: "Remove this item",
                        },
                    },
                    persist: false,
                    create: true,
                };
            }


            var instance = select.tomselect;
            //instance.destroy();
            new TomSelect(this,options);
        });

        // Feather Icons
        /*
        feather.replace({
            "stroke-width": 1.5,
        });*/
    });
});
