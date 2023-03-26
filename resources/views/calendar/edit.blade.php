<div class="modal fade" id="calendarEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {{Form::open(array('url'=>'calendar/update','method'=>'post'))}}
        <input type="hidden" name="id" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label for="title">Título</label>
              <input type="text" class="form-control" name="title" required>
            </div>

            <div class="col-md-12 mt-2">
              <label for="productsServices">Productos / servicios</label>
              <div class="row">
                <div class="col-md-10">
                  {{ Form::select('productsServices', $productsServices,'', array('class' => 'form-control productServicesEdit')) }}
                </div>

                <div class="col-md-2">
                  <button type="button" class="btn btn-primary btn-block" onclick="createEditProductService()" style="width: 100%">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
              </div>

              <table class="table mt-2">
                <tr>
                  <th>Productos agregados</th>
                </tr>

                <tbody class="productsServicesEditTr"></tbody>
              </table>
            </div>

            <div class="col-md-6 mt-2">
              <label for="id_customer">Paciente</label>

              <select name="id_customer" class="form-control">
                <option value=""></option>

                @foreach($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mt-2">
              <label for="id_user">Doctor</label>

              <select name="id_user" class="form-control">
                <option value=""></option>

                @foreach($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 mt-2">
              <label for="id_customer">Fecha y hora</label>
              <input class="form-control" type="datetime-local" name="datetime" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-info" name="consultation" value="Consulta">
          <input type="submit" class="btn btn-info" name="invoice" value="Factura">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>