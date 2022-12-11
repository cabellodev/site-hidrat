<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home/ Productos</li>
    </ol>

    

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
         Lista de Productos ( HOME )
        <button class="btn btn-success float-right" type='button' id="btn_addProduct"><i class="fas fa-plus"></i> Agregar Producto</button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-productos" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Codigo</th>
                <th>Imagen</th>
                <th>Proveedor</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>Sub-Categoria</th>
                <th>Sub-Sub-Categoria</th>
                <th>Copiar</th>                
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="create_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog mw-100 w-75" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Agregar Producto</h5>
        <button type="button" class="close"  onclick="clearModal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
            <p id="UserModalInfo"></p>
          </div>
        </div>
      
        <!-- <div class="form-group">
            <div class="row" id="id_btn_prev" style="display: none;">
              <div class="col-md-1 mb-3">
                <button type="button" id='btn_prev' class= "btn"><i class="fa-solid fa-arrow-left">Volver</i></button> 
              </div>
              <div class="col-md-11 mb-3">
                <h1 style="text-align: center">Lista de productos</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <button type="button" id='btn_createNew' class="btn btn-primary btn-lg btn-block">Desde 0</button>      
              </div>
              <div class="col-md-6 mb-3">
                <button type="button" id='btn_createSinceOther' class="btn btn-primary btn-lg btn-block">Precargar datos de otro producto</button>                  
              </div>
            </div>
        </div> -->
<!-- 
        <div class="table-responsive" id="div_table-productos_create" style="display: none;">
          <table class="table table-bordered" id="table-productos_create" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Codigo</th>
                <th>Imagen</th>
                <th>Proveedor</th>
                <th>Categoria</th>
                <th>Sub-Categoria</th>
                <th>Sub-Sub-Categoria</th>
                <th>Seleccionar</th>
              </tr>
            </thead>
          </table>
        </div> -->

        <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group float-right">
                  <button type="button" id="close" class="btn btn-secondary" onclick="clearModal()" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url(); ?>assets/js_admin/adminProduct.js"></script>
