<link href="<?php echo base_url(); ?>assets/site_css/pagination.css" rel="stylesheet">
<script src="<?php echo base_url() ;?>assets/site_js/pagination.min.js"></script>
<main>
        <section>
            <div class="container-fluid page-header-about d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5 mb-5">
                
                <h1 class="display-4 text-white mb-3 mt-0 mt-lg-5 wow slideInDown"><i class="bi-box"></i><span class="title-product"></span></h1>
                <div class="d-inline-flex text-white wow slideInUp">
                    <p class="m-0"><a class="text-white" href="">Home</a></p>
                    <p class="m-0 px-2">/</p>
                    <p class="m-0 title-product"></p>
                </div>
            </div>
        </section>

        <section>
        <div class="col-md-12 mb-5">
                            <div class="section-title text-center wow slideInRight " data-wow-delay="0.8">
                                <h2 class ="style-p  wow slideInLeft " style="color:#141b6a;font-size:40px;"><i class="bi-box"></i>  <span class="title-catalogo"></span></h2>
                            </div>
                        </div>
        </section>

       <section>

                    <div class="row justify-content-center" style="background:#141b6a; padding-top:50px ; padding-bottom:50px ;">
                        
                        
                           
                    <!--        <div class="col-lg-2 col-md-2 col-sm-12 align text-center" >
                            <label for="actividad"class="text-white">Categoría</label>
                                    <select class="input-select" id ="categories">
                                            <option value="0">Seleccione categoría</option>
                                    </select>
                            </div>
                            
                            <div class="col-lg-2 col-md-2 col-sm-12 align text-center" >
                            <label for="actividad" class="text-white">Sub-categoría</label>
                                <select class="input-select"id ="subcategories">
                                <option value="0">Seleccione sub-categoría</option>
                                </select>
                            </div>
                        
                            <div class="col-lg-2 col-md-2 col-sm-12 align text-center" >
                            <label for="actividad"class="text-white">Sub-categoría</label>
                                <select class="input-select" id ="subsubcategories">
                                <option value="0">Seleccione sub-categoría</option>
                                    </select>
                            </div>-->
                            <div class="col-lg-4 col-md-3 col-sm-12 align text-center" >
                                 <label  class="text-white">Busqueda (nombres de productos , categorias)</label>
                                            <select class="size-select"  id ="product_name" >
                                                <option value="">Digite su búsqueda.....</option>
                                            </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 align text-center supplier select-size">
                                 <label  class="text-white">Marca </label>
                                 <select  id ="supplier">
                                     <option value="0">Seleccione marca</option>
                                 </select>
                           </div>
                           <div class="row justify-content-center" style="background:#141b6a; padding-top:5px ; ">
                                <div class="col-lg-2 col-md-2 col-sm-12 align " id='frm_service'>
                                        <button class="btn btn-success" style="background:white; color:#141b6a; margin-top:20px;" id="search_advanced">Buscar</button>
                                        <button class="btn btn-success" style="background:white; color:#141b6a; margin-top:20px;" id="filter">Filtro avanzado</button>
                                </div> 
                            </div>     
                </div>
              
       </section>
       
        




        <section>
                        <!-- store products -->
                    <div class="row product-content">  </div>  
        </section>

        <div>
            <section id="list-product">
                <div id="data-container">


                </div>              
                <div id="pagination" style="margin: 0 40% 0 40%"></div>
            </section>
        </div>

        
<!--
<div class="row ">
        <div id="view-data" ></div> 
        <div id="pagination"></div>
        </div>
</div>-->
</main><!-- PAGINADOR ( BUSCAR BUENA UBICACIÓN Y ADEMAS VER COMO FUNCIONA CON DATA DE LA BASE )-->


<script src="<?php echo base_url() ;?>assets/site_js/product.js?v=<?php echo(rand()); ?>"></script>  



