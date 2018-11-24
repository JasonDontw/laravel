@if (count($errors) > 0) <!--在php若直接$變數名稱就會直接幫你創一個變數-->
  <div class="alert alert-danger">
      <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif