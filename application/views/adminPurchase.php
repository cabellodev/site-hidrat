<div id="content-wrapper" style="background:#eeeeee">
    <div class="container-fluid mb-5" id="adminColors" style="background:#eeeeee">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7 mb-3 div-container-bar">
                    <div class="progress-bar-container">
                        <div class="progress" id="progress"></div>
                        <div id='bar-cart' style="cursor: pointer;" class="progress-bar-step progress-bar-step-active" data-title="Carro">
                        </div>
                        <div id='bar-delivery' style="cursor: pointer;" class="progress-bar-step" data-title="Delivery">
                          
                        </div>
                        <div id='bar-purchase' style="cursor: pointer;" class="progress-bar-step" data-title="Pago">
                        </div>
                    </div>
                </div>
            </div>
            </br>
            
            <div class="row">
                <div class="col-md-8 mb-3" id='cart_box'>
                    <div class="row">
                        <div class="jsx-card-title">
                            <span class="jsx-resume-title-content" id='tr_label_image_header'>Carro de Compra</span>
                        </div>
                    </div>
                    </br>
                    <div id='content_products' class="row">
                    </div>
                    <div id='delivery' class="row"  style='display:none'>
                        <div class='card mb-4 shadow p-3 mb-5 bg-white jsx-card-item'>
                            <div class='card-body'>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="row">
                                            <span class="jsx-resume-title-content" id=''>Datos de Contacto</span>
                                        </div>
                                        </br>
                                        <div class="row mb-3">
                                            <div class="col-4 col-sm-6">
                                                <label for="actividad">Nombre</label>
                                                <div class="input-group" id='frm_name'>
                                                    <input type="text" class="form-control" name="name" id="name">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-sm-6">
                                                <label for="actividad">Rut empresa</label>
                                                <div class="input-group" id='frm_rut'>
                                                    <input type="text" class="form-control" name="rut" id="rut">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-4 col-sm-6">
                                                <label for="actividad">Teléfono / Celular</label>
                                                <div class="input-group" id='frm_phone'>
                                                    <input type="text" class="form-control" name="phone" id="phone">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-4 col-sm-6">
                                                <label for="actividad">Correo Electrónico</label>
                                                <div class="input-group" id='frm_email'>
                                                    <input type="email" pattern="[^ @]*@[^ @]*" class="form-control" name="email" id="email">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6 col-sm-6" id='frm_region_contact'>
                                                <label>Región</label>
                                                <select class="form-select d-block w-100" id="region_contact" name="region_contact" >
                                                    <option value="0" selected>Seleccione una región</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-6 col-sm-6" id='frm_comuna_contact'>
                                                <label>Comuna</label>
                                                <select class="form-select d-block w-100" id="comuna_contact" name="comuna_contact" >
                                                    <option value="0" selected>Seleccione una ciudad</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class='card mb-4 shadow p-3 mb-5 bg-white jsx-card-item'>
                            <div class='card-body'>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="row mb-3">
                                            <span class="jsx-resume-title-content" id=''>Envío</span>
                                        </div>
                                        </br>
                                        <div class="row mb-3">
                                            <div class="col-6 col-sm-6" id="frm_type_delivery">
                                                <label>Tipo de entrega</label>
                                                <select class="form-select d-block w-100" id="type_delivery" name="type_delivery" >
                                                    <option value="0" selected>Seleccione un tipo de entrega</option>
                                                    <option value="1">Retiro en casa matriz Hidratec Coquimbo</option>
                                                    <option value="2">Delivery: domicilio</option>
                                                    <option value="3">Delivery: sucursal de proveedor encargada del delivery</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-6 col-sm-6" id="frm_enterprise_delivery" style="display: none">
                                                <label>Empresa Delivery</label>
                                                <select class="form-select d-block w-100" id="enterprise" name="enterprise" >
                                                    <option value="0" selected>Seleccione un proveedor</option>
                                                    <option value= "PDQ">PDQ</option>
                                                    <option value= "Estafeta">Estafeta</option>
                                                    <option value= "varmontt">varmontt</option>
                                                    <option value= "Pullman Cargo">Pullman Cargo</option>
                                                    <option value= "Fedex">Fedex</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div id='div_address' style="display:none">
                                            <div class="row mb-3">
                                                <div class="col-9 col-sm-9">
                                                    <label for="actividad">Dirección</label>
                                                    <div class="input-group" id='frm_address'>
                                                        <input type="text" class="form-control" name="address" id="address">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-3">
                                                    <label for="actividad">Número</label>
                                                    <div class="input-group" id='frm_number'>
                                                        <input type="number" min="0" class="form-control" name="number" id="number">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12">
                                                    <label for="actividad">Depto/Casa/Oficina</label>
                                                    <div class="input-group" id='frm_dpto'>
                                                        <input type="text" class="form-control" name="dpto" id="dpto">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12" id='frm_region'>
                                                    <label>Region</label>
                                                    <select class="form-select d-block w-100" id="region" name="region" >
                                                        <option value="0" selected>Seleccione una región</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12" id='frm_comuna'>
                                                    <label>Comuna</label>
                                                    <select class="form-select d-block w-100" id="comuna" name="comuna" >
                                                        <option value="0" selected>Seleccione una comuna</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12">
                                                    <label for="actividad">Comentarios</label>
                                                    <div class="input-group" id='frm_comentary'>
                                                        <textarea class="form-control" name="comentary" id="comentary"></textarea>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id='div_address_enterprise' style="display:none">
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12" id='frm_region_office'>
                                                    <label>Region</label>
                                                    <select class="form-select d-block w-100" id="region_office" name="region_office" >
                                                        <option value="0" selected>Seleccione una región</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12" id='frm_comuna_office'>
                                                    <label>Comuna</label>
                                                    <select class="form-select d-block w-100" id="comuna_office" name="comuna_office" >
                                                        <option value="0" selected>Seleccione una comuna</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12">
                                                    <label id='label_office'>Dirección de la oficina de </label>
                                                    <div class="input-group" id='frm_address_office'>
                                                        <input type="text" class="form-control" name="address_office" id="address_office">
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-sm-12">
                                                    <label for="actividad">Comentarios</label>
                                                    <div class="input-group" id='frm_comentary_office'>
                                                        <textarea class="form-control" name="comentary_office" id="comentary_office"></textarea>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div id='purchase' class="row" style='display:none'>
                        <!-- <div class='card mb-4 shadow p-3 mb-5 bg-white jsx-card-item'>
                            <div class='card-body'>
                                <div class='row'>

                                    <div class='col-md-9 mb-3'>
                                        <div class='row'>
                                            <span class='jsx-resume-title-content'>Tipo De Entrega</span>
                                        </div>
                                        </br>
                                        <div class='row mb-3'>
                                            <div class='col-12 col-sm-12'>
                                                <span>Entrega - <strong>Retiro en Hidratec</strong></span>
                                            </div>
                                            <div class='col-12 col-sm-12'>
                                                <i class='fa-solid fa-map-pin'></i>
                                                <span> Lugar de entrega: - <strong> Proyectada uno 1712 Galpón 4 barrio industrial Coquimbo, Coquimbo</strong></span>
                                            </div>
                                        </div>
                                        </br>
                                        <div class='row mb-3'>
                                            <div class='col-12 col-sm-12'>
                                                <i class='fa-solid fa-truck'></i>
                                                <span><strong> Entrega estimada para el día 16/11/2022 </strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-md-3 mb-3'>
                                        <img class="img-fluid" style="margin: auto; display: block" src="<?php echo base_url(); ?>assets/video/delivered.gif"></img>
                                    </div>
                                </div>
                            </div>
                        </div> -->









                    </div>
                </div>
                <div class="col-md-4 mb-3" id ='purchase_box'>
                    <div class="row">
                        <div class="input-group jsx-resume-title">
                            <span class="jsx-resume-title-content" id='tr_label_image_header'>Resumen de la compra</span></br>    
                        </div>
                    </div>
                    </br>
                    <div class="row jsx-card-resume-scrol" id='resume_cart'>  
                        <div class="card mb-4 shadow p-3 mb-5 bg-white jsx-card-resume">
                            <div class="card-body">
                                <div class="row">
                                    <div class="jsx-delivery">
                                        <span class="resume-delivery-text">Envío a domicilio no incluido</span>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 jsx-title">
                                                <span class="purshase-total-text-bold">TOTAL:</span>
                                            </div>   
                                            <div class="col-6 col-sm-6 jsx-total">
                                                <span style="color:red" id='total_purchase' class="purshase-total-text-bold"></span>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <div class="rowjsx-total-btn">
                                    <button class="custom-btn rounded-pill jsx-total-btn-next" type='button' value='0' id="btn_continue_delivery"> 
                                        Continuar Compra
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row jsx-card-resume-scrol" id='resume_delivery' style='display:none'>  
                        <div class="card mb-4 shadow p-3 mb-5 bg-white jsx-card-resume">
                            <div class="card-title">
                                <div class="col-12 col-sm-12">
                                    <span id='quantity-min' class="resume-delivery-comeback-title"></span>   
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12" id='items-min'>      
                                    </div>
                                    <div class="col-12 col-sm-12 jsx-delivery-cart-comeback">
                                        <i class="fa-solid fa-cart-shopping cart-comeback"></i>
                                        <a href="<?php echo base_url(); ?>shoppingCart" class="resume-delivery-comeback">Volver al carro</a>
                                    </div>
                                    
                                    <div class="col-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 jsx-title">
                                                <span class="purshase-total-text-bold">Costo de envío:</span>
                                            </div>   
                                            <div class="col-6 col-sm-6 jsx-total">
                                                <span style="color:red" id="total_delivery" class="purshase-total-text-bold"></span>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-6 col-sm-6 jsx-title">
                                                <span class="purshase-total-text-bold">TOTAL:</span>
                                            </div>   
                                            <div class="col-6 col-sm-6 jsx-total">
                                                <span style="color:red" id='total_purchase_min' class="purshase-total-text-bold"></span>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <div class="rowjsx-total-btn">
                                    <button class="custom-btn rounded-pill jsx-total-btn-next" type='button' value='0' id="btn_continue_payment"> 
                                        Continuar Compra
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/site_js/wow.min.js"></script><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.6/dist/sweetalert2.all.min.js" integrity="sha256-mtjoVTnf2Y2/gJ01cOmPj+udqkKv5WIJUxKCjRIPr2s=" crossorigin="anonymous"></script>       
<script src="<?php echo base_url(); ?>assets/js/regiones.js"></script>
<script src="<?php echo base_url(); ?>assets/js/rut.js"></script>
<script src="<?php echo base_url(); ?>assets/site_js/adminPurchase.js"></script>



