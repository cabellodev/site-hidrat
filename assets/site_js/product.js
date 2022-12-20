$(()=>{

    get_category();
    get_products ();
    get_supplier();
    get_section();
    search_product_old();
   // get_product_localstorage();

})

let products = [];


get_products_all =()=>{

    $.ajax({
		type: "GET",
		url: host_url + 'api/products/all',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
             products = result; 
             console.log(products);          
			 draw_products(result);
			}
        ,
    
        error: ()=>{

            $('.product-content').empty();
            let html= ' <div class="alert alert-dark>No se han encontrado resultados de la búsqueda </div>';
            $('.product-content').append(html);

        } ,
    });
}


get_products =() =>{ // selector de productos
    $.ajax({
		type: "GET",
		url: host_url + 'api/products/all',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
                const select_product = $("#product_name");
                result.forEach( (element)=> {
                    select_product.append($("<option>", {
                    value: element.id ,
                    text: element.name
                }));
                });

                $("#product_name").selectize({
                    sortField: "text",
                });

			}
        ,
    
        
    });
   
};


get_section = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/sections',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_sections(result);
			}
        })
}

draw_sections =(section)=>{
   
    section.forEach(element =>{

      
         if(element.item == "Catálogo de productos"){
           
            $(".title-catalogo").text(element.title);
         }
       

         if(element.item == "Cabecera de módulo Productos"  ){
            url = host_url + `assets/images/sections/${element.url}`;
            $(".title-product").text(element.title);
            $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "height": "500px",
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                         "background-size": "cover"});
         /*   $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                        
                                        });*/
           

          }

    })
     
}


get_supplier= ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/supplier/select',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            select_supplier(result);
			}
        });
}
// select de marcas 
select_supplier= (supplier)=>{

    const select_supplier = $("#supplier");
 
    supplier.forEach( (element)=> {
    select_supplier.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}

get_category = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/categories',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            select_category(result);
			}
        });
}

// select de categorias
select_category = (categories)=>{

    const select_category = $("#categories");
  
    
    categories.forEach( (element)=> {
    select_category.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}


$("#categories").change('click',()=>{
     id_category= $("#categories").val();

     const select_subsubcategory = $("#subsubcategories");
     select_subsubcategory.empty();
     select_subsubcategory.append($("<option>", {
         value: 0 ,
         text: 'Seleccionar sub-categoria'
     }));

     get_subcategory(id_category);

    
})

$("#subcategories").change('click',()=>{
    id_subcategory= $("#subcategories").val();

    get_subsubcategory(id_category);

   
})

get_subsubcategory = (id_subcategory)=> {

    $.ajax({
		type: "GET",
		url: host_url + `api/subsubcategories/${id_subcategory}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			select_subsubcategory(result);
			},
        error: ()=>{
            const select_subsubcategory = $("#subsubcategories");
            select_subsubcategory.empty();
            select_subsubcategory.append($("<option>", {
                value: 0 ,
                text: 'Seleccionar sub-categoria'
            }));
        }

        });
}



// select de subcategorias
get_subcategory = (id_category)=> {

    $.ajax({
		type: "GET",
		url: host_url + `api/subcategories/${id_category}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			select_subcategory(result);
			},
        error: ()=>{


            const select_subcategory = $("#subcategories");
            select_subcategory.empty();
            select_subcategory.append($("<option>", {
                value: 0 ,
                text: 'Seleccionar sub-categoria'
            }));

            const select_subsubcategory = $("#subsubcategories");
            select_subsubcategory.empty();
            select_subsubcategory.append($("<option>", {
                value: 0 ,
                text: 'Seleccionar sub-categoria'
            }));
        }

        });
}


select_subsubcategory = (subsubcategories)=>{

    const select_subsubcategory = $("#subsubcategories");
    select_subsubcategory.empty();
    select_subsubcategory.append($("<option>", {
        value: 0 ,
        text: 'Seleccionar sub-categoria'
    }));
   
    subsubcategories.forEach( (element)=> {
    select_subsubcategory.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}


select_subcategory = (subcategories)=>{

    const select_subcategory = $("#subcategories");
    select_subcategory.empty();
    select_subcategory.append($("<option>", {
        value: 0 ,
        text: 'Seleccionar sub-categoria'
    }));
   
    subcategories.forEach( (element)=> {
    select_subcategory.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}

search_product_old=()=>{

    if(localStorage.getItem('search')){

        products = JSON.parse(localStorage.getItem('search'));

        let data = { supplier :products.supplier,category:products.category, subcategory: products.subcategory,
        subsubcategory: products.subsubcategory, name_product: products.name_product}

        $.ajax({
            type: "POST",
            data: {data},
            url: host_url + 'api/product/search', 
            crossOrigin: false,
            dataType: "json",
            async:false,
            success: (result) => {
                $('#list-product').show();
                $('.product-content').empty();
                draw_products(result);
                }
            ,
            error: ()=>{
                localStorage.removeItem('search');
                $('.product-content').empty();
                $('#list-product').hide();
                let html= '<div class="alert alert-dark">No se han encontrado resultados de la búsqueda </div>';
                $('.product-content').append(html);
            }
        });
        
    }else{
        get_products_all();
    }

}


search_product= ()=>{
    
 


    let data={ supplier : $('#supplier').val(),category: $('#categories').val(), subcategory: $('#subcategories').val(),
                 subsubcategory: $('#subsubcategories').val(), name_product: $('#product_name option:selected').text()}
    
    $.ajax({
		type: "POST",
        data: {data},
		url: host_url + 'api/product/search', 
		crossOrigin: false,
		dataType: "json",
        async:false,
		success: (result) => {
            $('#list-product').show();
            $('.product-content').empty();
            save_localstorage(data);
            draw_products(result);
			}
        ,
        error: ()=>{

            $('.product-content').empty();
            $('#list-product').hide();
            let html= '<div class="alert alert-dark">No se han encontrado resultados de la búsqueda </div>';
            $('.product-content').append(html);
            localStorage.removeItem('search');
        }
    });
}

save_localstorage= (data)=>{
      localStorage.setItem('search', JSON.stringify(data));
}







 
 draw_products=(product)=>{

    let container = $('#pagination');

    
    container.pagination({
        dataSource: product,
        showPageNumbers: true,
        showPrevious: true,
        showNext: true,
        showNavigator: false,
        showFirstOnEllipsisShow: true,
        showLastOnEllipsisShow: true,
        pageSize: 12,
        callback: function (data, pagination) {

           
            let dataHtml = '<ul>';
            let content = '';
            let aux = '';
            let largo = data.length;

            $.each(data, function (index, item) {
                /* content = `<div class="col-lg-3 col-md-4 col-xs-6 wow slideInRight " data-wow-delay="0.8">
                <div class="product">
                    <div class="product-img">
                        <img src="${host_url}/assets/images/products/image_first/${item.image_first}" alt="${item.name}">
                    </div>
                    <div class="product-body">
                        <p class="product-category">${item.category}</p>
                        <p class="product-category">${item.supplier}</p>
                        <h3 class="product-name"><a href="#">${item.name}</a></h3>
                        <h4 class="product-price">${item.price}</h4>
                        <div class="product-rating">
                        </div>
                         <div class="">
                            <button class=""><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                            <button class=""><i class="bi-eye"></i><span class="tooltipp"> Ver componente </span></button>
                            <button class=""><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                            </div>
                       
                        </div> 
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn rounded" id="href-product" onClick=product_by_id(${item.id}) ><i class="fa fa-shopping-cart"></i> Agregar al carro</button>
                        </div>
                    </div>
                    
                </div>`; */


                content= `<div class="col-lg-3 col-md-4 col-xs-6 wow slideInRight" data-wow-delay="0.8">
                            <div class="product">
                                <div class="product-img">
                                    <img src="${host_url}/assets/images/products/image_first/${item.image_first}" alt="${item.name}">
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="product-body">
                                            <div class="row">
                                                <div>
                                                    <p class="product-category">${item.category}</p>
                                                    <p class="product-category">${item.supplier}</p>
                                                    <h3 class="product-name"><a href="#">${item.name}</a></h3>
                                                    <h4 class="product-price">$${item.price}</h4>
                                                </div>
                                            </div>  
                                
                                            <div class="">
                                                
                                            </div>
                                                    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="add-to-cart">
                                            <div class="row">
                                                <div class="col-md-12 show-btn-add-cart">                        
                                                    <button class="add-to-cart-btn text-white" id="href-product" onClick=product_by_id(${item.id})>
                                                        <i style="color:white" class="fa-solid fa-eye"></i>       
                                                            Ver detalles
                                                    </button>
                                                </div>
                                                <div class="col-md-12 space-show-btn-add-cart">
                                                    
                                                </div>
                                                <div class="col-md-12 show-btn-add-cart">
                                                    <button class="add-to-cart-btn text-white" id="href-product" onClick=add_product_by_id(${item.id})>
                                                        <i style="color:white"class="fa fa-shopping-cart"></i>
                                                        Agregar al carro
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

 
                if(( (index+1) % 4 ) == 0){
                    aux = aux + content;
                    dataHtml += '<li><div class="row">' + aux + '</div></li>';
                    aux = '';
                }else{
                    aux = aux + content;
                    if(largo == (index+1)){
                        dataHtml += '<li><div class="row">' + aux + '</div></li>';
                    }
                }
            });

            dataHtml += '</ul>';

            $("#data-container").html(dataHtml);          
        }
    })
 };

 get_product_localstorage = ()=>{

    if(!localStorage.getItem('search')){
        get_products_all();
       
    }else{
        search =JSON.parse(localStorage.getItem('search'));
      
        $('#supplier').val(search.supplier);
        $('#category').val(search.category);
    
        
     
        search_product();
    }
}


 


product_by_id =(id)=>{

    let url = 'products/details'+'?id='+id;
    window.location.assign(host_url+url);
    
}

add_product_by_id = (id)=>{

    let cantidad = parseInt(localStorage.getItem('ncantidad')) +1;
    localStorage.setItem("ncantidad", cantidad);

    let product;
    products.map((u) => {
        console.log(u);
        if(u.id == id){
            product = {
                id: u.id,
                description: {
                    id: u.id,
                    code: u.code,
                    name: u.name,
                    description: jQuery.parseJSON(u.description),
                    model: u.model,   
                    price: format_price(u.price),
                    stock: u.stock,
                    image_first: u.image_first,
                    category: u.category,
                    supplier: u.supplier
                }
            }
        }
    });


	$.ajax({
		data: {product},
		type: "POST",
		url: host_url + "api/cart/addProduct",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {

            swal({
                title: "Exito!",
                icon: "success",
                text: "Se han agregado los productos con éxito",
                buttons: true,
                buttons: {
                    confirm: {
                        text: "Seguir comprando",
                        value: '1',
                        visible: true,
                    },
                    car: {
                        text: "Ir al carro",
                        value: '2',
                        visible: true,
                    },
                  },
            }).then((action) => {
                if (action == "1") {
                    $('#cart_menu_num').text(result.newNumber);
                    swal.close();
                } else if (action == "2")  {
                    window.location.href = `${host_url}shoppingCart`;
                }
            });
		},
		error: (result) => {	
			swal({
				title: "Error",
				icon: "error",
				text: result.msg,
			})
		}		
	});
}


$("#search_product").on('click',search_product);

format_price = (price) => {
    var num = price.toString() 
    var numArr = num.split('.')
    var [num, dotNum] = numArr
 
 
    var operateNum = num.split('').reverse()
    var result = [], len = operateNum.length
    for(var i = 0; i< len; i++){
         result.push(operateNum[i])
         if(((i+1) % 3 === 0) && (i !== len-1)){
              result.push('.')
        }
    }
 
    if(dotNum){
         result.reverse().push('.', ...dotNum)
         return '$'+((result.join('')).toString());
    }else{
         return '$'+((result.reverse().join('')).toString());
    }

}

/*

$("#href-product").on('click', ()=>{
 
   /// let url = 'service/admin/gallery'+'?id='+id_service;
    url = 'products/details';
    window.location.assign(host_url+url);

});*/










