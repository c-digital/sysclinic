<div class="modal fade" id="info_{{ $session->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información de sesiones realizadas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
        	<thead>
        		<tr>
        			<th>Paciente</th>
        			<th>Tratamiento</th>
        			<th>Cantidad</th>
        		</tr>
        	</thead>

        	<tbody>
        		<tr>
        			<td>{{ $session->customer->name }}</td>
        			<td>{{ $session->product->name }}</td>
        			<td>{{ $session->quantity }}</td>
        		</tr>
        	</tbody>
        </table>

        <table class="table mt-3">
        	<thead>
        		<tr>
        			<th colspan="3">Sesiones realizadas</th>
        		</tr>

        		<tr>
        			<th>#</th>
        			<th>Fecha</th>
        			<th>Usuario</th>
        		</tr>
        	</thead>

        	<tbody>
        		@foreach(json_decode($session->realized) as $realized)
        			<tr>
        				<td>{{ $loop->iteration }}</td>
        				<td>{{ $realized->date }}</td>
        				<td>{{ App\Models\User::find($realized->user)->name }}</td>
        			</tr>
        		@endforeach
        	</tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="/sessions/print/{{ $session->id }}" target="_blank" class="btn btn-primary">Imprimir</a>
      </div>
    </div>
  </div>
</div>