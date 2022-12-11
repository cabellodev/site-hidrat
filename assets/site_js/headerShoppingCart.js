$(()=>{
    get_cant_products();
})


get_cant_products =()=>{
	/* alert(localStorage.getItem("ncantidad"));
	if(!localStorage.getItem("ncantidad")){



		localStorage.setItem("ncantidad", 0);
		$('#cart_menu_num').text('0');
	}else{
		$('#cart_menu_num').text(localStorage.getItem("ncantidad"));
	}
 */
	

    $.ajax({
		type: "GET",
		url: host_url + 'api/cart/quantity',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			console.log(result.newNumber);
                $('#cart_menu_num').text(result.newNumber);
			}
        ,
        error: (result) => {	
			swal({
				title: "Error",
				icon: "error",
				text: result.msg,
			})
		}	
    });
}
