<!--  Modal content for the above example -->
<div id="modal-venta" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
            </div>
          
            <form class="form-horizontal">
              <div class="modal-body">
                <div class="form-group">
                    <label for="range_01" class="col-sm-2 control-label">Calificación<span class="font-normal text-muted clearfix">Puntuación para el empleado</span></label>
                    <div class="col-sm-10">
                        <input type="text" id="range_01">
                    </div>
                </div>
              </div>
            </form>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
              <a class="vender">
                <button type="button" class="btn btn-info waves-effect waves-light" data-dismiss="modal" data-backdrop="false">Vender</button>
              </a>
            </div>
          
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


 <!-- Ion Range slider js -->
        <script src="../assets/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
        <script src="../assets/pages/jquery.range-sliders.js"></script>
<!-- form advanced init js -->
<script src="../assets/pages/jquery.form-advanced.init.js"></script>
<!-- App Js -->
<script src="../assets/js/jquery.app.js"></script>

<script>$('#modal-venta').modal();</script>