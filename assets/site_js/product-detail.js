

   $(()=>{

	get_product_id();

})

	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})
	
	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});
	
	/////////////////////////////////////////
	
	// Products Slick
	
	
	// Products Widget Slick

let products = [];

get_product_id =()=>{
	$.ajax({
		type: "GET",
		url: host_url + `api/description/product/${id_product}`,
		crossOrigin: false,
		dataType: "json",
		async:false,
		success: (result) => {
			console.log(result);
			products = result;			
			draw_product(result);
			},       
        });
}


draw_product = (product)=>{

	

	let images = JSON.parse(product[0].images);
	let description = product[0].description;
	
    let images_load=[];


	image1=images[0].imagen1;
	image2=images[1].imagen2;
	image3=images[2].imagen3;

	if(image1!=""){ images_load.push(image1); }
	if(image2!=""){ images_load.push(image2); }
	if(image3!=""){ images_load.push(image3); }

	console.log(images_load);
    let load = 1;

	images_load.forEach(x=>{
		html_vertical= `<div class="product-preview" ><img id="vertical_${load}" src="${host_url}assets/images/products/${x}" alt=""></div>`;
		html_horizontal= `<div class="product-preview" ><img id="horizontal_${load}" src="${host_url}assets/images/products/${x}" alt=""></div>`;
		
		$("#product-imgs").append(html_vertical);
        $("#product-main-img").append(html_horizontal);
		load++;
	});


	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})
	
	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});
	

	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');
	
		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});
	
	/////////////////////////////////////////
	
	// Product Main img Slick
	$('#product-main-img').slick({
	infinite: false,
	speed: 300,
	dots: true,
	arrows: false,
	fade: true,
	asNavFor: '#product-imgs',
	});
	
	// Product imgs Slick
	$('#product-imgs').slick({
	slidesToShow: 3,
	slidesToScroll: 1,
	arrows: true,
	centerMode: true,
	focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
	asNavFor: '#product-main-img',
		responsive: [{
		breakpoint: 991,
		settings: {
					vertical: false,
					arrows: false,
					dots: true,
		}
	  },
	]
	}
	
	);


	

    $(".product-details").empty();
	
	$(".title-product").text(product[0].name);
     

    if(description){
	 aux_description = JSON.parse(description);
	 aux_description.forEach(element =>{

		html =`<p class="font-weight-semi-bold mb-2"><i class="bi-check-circle mr-2"></i>${element.name}: ${element.detail}</p>`;
		$(".product-details").append(html);
        
	})
	}else{
		html =`<p class="font-weight-semi-bold mb-2"><i class="bi-check-circle mr-2"></i>Descripción del producto no definida</p>`;
		$(".product-details").append(html);

	}

	html_desc =`<ul class="product-links ">
				<li class="font-weight-semi-bold">CATEGORÍA: ${product[0].category }</li>
				</ul>

				<ul class="product-links ">
				<li class="font-weight-semi-bold">MARCA: ${product[0].supplier }</li>
				</ul>
				<ul class="product-links ">
				<li class="font-weight-semi-bold">MODELO: ${product[0].model }</li>
				</ul>

			   <ul class="product-links">
				<li>Consultas:</li>
		    	<li><a href="https://wa.me/56947092401"><i class="fa fa-whatsapp"></i></a></li>
				<li><a href="https://www.facebook.com/Hidratec.cl"><i class="fa fa-facebook"></i></a></li>
			</ul>`;
			

	$(".product-details").append(html_desc);
	
}

plus = () =>{

	let quantity = parseInt($('#quantity').val());
	$('#quantity').val(quantity+1);
};
	
minus = () =>{
	let quantity = parseInt($('#quantity').val());
	if(quantity > 1){
		$('#quantity').val(quantity-1);
	}
};	

$("#addProduct").on('click', ()=>{

	let quantity = parseInt($('#quantity').val());
	console.log(quantity);

	let cantidad = parseInt(localStorage.getItem('ncantidad')) + parseInt(quantity);
    localStorage.setItem("ncantidad", cantidad);
	
	if(quantity >= 1){
		/* let product; */

		let product;
		products.map((u) => {
			product = {
				id: u.id,
				quantity: quantity,
				description: {
					id: u.id,
					name: u.name,
					code: u.code,
					description: jQuery.parseJSON(u.description),
					model: u.model,   
					price: format_price(u.price),
					stock: u.stock,
					image_first: u.image_first,
					category: u.category,
					supplier: u.supplier,
					cantidad: quantity,
				}
			}
			
		});

	
		$.ajax({
			type: "POST",
			url: host_url + "api/cart/addMultipleProductDetail",
			crossOrigin: false,
			data:{product},
			dataType: "json",
			success: () => {
				swal({
					title: "Exito!",
					icon: "success",
					text: "Se han agregado los productos con éxito",
					buttons: true,
					buttons: {
						confirm: {
							text:'Continuar comprando',
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
						get_cant_products();
						$('#quantity').val(0);
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
	
	}else{
		swal({
			title: `Agregar producto`,
			icon: "warning",
			text: `Debe ingresar una cantidad mayor a 0`,
			buttons: {
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		})
	}
});

	
	
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

