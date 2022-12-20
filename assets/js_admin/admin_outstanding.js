$(()=>{
    get_outstanding();

    let inicialize_time= new Date();
	let current=inicialize_time.toISOString().split('T')[0];
	var dateFormat = "YY-mm-dd";
	from=$("#from").val(current);
	/*from = $( "#from" ).datepicker({
		defaultDate: "+1w",
        dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 1
	  }).on( "change", function() {
		to.datepicker( "option", "minDate", getDate( this ) );
	  });*/
	
	 $( "#date_expiration" ).datepicker({
		defaultDate: "+1w",
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 1
	  }).on( "change", function() {
		from.datepicker( "option", "maxDate", getDate( this ) );
	  });
  

    getDate=( element ) =>{
        var date;
        try {
        date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
        date = null;
        }
        return date;
    }
})


let desc_boolean=false;
let id_section=1;

const tabla_outstanding = $("#table-outstanding").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]}
    ],
	columns: [

		{ data: "date_expiration" },
        { data: "url",
			render: function(data){

				if(data){
                    
				binary = data;
				return '<img src="'+host_url+"assets/images/outstanding/"+binary+'" width="200" heigth="200"/>';
				}else{
				return 'No aplica';
				}
		} 
	    },
        { defaultContent:"c",
            render: function(hd,type,row){
            let inicialize_time= new Date();
            let current=inicialize_time.toISOString().split('T')[0];
            
                if(current < row.date_expiration){
                    return 'Habilitado';
                }else{
                   return 'Deshabilitado';
                }
        } 
        },
		
		{
			defaultContent: `<button type='button' name='sections-edit' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
      
       
	],
});




$("#table-outstanding").on("click", "button", function () {
	let data = tabla_outstanding.row($(this).parents("tr")).data();
	if ($(this)[0].name == "sections-edit") {
                 input_sections();
                 desc_boolean = true;
				 $('#date_expiration').val(data.date_expiration);
				 
				 $("#outstanding_modal").modal('show');
    } 
});




get_outstanding = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/get_outstanding',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
          
            datatable_outstanding(result);}
        ,
        error: ()=>{  
            datatable_outstanding(0); }
        
    })
}


edit_section = ()=> {

    let inicialize_time= new Date();
	let current=inicialize_time.toISOString().split('T')[0];
    let files = $("#file-section")[0].files;
    let data = {
        id: 1,
        date_expiration: $('#date_expiration').val(),
    }

    if(current > date_expiration){
        swal({
            title: "Atención",
            icon: "info",
            text: "La fecha de expiración debe ser mayor a la actual. Intente nuevamente. ",
            button: "OK",
        });
    }else{

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/update_outstanding',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			up_file_section(id_section);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al actualizar la sección",
			});
        }
    });
}

}


up_file_section= (id_image) => {
 
	$.ajax({
		data: new FormData(document.getElementById('image_section')),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/outstanding/up/image/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado la sección con éxito. ",
				button: "OK",
			}).then(() => {
				input_sections();
				get_outstanding();
				$("#outstanding_modal").modal('hide');
				swal.close();
				
		       // let url = 'adminImages'+'?ot='+ot;
		       // window.open(host_url+url);
			});
		},
		error: () => {
			swal({
				title: "Error",
				icon: "error",
				text: "Ha ocurrido un error",
			});
		},
	});
};



datatable_outstanding = (sections)=>{
    tabla_outstanding.clear();
	tabla_outstanding.rows.add(sections);
	tabla_outstanding.draw();

}


input_sections=()=>{

    $("#title").val('');
    $("#file_section").val('');
    $("#description").val('');
	$('#title-not-image').val('');
	$('#desc-not-image').val('');

};


$("#update_section_btn").on('click',edit_section);
$("#edit-not-image").on('click', edit_not_image);