@if(session('ntg_notify'))
     <div id="ntg-notification" class="alert alert-success">
          {{ session('ntg_notify') }}
     </div>
@endif