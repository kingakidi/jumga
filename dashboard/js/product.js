let plink = document.getElementsByName('p-link');
let slv = _('show-item');


plink.forEach(
    function(element){
        element.onclick= function (event) {
            event.preventDefault();
            id = this.id;

            slv.innerHTML = '<div class="fa-size"><span><i class="fa fa-refresh fa-spin"></i></span></div>';
            if (id === 'myproducts') {
                         
                $.ajax({
                    url: './control/action.php',
                    method: 'POST',
                    data: {
                        myProducts: 'myProducts'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                  
                    }

                })
            }else if(id === 'addproducts'){
                $.ajax({
                    url: './control/forms.php',
                    method: 'POST',
                    data: {
                        aPForm: 'addProduct'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                    }
                }).done(
                    function () {
                    //    GET ALL THE FORM VARIABLES 
                            let pf = _('addProduct');
                            let name = _('name');                           
                            let price = _('price');
                            let desc = _('des')
                            let cat = _('cat');
                            let qty = _('qty');
                            let pfe = _('pfError');
                            let bpf = _('btn-pf')
                            // var formData = new FormData(this)
                            CKEDITOR.replace('des', {
                                height: 100,
                            });
                            // let des = CKEDITOR.instances.des.getData();
                            
                            pf.onsubmit = function (event) {
                                event.preventDefault();
                            
                                if (name.value.trim() !== "" && price.value.trim() !== "" && cat.value.trim() !=="" && qty.value.trim() !=="" && desc.value.trim() !=="") {
                                    $.ajax({
                                        url: './control/action.php',
                                        method: 'POST',
                                        data: {
                                            name: name.value, 
                                            des: des.value,
                                            price: price.value,
                                            cat: cat.value,
                                            qty: qty.value,
                                            aPForm: "add Product"

                                        }, 
                                        beforeSend: function () {
                                            pfe.innerHTML = '<i class="fa fa-refresh fa-spin"></i> Loading';
                                            bpf.disabled = true;
                                        },
                                        success: function (data) {
                                            pfe.innerHTML = data
                                            pfe.style.visibility = 'visible'
                                            bpf.disabled = false;
                                        }
                                    })
                                }else{
                                    pfe.innerHTML = "ALL FIELDS REQUIRED";
                                }
                            }
                    }
                )
                // SEND AJAX FOR ADD PRODUCTS 
            }else if(id === 'allproducts'){
             
                // BRING ALL PRODUCTS
                $.ajax({
                    url: './control/action.php',
                    method: 'POST',
                    data: {
                        allProducts: 'allproducts'
                    },
                    success: function (data) {
                        slv.innerHTML = data;
                       
                     
                    }

                })
            }else if(id === 'myproducts'){
     
            }
        }
    }
);