$(() => {
    get_product();
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});


const tabla = $("#table-productos").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
		{className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]},
        {className: "text-center", "targets": [3]},
		{className: "text-center", "targets": [4]},
		{className: "text-center", "targets": [5]},
		{className: "text-center", "targets": [6]},
		{className: "text-center", "targets": [7]},
		{className: "text-center", "targets": [8]},
    ],
	columns: [
		{ data: "name" },
		{ data: "code" },
		{ data: "url",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/images/products/image_first/"+binary+'" width="200" heigth="200"/>';
          } 
        },
		{ data: "supplier" },
		{ data: "price" },
		{ data: "stock" },
		{ data: "category" },
		{ data: "subCategory" },
		{ data: "subSubCategory" },
		{
			defaultContent: `<button type='button' name='copyButton' class='btn btn-primary'>
                                  Copiar
                                  <i class="fa-solid fa-file"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='updateButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='deleteButton' class='btn btn-danger'>
                                    Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});


get_product= ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/product',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			console.log(result);
			let data = result.map((u) => {
				if (u.category == null ) {
					u.category = "N/A";
				}

				if (u.subSubCategory == null ) {
					u.subSubCategory = "N/A";
				}

				if (u.subCategory == null ) {
					u.subCategory = "N/A";
				}
				return u;
			});
			tabla.clear();
			tabla.rows.add(data);
			tabla.draw();
		}
        ,
		error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener los servicios",
			});
        }
    })
}

$("#table-productos").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	
	if ($(this)[0].name == "updateButton") {
		window.location.href = `${host_url}api/home/adminUpdate/product/${data.id}`;
	}else if ($(this)[0].name == "copyButton") {
		window.location.href = `${host_url}api/home/adminCopy/product/${data.id}`;
	}else if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Eliminar producto`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar el producto: "${data.name}"? `,
			buttons: {
				confirm: {
					text: "Eliminar",
					value: "exec",
				},
				cancel: {
					text: "Cancelar",
					value: "cancelar",
					visible: true,
				},
			},
		}).then((action) => {
			if (action == "exec") {
				delete_product(data.id);
			} else {
				swal.close();
			}
		});
	}
});

copy_product = (id_product)=>{


	/*  $.ajax({
		 type: "POST",
		 url: host_url + `api/home/delete/product/${id_product}`,
		 crossOrigin: false,
		 dataType: "json",
		 success: (result) => {
			 swal({
				 title: "Éxito",
				 icon: "success",
				 text: result.msg,
			 }).then(()=>{
				 get_product();
			 });
			 }
		 ,
		 error: (msg)=>{
			 swal({
				 title: "Error",
				 icon: "error",
				 text: "Error al eliminar el producto.",
			 });
		 }
	 }) */
 }

delete_product = (id_product)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/product/${id_product}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_product();
            });
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar el producto.",
			});
        }
    })
}

datatable = (productos)=>{
    tabla.clear();
	tabla.rows.add(productos);
	tabla.draw();
}

clearModal = () =>{
	$("#create_product_modal").modal("hide");
	$("#div_table-productos_create").hide();
	$("#btn_createNew").show();
	$("#btn_createSinceOther").show();
}

$("#btn_addProduct").on("click", () => {
	window.location.href = `${host_url}api/home/adminCreate/product`;
});

/* $("#btn_addProduct").on("click", () => {
	$("#create_product_modal").modal("show");
});
 */
$("#btn_createNew").on("click", () => {
	window.location.href = `${host_url}api/home/adminCreate/product`;
});

$("#btn_createSinceOther").on("click", () => {
	$("#div_table-productos_create").show();
	$("#id_btn_prev").show();
	$("#btn_createNew").hide();
	$("#btn_createSinceOther").hide();
});

$("#btn_prev").on("click", () => {
	$("#btn_createNew").show();
	$("#btn_createSinceOther").show();
	$("#div_table-productos_create").hide();
	$("#id_btn_prev").hide();
});
