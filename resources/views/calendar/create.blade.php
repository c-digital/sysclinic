<div class="modal fade" id="calendarCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      {{Form::open(array('url'=>'calendar','method'=>'post'))}}
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear nuevo evento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label for="title">Título</label>
              <input type="text" class="form-control" name="title" required>
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
              <label for="id_customer">Fecha y hora</label>
              <input class="form-control" type="date" name="datetime-local" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>