/* Vars */
let cantidad = [];
let items;
let rutOk;
let total_purchase = 0;
let date_delivery = '';

var toastMixin = Swal.mixin({
	toast: true,
	icon: 'success',
	title: 'General Title',
	animation: false,
	position: 'top-right',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
	didOpen: (toast) => {
	  toast.addEventListener('mouseenter', Swal.stopTimer)
	  toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
});


/* Cons */
const validateEmail = (email) => {
	return email.match(
	  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	);
};

$(() => {
	get_products();	
	get_regiones();

	$("#rut").rut({formatOn: 'keyup', validateOn: 'change'})
		.on('rutInvalido', function(){  
			rutOk = false; 
			$("#frm_rut > div").html('Rut inválido'); $("#frm_rut > input").addClass("is-invalid");
		})
		.on('rutValido', function(){ rutOk = true; $("#frm_rut > input").removeClass("is-invalid");
	});
});


$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});

/* ------------- Get data to load in page ---------- */

/* Get products in purchase cart */
get_products = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/cart/getProducts',
		crossOrigin: false,
		dataType: "json",
		success:  (result) => {
			if(result.products != null) {
				items = result;
				resetCant(result);
				$('#cart_box').addClass('col-md-8 mb-3');
				$('#purchase_box').show();
				draw_products(result);
			}else{
				$('#cart_box').addClass('col-md-12 mb-3');
				$('#purchase_box').hide();

				let header = "<div class='col-md-7 mb-3 rounded' style='background-color:white; margin:auto'></br><div style= 'text-align: center;'><i class='fa-solid fa-cart-plus fa-10x'></i></div><div class='row'><h2 style = 'text-align: center'><strong> Tu Carro está vacío </strong></h2></div>";
				let explore = "<div class='row mb-3'><span style='text-align: center; font-size: 20px;'><strong>Explora nuestros productos</strong></strong></span></div>";
				let button = "<div class='row mb-3'><button  class='custom-btn rounded-pill' style='width: 40%; margin:auto' type='button' value='0' onclick = redirect();> Productos</button></div></div>";
				cons = header + explore + button;
				$(cons).appendTo("#content_products"); 
			}
		}
	})
}

/* Get regions to load in multiselect */
get_regiones = () =>{
	console.log(regiones);
	regiones.regiones.map((u) => {
		let option = document.createElement("option"); 
		$(option).val(u.region); 
		$(option).attr('name', u.region);
		$(option).html(u.region); 
		$(option).appendTo("#region");
	});

	regiones.regiones.map((u) => {
		let option = document.createElement("option"); 
		$(option).val(u.region); 
		$(option).attr('name', u.region);
		$(option).html(u.region); 
		$(option).appendTo("#region_contact");
	});

	regiones.regiones.map((u) => {
		let option = document.createElement("option"); 
		$(option).val(u.region); 
		$(option).attr('name', u.region);
		$(option).html(u.region); 
		$(option).appendTo("#region_office");
	});
}

/* --------- Process to new transbank transaction----------- */
newTransaction = () => {
	let name = $('#name').val();
	let rut = $("#rut").val();
	let phone = $('#phone').val();
	let email = $('#email').val();
	let type_delivery = $('#type_delivery').val();
	let dpto = $('#dpto').val();
	let address = $('#address').val();
	let address_office = $('#address_office').val();
	let number = $('#number').val();
	let region = $('#region').val();
	let comuna = $('#comuna').val();
	let region_contact = $('#region_contact').val();
	let comuna_contact = $('#comuna_contact').val();
	let region_office = $('#region_office').val();
	let comuna_office = $('#comuna_office').val();
	let enterprise = $('#enterprise').val();
	let comentary = $('#comentary').val();

	data = {
		amount: total_purchase,
		name : name,
		rut : rut,
		phone: phone,
		email: email,
		dpto : dpto,
		comentary: comentary,
		comentary_office: comentary,
		type_delivery: type_delivery,
		number: number,
		region_contact: region_contact,
		comuna_contact: comuna_contact,
		address: address,
		region: region,
		comuna: comuna,
		address_office: address_office,
		region_office: region_office,
		comuna_office: comuna_office,
		enterprise: enterprise,
		date_delivery: date_delivery
	}

	$.ajax({
		type: "POST",
		data: {data},
		url: host_url + "api/newTransaction",
		crossDomain: true, 
		dataType: "json",
		success: (result) => {
			window.location.href = result.url;
		},
		error: (result) => {
			Swal.fire({
				title: "Error",
				icon: "error",
				text: "Error",
			});
          },
	});

}

/*----------- Add Html code ------------*/

/* Draw products in purchase cart */
draw_products = (result) =>{
	let total = 0;

	$.each(result.products, function(i, item) {
		
		let base = item.price.substring(1);
		let base_without_dot = base.replace(/\./g, '');
		let base_int = parseInt(base_without_dot);
		let price_total_pr = base_int * parseInt(item.cantidad);
		total = total +price_total_pr;

		let init_img = "<div class='row'><div class='card mb-4 shadow p-3 mb-5 bg-white jsx-card-item'><div class='card-body'><div class='row'><div class='col-md-3 mb-3'><a href=''><img class='img-fluid' src='"+host_url+"/assets/images/products/image_first/"+item.image_first+"' alt=''></a></div><div class='col-md-9 mb-3'>"
		let row_details_enc = "<div class='row'><div class='col-md-8 mb-3'><div class='row'><div class='col-md-9 mb-3' style='margin:auto;'> <div><span><strong>"+item.name+"</strong></span></div></br>"
		let row_descrpition = "";
		$.each(item.description, function(i, element) {
			row_descrpition = row_descrpition +"<div><i class='bi-check-circle mr-2'></i><span style='text-transform: uppercase;'>"+element.name+" : "+element.detail+"</span></div>";
		});

		let row_details = "<div><span> CATEGORIA: "+item.category+"</span></div><div><span> MARCA: "+item.supplier+"</span></div><div><span> MODELO: "+item.model+"</span></div></div></div></div>";
		let row_delivery = "<div class='col-md-4 mb-3'><div class='row'><div class='col-md-12 mb-3' style='margin:auto'><div><span style='color:red'><strong>"+item.price+"</strong></span></div><div><span>✓ Despacho disponible</span></div><div><span>✓ Retiro disponible</span></div></div></div></div></div>";
		let buttons = "<div class='row'><div class='col-md-3 offset-md-9'><div class='input-group'><span onclick= 'minus_product_by_id("+item.id+")' class='btn input-group-text fxw-btn-count' style='width:33%;background-color: #eeeeee;'>-</span><input id='quantity_"+item.id+"' onchange='addMultiple("+item.id+")' type='text' class='form-control fxw-input-count' value='"+item.cantidad+"' style='width:33%; background-color: white;'><span onclick= 'plus_product_by_id("+item.id+")' class='btn input-group-text fxw-btn-count' style='width:33%;background-color: #eeeeee;'>+</span></div></div></div></br><div class='row'><div><button type='button' onclick= 'delete_product_by_id("+item.id+")' class='custom-btn fxw-item-btn-delete rounded'>Eliminar <i class='fa fa-trash' aria-hidden='true'></i></button></div></div></div></div></div></div></div>";
		
		let cons = init_img+row_details_enc+row_descrpition+row_details+row_delivery+buttons;

		let obj_quantity = new Object();
		obj_quantity['name'] = 'quantity_'+item.id;
		obj_quantity['quantity'] = parseInt(item.cantidad);
		cantidad.push(obj_quantity);
		$(cons).appendTo("#content_products"); 
	});
	total_purchase = total;
	total = format_price(total);
	$('#total_purchase').text(total);
	$('#total_purchase_min').text(total);
}

/* Draw items in resume pruchase box  */
draw_items = () =>{
	let quantity = 0;;
	$.each(items.products, function(i, item) {
		console.log(item);
		let base = item.price.substring(1);
		let base_without_dot = base.replace(/\./g, '');
		let base_int = parseInt(base_without_dot);
		let price_total_pr = format_price(base_int * parseInt(item.cantidad));
		
		let header= "<div class='row'><div class='col-3 col-sm-3'>";
		let img = "<img class='img-fluid' src='"+host_url+"/assets/images/products/image_first/"+item.image_first+"' alt=''></div>";   
		let item_title = "<div class='col-4 col-sm-4' style='text-align:left;'><span class='resume-delivery-min'>"+item.name+"</span></br>";
		let item_descr = "<span class='resume-delivery-min'>"+item.cantidad+" un.</span></div>";
		let item_total = "<div class='col-5 col-sm-5'><span class='resume-delivery-text'>"+price_total_pr+"</span></div></div><hr>";
		
		let cons = header+img+item_title+item_descr+item_total;
		$(cons).appendTo("#items-min"); 
		quantity ++;
	});
	let pl = quantity > 1 ? "Productos" : "Producto";
	$('#quantity-min').text("("+quantity+" "+pl+")");
}

/* Draw final resume to proceed with purchase */
draw_resume = () =>{
	let op = $('#type_delivery').val();
	let type= '';
	let address= '';
	let time = '';
	let addressConcat = `${$('#address').val()} , ${$('#number').val()} , ${$('#region').val()} , ${$('#comuna').val()}`;
	let addressConcatOffice = `${$('#address_office').val()} , ${$('#region_office').val()} , ${$('#comuna_office').val()}`;
	let enterprise = $('#enterprise').val();
	let times = Date.now();
	let hoy = new Date(times);
	date_delivery = addWorkDays(hoy, 7).toLocaleDateString();

	if(op == '1'){
		type= `<span>Entrega - <strong>Retiro en Hidratec</strong></span>`;
		address= `<span> Lugar de retiro: - <strong>Proyectada uno 1712 Galpón 4 barrio industrial Coquimbo, Coquimbo</strong></span>`;
		time = `<span><strong> Retiro disponible desde el ${date_delivery} </strong></span>`;

	}else if(op == '2'){
		type= `<span>Entrega - <strong>Envío a Domicilio - ${enterprise}</strong></span>`;
		address= `<span> Lugar de entrega: - <strong> ${addressConcat} </strong></span>`;
		time = `<span><strong> Entrega estimada para el día ${date_delivery} </strong></span>`;
	}else if(op == '3'){
		alert('a');
		type= `<span>Entrega - <strong>Envío a sucursal de ${enterprise}</strong></span>`;
		address= `<span> Lugar de entrega: - <strong> ${addressConcatOffice} </strong></span>`;
		time = `<span><strong> Entrega estimada para el día ${date_delivery} </strong></span>`;
	}

	let header = "<div class='card mb-4 shadow p-3 mb-5 bg-white jsx-card-item'><div class='card-body'><div class='row'><div class='col-md-9 mb-3'>";
	let title = "<div class='row'><span class='jsx-resume-title-content'>Tipo De Entrega</span></div></br>";
	let type_content = "<div class='row mb-3'><div class='col-12 col-sm-12'>"+type+"</div>";
	let address_content = "<div class='col-12 col-sm-12'><i class='fa-solid fa-map-pin'></i>"+address+"</div></div></br>";
	let time_content = "<div class='row mb-3'><div class='col-12 col-sm-12'><i class='fa-solid fa-truck'></i>"+time+"</div>";
	let end = "</div></div><div class='col-md-3 mb-3'><img class='img-fluid' style='margin: auto; display: block' src='"+host_url +"assets/video/delivered.gif'></img></div></div></div></div>";

	let cons = header+title+type_content+address_content+time_content+end;
	$(cons).appendTo("#purchase"); 
}


/*----------- Buttons action ------------*/

/* 1 step purchase (continue to contact details) */
$('#btn_continue_delivery').click( d = () => {

	const progress = document.getElementById('progress');
	const progressSteps =  document.querySelector('.progress-bar-step');


	$("#btn_continue").val(1);
	$("#content_products").hide();
	$("#delivery").show();
	$("#bar-delivery").addClass('progress-bar-step-active');
	$("#progress").css("width", "50%"); 
	$("#tr_label_image_header").text('Delivery');
	$("#resume_delivery").show();
	$("#resume_cart").hide();
	draw_items();	
	
	Swal.fire({
		allowOutsideClick: false,
		title: 'Métodos de entrega',
		html: 'Los envíos por delivery (domicilio o sucursal de proveedor), <b> sin excepción son por pagar. </b>', 
		  /* '<img class="img-fluid" src="'+ host_url +'assets/video/delivery1.gif"></img>', */
		confirmButtonText: 'continuar',
		imageWidth: 300,
		imageHeight: 300,
		imageUrl: host_url +'assets/video/delivery1.gif',
	})


});

/* 2-3 step purchase (continue to resume and payment) */
$('#btn_continue_payment').click( d = () => {
	let op = $('#btn_continue_payment').val();
	const progress = document.getElementById('progress');
	const progressSteps =  document.querySelector('.progress-bar-step');

	switch(op){
		case '0': 
		if(formRules()){
			$("#btn_continue_payment").val(1);
			$("#delivery").hide();
			$("#purchase").show();
			$("#bar-purchase").addClass('progress-bar-step-active');
			$("#tr_label_image_header").text('Pago');
			$("#progress").css("width", "100%"); 
			$('#btn_continue_payment').text('Proceder al pago');
			draw_resume();
		}else{
			Swal.fire({
				title: "Error",
				icon: "error",
				text: "Corriga los errores del formulario",
			})
		}
		break;

		case '1':
			newTransaction();
		break;
	}

});

/* Multi select: Region -> Comuna */
$("#region").change(() => { 
	let region_select = $("#region").val();
	
	let r = regiones.regiones.filter( d => d.region == region_select);
	let option = document.createElement("option"); 
	$('#comuna').empty();
	$(option).val(0); 
	$(option).html('Seleccione una comuna'); 
	$(option).appendTo("#comuna");

	r[0].comunas.map((u) => {
		let option = document.createElement("option"); 
		$(option).val(u); 
		$(option).attr('name', u);
		$(option).html(u); 
		$(option).appendTo("#comuna");
	});
	
});


$("#region_contact").change(() => { 
	let region_select = $("#region_contact").val();
	
	let r = regiones.regiones.filter( d => d.region == region_select);
	let option = document.createElement("option"); 
	$('#comuna_contact').empty();
	$(option).val(0); 
	$(option).html('Seleccione una comuna'); 
	$(option).appendTo("#comuna_contact");

	r[0].comunas.map((u) => {
		let option = document.createElement("option"); 
		$(option).val(u); 
		$(option).attr('name', u);
		$(option).html(u); 
		$(option).appendTo("#comuna_contact");
	});
	
});

$("#region_office").change(() => { 
	let region_select = $("#region_office").val();
	
	let r = regiones.regiones.filter( d => d.region == region_select);
	let option = document.createElement("option"); 
	$('#comuna_office').empty();
	$(option).val(0); 
	$(option).html('Seleccione una comuna'); 
	$(option).appendTo("#comuna_office");

	r[0].comunas.map((u) => {
		let option = document.createElement("option"); 
		$(option).val(u); 
		$(option).attr('name', u);
		$(option).html(u); 
		$(option).appendTo("#comuna_office");
	});
	
});

/* Select type deliver */
$("#type_delivery").change(() => { 
	let type_delivery = $("#type_delivery").val();
	
	if(type_delivery == 0){
		cleanInput(0);
	}else if(type_delivery == 1){
		cleanInput(1);
		$('#total_delivery').text('$0');
	}else if(type_delivery == 2){
		cleanInput(2);
		$('#frm_enterprise_delivery').show();
		$('#total_delivery').text('Por pagar');
		$('#div_address').show();
	}else if(type_delivery == 3){
		cleanInput(3);
		$('#frm_enterprise_delivery').show();
		$('#total_delivery').text('Por pagar');
		$('#div_address_enterprise').show();
	}
});

/* Add a product to cart in a 1:1 ratio  */
plus_product_by_id = (id) => {

	$.ajax({
		type: "GET",
		url: host_url + "api/cart/plusProduct/"+id,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			document.getElementById("content_products").innerHTML="";
			get_cant_products();
			get_products();
			toastMixin.fire({
					animation: true,
					title: 'Producto agregado'
			})
		},
		error: (result) => {
			Swal.fire({
				title: "Error",
				icon: "error",
				text: result.msg,
			})
		}		
	});
}

/* Remove a product to cart in a 1:1 ratio  */
minus_product_by_id = (id) => {

	$.ajax({
		type: "GET",
		url: host_url + "api/cart/minusProduct/"+id,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			document.getElementById("content_products").innerHTML="";
			get_cant_products();
			get_products();
			toastMixin.fire({
				title: 'Productos eliminados',
				icon: 'error'
				});
		},
		error: (result) => {	
			Swal.fire({
				title: "Error",
				icon: "error",
				text: result.msg,
			})
		}		
	});
}

/* Add a multiple product to cart */
addMultiple = (id) =>{

	let quantity =  parseInt($('#quantity_'+id).val());

	product = {
        id: id,
        quantity: quantity,
    };
	

	if( $('#quantity_'+id).val() == 0){
		Swal.fire({
			title: `Eliminar productos`,
			icon: "warning",
			text: `El valor ingresado es 0, ¿Está seguro/a que desea eliminar los productos?`,
			showCancelButton: true,
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Confirmar',
		}).then((action) => {
			if (action.isConfirmed) {
				$.ajax({
					type: "POST",
					url: host_url + "api/cart/addMultipleProduct",
					crossOrigin: false,
					data: {product},
					dataType: "json",
					success: (result) => {
						document.getElementById("content_products").innerHTML="";
						get_cant_products();
						get_products();
						toastMixin.fire({
							title: 'Productos eliminados',
							icon: 'error'
						  });
					},
					error: (result) => {	
						Swal.fire({
							title: "Error",
							icon: "error",
							text: result.msg,
						})
					}		
				});
			} else {
				let old_value;
				cantidad.map((u) => {
					console.log(u);
                    if('quantity_'+id == u.name){
						old_value =  u['quantity'];
					}
                });

				$('#quantity_'+id).val(old_value);
				Swal.fire.close();
			}
		});
	}else{
		$.ajax({
			type: "POST",
			url: host_url + "api/cart/addMultipleProduct",
			crossOrigin: false,
			data:{product},
			dataType: "json",
			success: () => {
				document.getElementById("content_products").innerHTML="";
				get_cant_products();
				get_products();
				toastMixin.fire({
						animation: true,
						title: 'Producto agregado'
				})
			},
			error: (result) => {	
				Swal.fire({
					title: "Error",
					icon: "error",
					text: result.msg,
				})
			}		
		});
	}
}

/* Remove product */
delete_product_by_id = (id) => {
	$.ajax({
		type: "GET",
		url: host_url + "api/cart/deleteProduct/"+id,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			document.getElementById("content_products").innerHTML="";
			get_cant_products();
			get_products();
			toastMixin.fire({
				title: 'Productos eliminados',
				icon: 'error'
				});
		},
		error: (result) => {	
			Swal.fire({
				title: "Error",
				icon: "error",
				text: result.msg,
			})
		}		
	});
}

/*----------- Format data----------- */

/* Format price to clp format x.xxx.xxx */
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

/* Clean form steps */
cleanInput = (op) => {
	switch(op){
		case 0:
			$("#enterprise").val(0);
			$('#frm_enterprise_delivery').hide();
			$('#div_address').hide();
			$('#div_address_enterprise').hide();
		break;
		
		case 1:
			$('#frm_enterprise_delivery').hide();
			$('#div_address').hide();
			$('#div_address_enterprise').hide();
		break;

		case 2:
			$("#enterprise").val(0);
			$('#frm_enterprise_delivery').hide();
			$('#div_address_enterprise').hide();
		break;

		case 3:
			$("#enterprise").val(0);
			$('#frm_enterprise_delivery').hide();
			$('#div_address').hide();
		break;
	}
}

/* Verify that data form is valid */
formRules = () => {
	let name = $('#name').val();
	let rut = $("#rut").val();
	let phone = $('#phone').val();
	let email = $('#email').val();
	let type_delivery = $('#type_delivery').val();
	let address = $('#address').val();
	let address_office = $('#address_office').val();
	let number = $('#number').val();
	let region = $('#region').val();
	let comuna = $('#comuna').val();
	let region_contact = $('#region_contact').val();
	let comuna_contact = $('#comuna_contact').val();
	let region_office = $('#region_office').val();
	let comuna_office = $('#comuna_office').val();
	let enterprise = $('#enterprise').val();
	let isOk = true;

	if(!name){
		$("#frm_name > div").html('El Campo Nombre Es Obligarorio'); $("#frm_name > input").addClass("is-invalid");
		isOk = false;
	}

	if(!rut){
		$("#frm_rut > div").html('El Campo Rut Es Obligarorio'); $("#frm_rut > input").addClass("is-invalid");
		isOk = false;
	}else if((rut) && (rutOk == false)){
		isOk = false;
	}

	if(!phone){
		$("#frm_phone > div").html('El Campo Teléfono Es Obligarorio'); $("#frm_phone > input").addClass("is-invalid");
		isOk = false;
	}

	if(!email){
		$("#frm_email > div").html('El Campo Email Es Obligarorio'); $("#frm_email > input").addClass("is-invalid");
		isOk = false;
	}

	if(region_contact == 0){
		$("#frm_region_contact > div").html('El Campo Región Es Obligarorio'); $("#frm_region_contact > select").addClass("is-invalid");
		isOk = false;
	}

	if(comuna_contact == 0){
		$("#frm_comuna_contact > div").html('El Campo Comuna Es Obligarorio'); $("#frm_comuna_contact > select").addClass("is-invalid");
		isOk = false;
	}

	if(type_delivery == 0){
		$("#frm_type_delivery > div").html('El Campo Tipo Delivery Es Obligarorio'); $("#frm_type_delivery > select").addClass("is-invalid");
		isOk = false;
	}else if(type_delivery == 2){
		if(enterprise == 0){
			$("#frm_enterprise_delivery > div").html('El Campo Empresa Es Obligarorio'); $("#frm_enterprise_delivery > select").addClass("is-invalid");
			isOk = false;
		}

		if(!address){
			$("#frm_address > div").html('El Campo Dirección Es Obligarorio'); $("#frm_address > input").addClass("is-invalid");
			isOk = false;
		}
	
		if(!number){
			$("#frm_number > div").html('El Campo Número Es Obligarorio'); $("#frm_number > input").addClass("is-invalid");
			isOk = false;
		}

		if(region == 0){
			$("#frm_region > div").html('El Campo Región Es Obligarorio'); $("#frm_region > select").addClass("is-invalid");
			isOk = false;
		}

		if(comuna == 0){
			$("#frm_comuna > div").html('El Campo Comuna Es Obligarorio'); $("#frm_comuna > select").addClass("is-invalid");
			isOk = false;
		}
	}else if(type_delivery == 3){
		if(enterprise == 0){
			$("#frm_enterprise_delivery > div").html('El Campo Empresa Es Obligarorio'); $("#frm_enterprise_delivery > select").addClass("is-invalid");
			isOk = false;
		}

		if(region_office == 0){
			$("#frm_region_office > div").html('El Campo Región Es Obligarorio'); $("#frm_region_office > select").addClass("is-invalid");
			isOk = false;
		}

		if(comuna_office == 0){
			$("#frm_comuna_office > div").html('El Campo Comuna Es Obligarorio'); $("#frm_comuna_office > select").addClass("is-invalid");
			isOk = false;
		}

		if(!address_office){
			$("#frm_address_office > div").html('El Campo Dirección Es Obligarorio'); $("#frm_address_office > input").addClass("is-invalid");
			isOk = false;
		}
	}

	return isOk;
}

$("#name").change(() => { 
	let name = $("#name").val();
	if(name){
		$("#frm_name > input").removeClass("is-invalid");
	}else{
		$("#frm_name > input").addClass("is-invalid");
	}
});

$("#rut").change(() => { 
	let rut = $("#rut").val();
	if(rut){
		$("#frm_rut > input").removeClass("is-invalid");
	}else{
		$("#frm_rut > input").addClass("is-invalid");
	}
});

$("#phone").change(() => { 
	let phone = $("#phone").val();
	if(phone){
		$("#frm_phone > input").removeClass("is-invalid");
	}else{
		$("#frm_phone > input").addClass("is-invalid");
	}
});

$("#email").change(() => { 
	let email = $("#email").val();

	if(email){
		if (validateEmail(email)) {
			$("#frm_email > input").removeClass("is-invalid");
		} else {
			$("#frm_email > div").html('Ingrese una dirección de correo válida'); $("#frm_email > input").addClass("is-invalid");
		}
	}else{
		$("#frm_email > input").addClass("is-invalid");
	}
});

$("#address").change(() => { 
	let address = $("#address").val();
	if(address){
		$("#frm_address > input").removeClass("is-invalid");
	}else{
		$("#frm_address > input").addClass("is-invalid");
	}
});

$("#address_office").change(() => { 
	let address = $("#address_office").val();
	if(address){
		$("#frm_address_office > input").removeClass("is-invalid");
	}else{
		$("#frm_address_office > input").addClass("is-invalid");
	}
});

$("#number").change(() => { 
	let number = $("#number").val();
	if(number){
		$("#frm_number > input").removeClass("is-invalid");
	}else{
		$("#frm_number > input").addClass("is-invalid");
	}
});

$("#type_delivery").change(() => { 
	let type_delivery = $("#type_delivery").val();
	if(type_delivery){
		$("#frm_type_delivery > select").removeClass("is-invalid");
	}else{
		$("#frm_type_delivery > select").addClass("is-invalid");
	}
});

$("#region").change(() => { 
	let region = $("#region").val();
	if(region){
		$("#frm_region > select").removeClass("is-invalid");
	}else{
		$("#frm_region > select").addClass("is-invalid");
	}
});

$("#comuna").change(() => { 
	let comuna = $("#comuna").val();
	if(comuna){
		$("#frm_comuna > select").removeClass("is-invalid");
	}else{
		$("#frm_comuna > select").addClass("is-invalid");
	}
});

$("#region_contact").change(() => { 
	let region = $("#region_contact").val();
	if(region){
		$("#frm_region_contact > select").removeClass("is-invalid");
	}else{
		$("#frm_region_contact > select").addClass("is-invalid");
	}
});

$("#comuna_contact").change(() => { 
	let comuna = $("#comuna_contact").val();
	if(comuna){
		$("#frm_comuna_contact > select").removeClass("is-invalid");
	}else{
		$("#frm_comuna_contact > select").addClass("is-invalid");
	}
});

$("#region_office").change(() => { 
	let region = $("#region_office").val();
	if(region){
		$("#frm_region_office > select").removeClass("is-invalid");
	}else{
		$("#frm_region_office > select").addClass("is-invalid");
	}
});

$("#comuna_office").change(() => { 
	let comuna = $("#comuna_office").val();
	if(comuna){
		$("#frm_comuna_office > select").removeClass("is-invalid");
	}else{
		$("#frm_comuna_office > select").addClass("is-invalid");
	}
});

$("#enterprise").change(() => { 
	let enterprise = $("#enterprise").val();
	let op = $("#type_delivery").val();
	if(enterprise){
		$("#frm_enterprise_delivery > select").removeClass("is-invalid");
	}else{
		$("#frm_enterprise_delivery > select").addClass("is-invalid");
	}

	if(op == 3){
		let office = $('#enterprise').val();
		$('#label_office').text('Dirección de la oficina de '+ office);
	}
});


redirect = () =>{
	let url = 'products';
    window.location.assign(host_url+url);
};

resetCant = (result) => {
	let cantidad = 0;
	$.each(result.products, function(i, item) {
		console.log(item.cantidad);
		cantidad = parseInt(cantidad) + parseInt(item.cantidad);
	});
	/* $('#cart_menu_num').text(cantidad); */
}

addWorkDays = (startDate, days) =>  {
    if(isNaN(days)) {
        console.log("Value provided for \"days\" was not a number");
        return
    }
    if(!(startDate instanceof Date)) {
        console.log("Value provided for \"startDate\" was not a Date object");
        return
    }
    // Get the day of the week as a number (0 = Sunday, 1 = Monday, .... 6 = Saturday)
    var dow = startDate.getDay();
    var daysToAdd = parseInt(days);
    // If the current day is Sunday add one day
    if (dow == 0)
        daysToAdd++;
    // If the start date plus the additional days falls on or after the closest Saturday calculate weekends
    if (dow + daysToAdd >= 6) {
        //Subtract days in current working week from work days
        var remainingWorkDays = daysToAdd - (5 - dow);
        //Add current working week's weekend
        daysToAdd += 2;
        if (remainingWorkDays > 5) {
            //Add two days for each working week by calculating how many weeks are included
            daysToAdd += 2 * Math.floor(remainingWorkDays / 5);
            //Exclude final weekend if remainingWorkDays resolves to an exact number of weeks
            if (remainingWorkDays % 5 == 0)
                daysToAdd -= 2;
        }
    }
    startDate.setDate(startDate.getDate() + daysToAdd);
    return startDate;
}

