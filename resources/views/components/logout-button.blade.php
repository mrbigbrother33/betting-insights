<form method="POST" action="{{ route('logout') }}">
    @csrf
   <button type="submit"> <i class="fa fa-sign-out"></i> Log ud</button>
</form>
