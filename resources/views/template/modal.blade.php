@extends('../template/main')
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@yield('form-title')</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form method="post" action="@yield('form-action')" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="modal-body">
          @yield('icon-edit-modal')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
          <button type="submit" class="btn btn-primary">編集する！</button>
        </div>

      </form>

    </div>
  </div>
</div>


