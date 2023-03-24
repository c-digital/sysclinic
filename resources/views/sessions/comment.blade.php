<div class="modal fade" id="comment_{{ $session->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      @csrf
      {{ Form::open(array('url' => '/sessions/realized','enctype' => "multipart/form-data")) }}
        <input type="hidden" name="id" value="{{ $session->id }}">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Realizar sesión</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="comment">Comentario</label>
            <textarea name="comment" required class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>